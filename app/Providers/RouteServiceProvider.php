<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    // Defines where users should be redirected after logging in
    // This constant is typically used by authentication systems
    public const HOME = '/mugs';

    public function boot(): void
    {
        // Set up API rate limiting
        // Limits API requests to 60 per minute per user (or IP address for guests)
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Register the application's routes
        $this->routes(function () {
            // API routes configuration
            // These routes will be prefixed with 'api' and use the 'api' middleware
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Web routes configuration
            // These routes will use the 'web' middleware group
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
