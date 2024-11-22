<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;//was missing this :| -serena
use App\Models\Patient;//was missing this :| -serena
use Illuminate\Http\Request;
use App\Models\Role;


class AdminAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        else if ($role->access_level === 5) { // Use $role->access_level instead of $user->access_level
            $existingPatient = Patient::where('user_id', $user->id)->first(); 
            if (!$existingPatient) {
                Patient::create([
                    'user_id' => $user->id, 
                    'family_code' => $user->family_code,
                    'caregroup' => null,
                    'amount_due'=> 0,
                    'payment_date' => now(),
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
        
    
        return view('adminList', [
            'adminPatientList' => $adminPatientList,
            'adminEmployeeList' => $adminEmployeeList
        ]);
    }
    public function submitSalary(Request $request, $id) //Working on this -serena
    {
        // Validate the input
        $request->validate([
            'salary' => 'required|numeric|min:0',
        ]);
    
        // Finds the employee and updates their salary
        $employee = Employee::findOrFail($id);
        $employee->salary = $request->input('salary');
        $employee->save();
    
        return redirect()->back()->with('success', 'Salary submitted successfully!');
    }
    
    
}




// public function approve($id) //just in case i mess something up -serena
// {
//     $user = User::findOrFail($id);

//     $role = Role::where('role', $user->access_level)->first();

//     if (!$role) {
//         return redirect()->back()->withErrors(['error' => 'Role not found for this user.']);
//     }

//     $user->status = 'approved';
//     $user->save();

//     if ($user->access_level <= 4) {
//         // Push data to the employees table
//         Employee::create([
//             'user_id' => $user->id,
//             'salary' => $this->calculateSalary($role->access_level), // Dynamically set a salary
//         ]);
//     }

    

//     return redirect()->back()->with('success', 'User approved successfully.');
// }


// private function calculateSalary($accessLevel)
// {
//     $salaries = [
//         1 => 150000,  // Salary for access level 1
//         2 => 100000,  // Salary for access level 2
//         3 => 75000,  // Salary for access level 3
//         4 => 50000,  // Salary for access level 4
//     ];

//     return $salaries[$accessLevel] ?? 0; // Default salary if level is missing
// }




///////////////////////////////////////////////////////////////////////////////////////////////

// public function approve($id)
// {
//     $user = User::findOrFail($id);
//     $role = Role::where('role', $user->access_level)->first();

//     if (!$role) {
//         return redirect()->back()->withErrors(['error' => 'Role not found for this user.']);
//     }

//     $user->status = 'approved';
//     $user->save();

//     if ($user->access_level <= 4) {
//         $existingEmployee = Employee::where('user_id', $user->id)->first();
//         if (!$existingEmployee) {
//             Employee::create([
//                 'user_id' => $user->id,
//                 'salary' => $this->calculateSalary($role->access_level),
//             ]);
//         }
//     }

//     return redirect()->back()->with('success', 'User approved successfully.');
// }


// private function calculateSalary($accessLevel)
// {
//     $salaries = [
//         1 => 150000,  // Salary for access level 1
//         2 => 100000,  // Salary for access level 2
//         3 => 75000,  // Salary for access level 3
//         4 => 50000,  // Salary for access level 4
//     ];

//     return $salaries[$accessLevel] ?? 0; // Default salary if level is missing
// }
// /**
//  * Deny a user account.
//  */
// public function deny($id)
// {
//     $user = User::findOrFail($id);
//     $user->status = 'denied';
//     $user->save();

//     return redirect()->back()->with('success', 'User denied successfully.');
// }