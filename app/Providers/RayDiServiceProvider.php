<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Ray\RayDiBridge;
use App\Ray\AppModule;

class RayDiServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Create Ray.Di Bridge
        $rayDiBridge = new RayDiBridge(new AppModule());

        // Bind Ray.Di into Laravel container
        $this->app->singleton('ray.di', function () use ($rayDiBridge) {
            return $rayDiBridge;
        });

        // Example: Resolve a service and bind it to Laravel container
        $this->app->bind('App\Services\SanPhamService', function () use ($rayDiBridge) {
            return $rayDiBridge->get('App\Services\SanPhamService');
        });
    }

    public function boot()
    {
        //
    }
}
