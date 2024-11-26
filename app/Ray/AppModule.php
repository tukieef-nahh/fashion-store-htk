<?php

namespace App\Ray;

use Ray\Di\AbstractModule;
use App\Services\SanPhamService;
use App\Aspects\LoggingInterceptor;

class AppModule extends AbstractModule
{
    protected function configure()
    {
        // Bind SanPhamService
        $this->bind(SanPhamService::class);

        // Apply LoggingInterceptor to SanPhamService methods
        $this->bindInterceptor(
            $this->matcher->subclassesOf(SanPhamService::class), 
            $this->matcher->any(), // Chặn mọi phương thức
            [LoggingInterceptor::class] // Sử dụng LoggingInterceptor
        );
    }
}
