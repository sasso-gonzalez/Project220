<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class DoctorMiddleware
// {
//     /**
//      * Handle an incoming request.
//      */
//     public function handle(Request $request, Closure $next)
//     {
//         if (Auth::check() && Auth::user()->role === 'doctor') {
//             return $next($request);
//         }

//         abort(403, 'Unauthorized access.');
//     }
// }

