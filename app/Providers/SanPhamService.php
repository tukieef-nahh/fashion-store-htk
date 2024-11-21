<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use App\Models\SanPham;

class SanPhamService extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        SanPham::retrieved(function ($sanphams) {
            Cache::remember("sanpham_{$sanphams->id}", 3600, function () use ($sanphams) {
                return $sanphams;
            });
        });
    }
}
