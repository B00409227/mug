<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller handling legacy authentication functionality
 * Note: Consider migrating to AuthenticatedSessionController for consistency
 */
class LoginController extends Controller
{
    /**
     * Restrict access to logged-out users only, except for logout method
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle post-authentication logic
     * Redirects users to different dashboards based on their role:
     * - Admins go to admin dashboard
     * - Merchants go to merchant dashboard
     * - Regular users go to home
     */
    protected function authenticated(Request $request, $user)
    {
        // Route admin users to their dashboard
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        
        // Route merchant users to their dashboard
        if ($user->isMerchant()) {
            return redirect()->route('merchant.dashboard');
        }
        
        // Route regular users to the default home page
        return redirect()->route('home');
    }

    /**
     * Handle user logout
     * 1. Logs the user out
     * 2. Invalidates their session
     * 3. Regenerates the CSRF token
     * 4. Redirects to home page
     */
    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate and delete the user's session
        $request->session()->invalidate();

        // Generate a new CSRF token
        $request->session()->regenerateToken();

        // Redirect to home page
        return redirect('/');
    }
} 