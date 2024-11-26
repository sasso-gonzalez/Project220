<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;//was missing this :| -serena
use App\Models\Patient;//was missing this :| -serena
use App\Models\Role;
use Illuminate\Http\Request;



class AdminAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:1,2')->only(['index', 'approve', 'deny', 'adminList']);
        $this->middleware('role:1')->only(['submitSalary']);
    }
    /**
     * Display a list of pending accounts.
     */
    public function index()
    {
        $pendingUsers = User::where('status', 'pending')->get();

        return view('pending_accounts', ['pendingUsers' => $pendingUsers]); //changed from admin.pending_accounts to pending_accounts -serena
    }

    /**
     * Approve a user account.
     */

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $role = Role::where('role', $user->role)->first();
    
        if (!$role) {
            return redirect()->back()->withErrors(['error' => 'Role not found for this user.']);
        }
    
        $user->status = 'approved';
        $user->save();
    
        if ($role->access_level <= 4) { // Use $role->access_level instead of $user->access_level
            $existingEmployee = Employee::where('user_id', $user->id)->first(); 
            if (!$existingEmployee) {
                Employee::create([
                    'user_id' => $user->id, 
                    'salary' => $this->calculateSalary($role->access_level),
                ]);
            }
        }
        else if ($role->access_level == 5) { // Use $role->access_level instead of $user->access_level
            $existingPatient = Patient::where('user_id', $user->id)->first(); 
            if (!$existingPatient) {
                Patient::create([
                    'user_id' => $user->id, 
                    'family_code' => $user->family_code,
                    'caregroup' => null,
                    'amount_due'=> 0,
                    'payment_date' => null,
                    'admission_date' => null,
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'User approved successfully.');
    }
    
    public function deny($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'denied';
        $user->save();
    
        return redirect()->back()->with('success', 'User denied successfully.');
    }
    
    public function calculateSalary($accessLevel) //changed to public
    {
        $salaries = [
            1 => 150000,  // Salary for access level 1
            2 => 100000,  // Salary for access level 2
            3 => 75000,   // Salary for access level 3
            4 => 50000,   // Salary for access level 4
        ];
    
        return $salaries[$accessLevel] ?? 0; // Default salary if level is missing
    }

    public function adminHome()
    {
        return view('adminHome');
    }

    //Employee and Patient Lists
    public function adminList()
    {
        $adminPatientList = User::where('status', 'approved')
                                ->where('role', 'Patient')
                                ->get();

        $adminEmployeeList = User::whereHas('employee')->with('employee')->get();
        $patientDetails = Patient::all();
        
    
        return view('adminList', [
            'adminPatientList' => $adminPatientList,
            'adminEmployeeList' => $adminEmployeeList,
            'patientDetails' => $patientDetails,
        ]);
    }
    
    public function submitSalary(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $authUser = auth()->user();
        $role = Role::where('role', $authUser->role)->first(); //added this lol -serena  
        
        if ($role->access_level !== 1) {
            return redirect()->route('adminlist')->withErrors(['error' => 'Supervisors cannot edit the salary.']);
        }
    
        $request->validate([
            'salary' => 'required|numeric|min:0',
        ]);
    
        $employee->salary = $request->input('salary');
        $employee->save();
    
        return redirect()->back()->with('success', 'Salary submitted successfully!');
    }


}




