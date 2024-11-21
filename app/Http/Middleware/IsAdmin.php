<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }

        //return redirect('/home')->with('error', 'Bạn chưa có quyền để thực hiện hành động này!');
        return response()->json(['error' => 'Bạn chưa có quyền để thực hiện hành động này!'], 403);
    }
}
