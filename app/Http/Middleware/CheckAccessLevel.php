<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccessLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Ensure the user is logged in
        if (Auth::check()) {
            $user = Auth::user();
            
            // Check access level (Assume 'access_level' is a column in your users table)
            if (!$this->hasAccess($user, $request->route())) {
                return redirect()->route('unauthorized')->with('error', 'You do not have access to this page.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        return $next($request);
    }

    /**
     * Determine if the user has access to the route.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Routing\Route  $route
     * @return bool
     */
    private function hasAccess($user, $route)
    {
        // Example: Check access level based on route name or other criteria
        $routeName = $route->getName();

        // Define access levels for routes
        $accessRules = [
            'admin.*' => 5,  // Example: Only access level 5 can access 'admin.*' routes
            'user.*'  => 1,  // Example: Access level 1 and above can access 'user.*' routes
        ];

        foreach ($accessRules as $pattern => $requiredLevel) {
            if (\Str::is($pattern, $routeName) && $user->access_level < $requiredLevel) {
                return false;
            }
        }

        return true; // Default to allowing access if no rule matches
    }
}
