<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return redirect('/'); // If the user is authenticated then it should redirect to login or homepage.
        }

        if (auth()->user()->role !== $role) {
            abort(403, 'Unauthorized access.'); // return error if roles don't match
        }


        //If the role matches, the request (should) continue
        return $next($request);
    }
}


// class RoleMiddleware
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      * 
//      */
//     public function handle(Request $request, Closure $next, $role)
//     {
//         if (!auth()->check()) {
//             return redirect('/'); // Redirect to the home page if the user doesn't have the correct role
//         }

//         if(auth()-> user()->role == $role){ //Isaiah changed
//             return redirect('/admin');
//         }

//     } 
// } 

?>
