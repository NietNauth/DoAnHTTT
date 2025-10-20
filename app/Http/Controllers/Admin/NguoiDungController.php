<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\NguoiDung;
use App\Models\Admin\VaiTro;

class NguoiDungController extends Controller
{
    public function index()
    {
        $data = NguoiDung::orderBy("maNguoiDung", "desc")->paginate(10);
        return view("admin.nguoidung.read", compact("data"));
    }

    public function create()
    {
        $action = url('nguoidung/create-post');
        $vaiTroList = VaiTro::all();
        return view("admin.nguoidung.create_update", compact('action', 'vaiTroList'));
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'tenDangNhap' => 'required|string|max:50|unique:NguoiDung,tenDangNhap',
            'matKhau' => 'required|string|max:255',
            'vaiTro' => 'required|integer|exists:VaiTro,maVaiTro',
        ]);

        $data = $request->only('tenDangNhap', 'vaiTro');
        $data['matKhau'] = bcrypt($request->matKhau);

        NguoiDung::create($data);

        return redirect()->to('nguoidung')
            ->with('success', 'Thêm người dùng thành công');
    }

    public function update($maNguoiDung)
    {
        $record = NguoiDung::findOrFail($maNguoiDung);
        $action = url("nguoidung/update-post/$maNguoiDung");
        $vaiTroList = VaiTro::all(); // danh sách vai trò để chọn
        return view("admin.nguoidung.create_update", compact('record', 'action', 'vaiTroList'));
    }

    public function updatePost(Request $request, $maNguoiDung)
    {
        $nguoiDung = NguoiDung::findOrFail($maNguoiDung);

        $request->validate([
            'tenDangNhap' => 'required|string|max:50|unique:NguoiDung,tenDangNhap,' . ($maNguoiDung ?? '') . ',maNguoiDung',
            'matKhau' => isset($maNguoiDung) ? 'nullable|string|max:255' : 'required|string|max:255',
            'vaiTro' => 'required|integer|exists:VaiTro,maVaiTro',
        ]);

        $data = $request->only('tenDangNhap', 'vaiTro');
        if ($request->filled('matKhau')) {
            $data['matKhau'] = bcrypt($request->matKhau);
        }

        $nguoiDung->update($data);

        return redirect('nguoidung')->with('success', 'Cập nhật người dùng thành công');
    }

    public function delete($maNguoiDung)
    {
        $nguoiDung = NguoiDung::findOrFail($maNguoiDung);
        $nguoiDung->delete();

        return redirect('nguoidung')->with('success', 'Xóa người dùng thành công');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = NguoiDung::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('maNguoiDung', 'LIKE', "%$keyword%")
                    ->orWhere('tenDangNhap', 'LIKE', "%$keyword%");
            })
            ->orderBy('maNguoiDung', 'desc')
            ->paginate(10);

        $data->appends(['keyword' => $keyword]);

        return view("admin.nguoidung.read", compact("data"));
    }

}
