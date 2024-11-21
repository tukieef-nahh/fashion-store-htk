<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // protected function redirectTo(Request $request): ?string
    // {
    //     return $request->expectsJson() ? null : route('login');
    // }

    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            // Gửi thông báo vào session trước khi chuyển hướng
            session()->flash('error', 'Bạn cần đăng nhập để truy cập vào trang này.');
            return route('login');
        }

        return null;
    }
}
