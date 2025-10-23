<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class WebMiddleware
{
    public function handle($request, Closure $next)
    {
        // đảm bảo session được khởi tạo
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return $next($request);
    }
}
