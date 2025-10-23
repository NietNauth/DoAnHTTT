<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\NguoiDung;
use App\Models\Admin\VaiTro;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'tenDangNhap' => 'required|string',
            'matKhau' => 'required|string',
        ]);

        // 1️⃣ Tìm người dùng
        $user = NguoiDung::where('tenDangNhap', $request->tenDangNhap)->first();

        if (!$user || !Hash::check($request->matKhau, $user->matKhau)) {
            return back()->withErrors([
                'tenDangNhap' => 'Tên đăng nhập hoặc mật khẩu không đúng.',
            ])->onlyInput('tenDangNhap');
        }

        // 2️⃣ Kiểm tra vai trò
        $vaiTro = VaiTro::find($user->vaiTro);

        if (!$vaiTro || $vaiTro->tenVaiTro !== 'Admin') {
            return back()->withErrors([
                'tenDangNhap' => 'Tài khoản này không có quyền truy cập trang quản trị.',
            ]);
        }

        // 3️⃣ Lưu session
        session([
            'admin_logged_in' => true,
            'admin_id' => $user->maNguoiDung,
            'admin_name' => $user->tenDangNhap,
            'admin_role' => $vaiTro->tenVaiTro,
        ]);

        return redirect('admin')->with('success', 'Đăng nhập thành công!');
    }

    // Đăng xuất
    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_id', 'admin_name', 'admin_role']);
        return redirect('admin/login')->with('success', 'Đăng xuất thành công!');
    }
}
