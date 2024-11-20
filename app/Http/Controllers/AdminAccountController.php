<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        $user->status = 'approved';
        $user->save();

        return redirect()->back()->with('success', 'User approved successfully.');
    }

    /**
     * Deny a user account.
     */
    public function deny($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'denied';
        $user->save();

        return redirect()->back()->with('success', 'User denied successfully.');
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
    
        $adminEmployeeList = User::where('status', 'approved')
                                 ->whereIn('role', ['Caregiver', 'Doctor', 'Supervisor'])
                                 ->get();
    
        return view('adminList', [
            'adminPatientList' => $adminPatientList,
            'adminEmployeeList' => $adminEmployeeList
        ]);
    }
    // public function submitSalary(Request $request, $id) //Working on this
    // {
    //     // Validate the input
    //     $request->validate([
    //         'salary' => 'required|numeric|min:0',
    //     ]);
    
    //     // Find the employee and update the salary
    //     $employee = Employee::findOrFail($id);
    //     $employee->salary = $request->input('salary');
    //     $employee->save();
    
    //     return redirect()->back()->with('success', 'Salary submitted successfully!');
    // }
    
    
}
