<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        
        if (Auth::check()) {

            foreach ($roles as $role) {
                if (Auth::user()->hasRole($role)) {
                    return $next($request); 
                }
            }
        }

        
        return response()->view('errors.error', ["error"=>"You do not have the necessary roles to access this resource."], 403);

    }
}