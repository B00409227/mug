<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

/**
 * HTTP Kernel class that defines middleware stacks and groups
 * This is where all middleware configurations are registered
 */
class Kernel extends HttpKernel
{
    /**
     * Global middleware stack applied to all HTTP requests
     * These run in order for every request to the application
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,              // Handle trusted proxy headers
        \Illuminate\Http\Middleware\HandleCors::class,         // Handle CORS requests
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class, // Block requests during maintenance
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class, // Validate request size
        \App\Http\Middleware\TrimStrings::class,              // Trim whitespace from strings
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class, // Convert empty strings to null
    ];

    /**
     * Middleware groups that can be assigned to routes
     * 'web' group includes session handling and CSRF protection
     * 'api' group includes rate limiting and bindings
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,        // Encrypt/decrypt cookies
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, // Add queued cookies
            \Illuminate\Session\Middleware\StartSession::class, // Start session handling
            \Illuminate\View\Middleware\ShareErrorsFromSession::class, // Share errors with views
            \App\Http\Middleware\VerifyCsrfToken::class,       // CSRF protection
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Route model binding
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api', // Rate limiting
            \Illuminate\Routing\Middleware\SubstituteBindings::class,      // Route model binding
        ],
    ];

    /**
     * Middleware aliases for convenient route assignment
     * These can be used individually in routes using middleware('alias')
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,    // Basic authentication
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class, // HTTP Basic Auth
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,  // Session auth
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,        // Cache control
        'can' => \Illuminate\Auth\Middleware\Authorize::class, // Gate authorization
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,              // Guest only access
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,     // Password confirmation
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,                   // Signed URL validation
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,        // Rate limiting
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,      // Email verification
    ];

    /**
     * Route middleware for role-based access control
     * These middleware check user roles for restricted areas
     */
    protected $routeMiddleware = [
        // ... other middlewares ...
        'admin' => \App\Http\Middleware\AdminMiddleware::class,      // Admin access only
        'merchant' => \App\Http\Middleware\MerchantMiddleware::class, // Merchant access only
        'role' => \App\Http\Middleware\CheckRole::class,             // Generic role checking
    ];
}
