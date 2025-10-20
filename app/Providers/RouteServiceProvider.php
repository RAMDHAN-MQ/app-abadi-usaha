<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes(function () {
            // Semua route di api.php akan punya prefix /api
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Semua route di web.php akan pakai middleware web
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
