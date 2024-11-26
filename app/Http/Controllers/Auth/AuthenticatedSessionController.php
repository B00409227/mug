<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Controller handling user authentication sessions including login, logout, and redirections
 */
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     * Returns the login form page to the user.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     * Processes the login attempt and redirects users based on their role:
     * - Admins go to admin dashboard
     * - Merchants go to merchant dashboard
     * - Regular users go to home
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Attempt authentication using credentials
        $request->authenticate();

        // Generate a new session ID to prevent session fixation attacks
        $request->session()->regenerate();

        /** @var User $user */
        $user = Auth::user();
        
        // Route admin users to their dashboard
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        }

        // Route merchant users to their dashboard
        if ($user->role === 'merchant') {
            return redirect()->intended(route('merchant.dashboard'));
        }

        // Route regular users to the default home page
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     * Handles the logout process by:
     * 1. Logging the user out
     * 2. Invalidating their session
     * 3. Regenerating the CSRF token
     * 4. Redirecting to home page
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log the user out
        Auth::guard('web')->logout();

        // Invalidate and delete the user's session
        $request->session()->invalidate();

        // Generate a new CSRF token
        $request->session()->regenerateToken();

        // Redirect to home page
        return redirect('/');
    }
}
