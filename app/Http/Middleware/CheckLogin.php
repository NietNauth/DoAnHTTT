<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('maNguoiDung')) {
            return redirect()->route('login')->with('error', 'Bạn phải đăng nhập');
        }

        return $next($request);
    }
}
