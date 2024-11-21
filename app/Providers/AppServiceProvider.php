<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\DanhMuc;
use App\Observers\DanhMucObserver;
use App\Ray\AppModule;
use Ray\Di\DiInterface;
use Ray\Di\Injector;
use App\Services\SanPhamService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $injector = new Injector(new AppModule());
        $this->app->singleton(SanPhamService::class, function () use ($injector) {
            return $injector->getInstance(SanPhamService::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DanhMuc::observe(DanhMucObserver::class);
    }
}
