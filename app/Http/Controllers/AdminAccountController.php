<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminAccountController extends Controller
{
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
    
}
