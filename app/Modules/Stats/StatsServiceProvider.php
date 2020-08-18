<?php

namespace App\Modules\Stats;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class StatsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerWebRoutes();
        $this->loadViewsFrom(__DIR__.'/Views/','stats');
        $this->loadMigrationsFrom(__DIR__.'/DB/migrations');
        $this->loadFactoriesFrom(__DIR__.'/DB/Factories');
    }

    private function registerWebRoutes()
    {
        Route::prefix('stats')
            ->namespace('App\Modules\Stats\Controllers')
            ->name('stats')
            ->middleware([
                'web',
               // 'auth',
            ])
            ->group(
            function () {
                include __DIR__.'/stats-web.php';
            }
        );
    }
}
