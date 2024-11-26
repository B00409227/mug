<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Middleware to check if a user has a specific role
 * More flexible than individual role middlewares as it can check any role
 */
class CheckRole
{
    /**
     * Handle an incoming request
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role The role to check for
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if user is not logged in OR if their role doesn't match the required role
        if (!$request->user() || $request->user()->role !== $role) {
            // Return a 403 Forbidden response with message if unauthorized
            abort(403, 'Unauthorized action.');
        }

        // Allow the request to proceed if user has the correct role
        return $next($request);
    }
} 