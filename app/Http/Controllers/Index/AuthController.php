<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\NguoiDung;
use App\Models\Admin\VaiTro;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/')->with('info', 'Bạn đã đăng nhập rồi.');
        }

        return view('index.main.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'tenDangNhap' => 'required|string',
            'matKhau' => 'required|string',
        ]);

        $user = NguoiDung::where('tenDangNhap', $request->tenDangNhap)
            ->whereHas('role', function ($query) {
                $query->where('tenVaiTro', 'Khách hàng');
            })
            ->first();

        if ($user && Hash::check($request->matKhau, $user->matKhau)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'tenDangNhap' => 'Tên đăng nhập hoặc mật khẩu không đúng.',
        ])->onlyInput('tenDangNhap');
    }

    // Hiển thị form đăng ký
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/')->with('info', 'Bạn đã đăng nhập rồi.');
        }

        return view('index.main.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'hoTen' => 'required|string|max:100',
            'tenDangNhap' => 'required|string|max:50|unique:NguoiDung,tenDangNhap',
            'matKhau' => 'required|string|min:6|confirmed',
        ]);

        $vaiTro = VaiTro::where('tenVaiTro', 'Khách hàng')->first();

        $user = new NguoiDung();
        $user->hoTen = $request->hoTen;
        $user->tenDangNhap = $request->tenDangNhap;
        $user->email = $request->email;
        $user->matKhau = Hash::make($request->matKhau);
        $user->maVaiTro = $vaiTro ? $vaiTro->maVaiTro : null;
        $user->save();

        Auth::login($user);

        return redirect('/')->with('success', 'Đăng ký tài khoản thành công!');
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Bạn đã đăng xuất thành công.');
    }
}
