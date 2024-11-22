<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user
        $request->authenticate();

        $user = auth()->user();
        if ($user->status === 'N/A') {
            // should continue on past the else if, if true...
        }
        else if ($user->status !== "approved") {
            // Log out the user immediately
            auth()->logout();
    
            // Redirect back with an error message
            return back()->withErrors([
                'email' => __('Your account is not yet approved. Please contact support.'),
            ]);
        }

        // Regenerate the session to prevent session fixation
        $request->session()->regenerate();

        // After successful authentication, check the user's role and redirect
        $user = auth()->user();
        switch ($user->role) 
        {
            case 'admin':
                return redirect()->route('adminHome');
            case 'Doctor':
                return redirect()->route('doctorHome');
            case 'Patient':
                return redirect()->route('patientHome');
            case 'Caregiver':
                return redirect()->route('caregiverHome');
            case 'Supervisor':
                return redirect()->route('supervisorHome');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}