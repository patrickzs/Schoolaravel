<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home'; // [UPGRADE-FIX]

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void // [UPGRADE-FIX]
    {
        $this->configureRateLimiting(); // [UPGRADE-FIX]

        $this->routes(function () { // [UPGRADE-FIX]
            Route::middleware('api') // [UPGRADE-FIX]
                ->prefix('api') // [UPGRADE-FIX]
                ->namespace($this->namespace) // [UPGRADE-FIX]
                ->group(base_path('routes/api.php')); // [UPGRADE-FIX]

            Route::middleware('web') // [UPGRADE-FIX]
                ->namespace($this->namespace) // [UPGRADE-FIX]
                ->group(base_path('routes/web.php')); // [UPGRADE-FIX]
        }); // [UPGRADE-FIX]
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void // [UPGRADE-FIX]
    {
        RateLimiter::for('api', function (Request $request) { // [UPGRADE-FIX]
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip()); // [UPGRADE-FIX]
        }); // [UPGRADE-FIX]
    }
}
