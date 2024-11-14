<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogSanPhamActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    //Advice
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user) {
            $action = $request->route()->getActionMethod();
            $route = $request->path();

            Log::info("Activity: {$user->name} (ID: {$user->id}) đã thực hiện thao tác {$action} trên route {$route}.");
        }

        return $next($request);
    }
}
