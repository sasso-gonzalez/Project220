<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $accessLevel
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $accessLevel)
    {
        if (!auth()->check()) {
            return redirect('/'); // Redirect to login or homepage
        }

        $user = auth()->user();
        $role = Role::where('role', $user->role)->first(); // Retrieve the Role model based on the role string

        if (!$role) {
            abort(403, 'Role not found.'); // Return error if role is not found
        }

        if ($role->access_level != $accessLevel) {
            abort(403, 'Unauthorized access.'); // Return error if access levels don't match
        }

        return $next($request);
    }
}



// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;
// use App\Models\Role;

// class RoleMiddleware
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Closure  $next
//      * @param  int  $accessLevel
//      * @return \Symfony\Component\HttpFoundation\Response
//      */
//     public function handle(Request $request, Closure $next, $accessLevel)
//     {
//         if (!auth()->check()) {
//             return redirect('/'); // Redirect to login or homepage
//         }

//         $user = auth()->user();
//         $role = Role::where('role', $user->role)->first(); // Retrieve the Role model based on the role string

//         if (!$role || $role->access_level != $accessLevel) {
//             abort(403, 'Unauthorized access.'); // Return error if access levels don't match
//         }

//         return $next($request);
//     }
// }





















































// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;

// class RoleMiddleware
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Closure  $next
//      * @param  string  $role
//      * @return \Symfony\Component\HttpFoundation\Response
//      */
//     public function handle(Request $request, Closure $next, $role, $accessLevel)
//     {
//         if (!auth()->check()) {
//             return redirect('/'); // Redirect to login or homepage
//         }

//         $user = auth()->user();

//         if ($user->role->access_level != $accessLevel) {
//             abort(403, 'Unauthorized access.'); // Return error if roles or access levels don't match
//         }

//         return $next($request);
//     }
//     // public function handle(Request $request, Closure $next, $role)
//     // {
//     //     if (!auth()->check()) {
//     //         return redirect('/'); // If the user is authenticated then it should redirect to login or homepage.
//     //     }

//     //     if (auth()->user()->role !== $role) {
//     //         abort(403, 'Unauthorized access.'); // return error if roles don't match
//     //     }


//     //     //If the role matches, the request (should) continue
//     //     return $next($request);
//     // }
// }

?>
