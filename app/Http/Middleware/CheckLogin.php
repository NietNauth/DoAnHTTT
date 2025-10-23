<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('admin_logged_in')) {
            return redirect()->to('admin/login')->with('error', 'Bạn phải đăng nhập');
        }

        return $next($request);
    }

}
