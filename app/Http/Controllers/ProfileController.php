<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Fill the user with validated data
        $request->user()->fill($request->validated());
    
        // Manually set additional fields
        $request->user()->first_name = $request->input('first_name');
        $request->user()->last_name = $request->input('last_name');
        $request->user()->role = $request->input('role');
        $request->user()->phone = $request->input('phone');
        $request->user()->date_of_birth = $request->input('date_of_birth');
        $request->user()->status = $request->input('status'); //added
    
        // Check if a new password was provided, and update it if so
        if ($request->filled('password')) {
            $request->user()->password = bcrypt($request->input('password'));
        }
    
        // Clear email verification if email is changed
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
    
        // Save the updated user information
        $request->user()->save();
    
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    
    

    /**
    //  * Delete the user's account.
    //  */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
}