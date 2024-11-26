<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Middleware to restrict access to merchant-only routes
 */
class MerchantMiddleware
{
    /**
     * Handle an incoming request
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is not logged in OR if logged in user is not a merchant
        if (!auth()->check() || auth()->user()->role !== 'merchant') {
            // Return a 403 Forbidden response if unauthorized
            abort(403);
        }

        // Allow the request to proceed if user is a merchant
        return $next($request);
    }
}
