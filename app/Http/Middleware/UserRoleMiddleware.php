<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// use Auth;
// use App\Http\Middleware\Auth;
use Illuminate\Support\Facades\Auth;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // if (Auth::check() && Auth::user()->role == $role) {
        //     return $next($request);
        // }
        if (Auth::check()) {
            $userRole = Auth::user()->role;
            if (
                $userRole == "admin" ||
                ($userRole == "editor" && $role == "user") ||
                $userRole == $role
            ) {
                return $next($request);
            }
        }

        // return response()->json([
        //     "You don't have permission to access this page.",
        // ]);

        return redirect()->route("errors/page-404");
    }
}
