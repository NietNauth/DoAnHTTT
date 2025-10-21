<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\KhachHang;
use App\Models\Admin\NguoiDung; // để lấy danh sách người dùng nếu cần

class KhachHangController extends Controller
{
    public function index()
    {
        $data = KhachHang::orderBy("maKhachHang", "desc")->paginate(10);
        return view("admin.khachhang.read", compact("data"));
    }

    public function create()
    {
        $action = url('khachhang/create-post');
        $nguoiDungList = NguoiDung::all(); // nếu KhachHang liên quan đến NguoiDung
        return view("admin.khachhang.create_update", compact('action', 'nguoiDungList'));
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'maNguoiDung' => 'nullable|integer|exists:NguoiDung,maNguoiDung',
            'hoTen' => 'required|string|max:100',
            'soDienThoai' => 'required|string|max:20',
            'email' => 'nullable|string|email|max:100|unique:KhachHang,email',
            'diaChi' => 'nullable|string|max:255',
        ]);

        $lastKhachHang = KhachHang::orderBy('maKhachHang', 'desc')->first();
        if ($lastKhachHang) {
            $lastNumber = (int) str_replace('KH', '', $lastKhachHang->maKhachHang);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $maKhachHang = 'KH' . $newNumber;

        $data = $request->only('maNguoiDung', 'hoTen', 'soDienThoai', 'email', 'diaChi');
        $data['maKhachHang'] = $maKhachHang;

        KhachHang::create($data);

        return redirect()->to('khachhang')
            ->with('success', 'Thêm khách hàng thành công');
    }


    public function update($maKhachHang)
    {
        $record = KhachHang::findOrFail($maKhachHang);
        $action = url("khachhang/update-post/$maKhachHang");
        $nguoiDungList = NguoiDung::all(); // nếu cần chọn người dùng
        return view("admin.khachhang.create_update", compact('record', 'action', 'nguoiDungList'));
    }

    public function updatePost(Request $request, $maKhachHang)
    {
        $khachHang = KhachHang::findOrFail($maKhachHang);

        $request->validate([
            'maNguoiDung' => 'nullable|integer|exists:NguoiDung,maNguoiDung',
            'hoTen' => 'required|string|max:100',
            'soDienThoai' => 'required|string|max:20',
            'email' => 'nullable|string|email|max:100|unique:KhachHang,email,' . $maKhachHang . ',maKhachHang',
            'diaChi' => 'nullable|string|max:255',
        ]);

        $data = $request->only('maNguoiDung', 'hoTen', 'soDienThoai', 'email', 'diaChi');
        $khachHang->update($data);

        return redirect('khachhang')->with('success', 'Cập nhật khách hàng thành công');
    }

    public function delete($maKhachHang)
    {
        $khachHang = KhachHang::findOrFail($maKhachHang);
        $khachHang->delete();

        return redirect('khachhang')->with('success', 'Xóa khách hàng thành công');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = KhachHang::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('maKhachHang', 'LIKE', "%$keyword%")
                    ->orWhere('hoTen', 'LIKE', "%$keyword%")
                    ->orWhere('email', 'LIKE', "%$keyword%");
            })
            ->orderBy('maKhachHang', 'desc')
            ->paginate(10);

        $data->appends(['keyword' => $keyword]);

        return view("admin.khachhang.read", compact("data"));
    }
}
