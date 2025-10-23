<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\NguoiDung;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Hiển thị form login
    public function showLoginForm()
    {
        return view('admin.auth.login'); // file Blade riêng
    }

    // Xử lý login
    public function login(Request $request)
    {
        $request->validate([
            'tenDangNhap' => 'required|string|max:50',
            'matKhau' => 'required|string',
        ]);

        $user = NguoiDung::where('tenDangNhap', $request->tenDangNhap)->first();

        if ($user && Hash::check($request->matKhau, $user->matKhau)) {
            // Lưu session
            session([
                'maNguoiDung' => $user->maNguoiDung,
                'tenDangNhap' => $user->tenDangNhap,
                'vaiTro' => $user->vaiTro
            ]);

            return redirect()->intended('/admin')->with('success', 'Đăng nhập thành công');
        }

        return back()->withErrors(['tenDangNhap' => 'Tên đăng nhập hoặc mật khẩu không đúng'])->withInput();
    }

    // Logout
    public function logout()
    {
        session()->flush();
        return redirect()->route('login')->with('success', 'Đăng xuất thành công');
    }
}
