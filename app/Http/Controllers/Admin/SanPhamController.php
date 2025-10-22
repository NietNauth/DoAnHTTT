<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SanPham;

class SanPhamController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $data = SanPham::orderBy("maSanPham", "desc")->paginate(10);
        return view("admin.sanpham.read", compact("data"));
    }

    // Form tạo sản phẩm mới
    public function create()
    {
        $action = url('sanpham/create-post');

        // Nếu muốn dropdown danh mục và nhà cung cấp
        $danhMucList = \App\Models\Admin\DanhMuc::where('trangThai', 1)->get();
        $nhaCCList = \App\Models\Admin\NhaCC::where('trangThai', 1)->get();

        return view("admin.sanpham.create_update", compact('action', 'danhMucList', 'nhaCCList'));
    }

    // Lưu sản phẩm mới
    public function createPost(Request $request)
    {
        $request->validate([
            'maSanPham' => 'required|string|max:20|unique:SanPham,maSanPham',
            'tenSanPham' => 'required|string|max:255',
            'moTa' => 'nullable|string',
            'giaGoc' => 'required|numeric|min:0',
            'maDanhMuc' => 'required|string|exists:DanhMuc,maDanhMuc',
            'maNCC' => 'required|string|exists:NhaCungCap,maNCC',
            'trangThai' => 'nullable|in:0,1',
        ]);

        $data = $request->only('maSanPham', 'tenSanPham', 'moTa', 'giaGoc', 'maDanhMuc', 'maNCC', 'trangThai');
        $data['ngayTao'] = now();
        $data['ngayCapNhat'] = now();

        SanPham::create($data);

        return redirect()->to('sanpham')
            ->with('success', 'Thêm sản phẩm thành công');
    }

    // Form cập nhật sản phẩm
    public function update($maSanPham)
    {
        $record = SanPham::findOrFail($maSanPham);
        $action = url("sanpham/update-post/$maSanPham");

        $danhMucList = \App\Models\Admin\DanhMuc::where('trangThai', 1)->get();
        $nhaCCList = \App\Models\Admin\NhaCC::where('trangThai', 1)->get();

        return view("admin.sanpham.create_update", compact('record', 'action', 'danhMucList', 'nhaCCList'));
    }

    // Lưu cập nhật sản phẩm
    public function updatePost(Request $request, $maSanPham)
    {
        $sanPham = SanPham::findOrFail($maSanPham);

        $request->validate([
            'tenSanPham' => 'required|string|max:255',
            'moTa' => 'nullable|string',
            'giaGoc' => 'required|numeric|min:0',
            'maDanhMuc' => 'required|string|exists:DanhMuc,maDanhMuc',
            'maNCC' => 'required|string|exists:NhaCungCap,maNCC',
            'trangThai' => 'nullable|in:0,1',
        ]);

        $data = $request->only('tenSanPham', 'moTa', 'giaGoc', 'maDanhMuc', 'maNCC', 'trangThai');
        $data['ngayCapNhat'] = now();

        $sanPham->update($data);

        return redirect('sanpham')->with('success', 'Cập nhật sản phẩm thành công');
    }

    // Xóa sản phẩm
    public function delete($maSanPham)
    {
        $sanPham = SanPham::findOrFail($maSanPham);
        $sanPham->delete();

        return redirect('sanpham')->with('success', 'Xóa sản phẩm thành công');
    }

    // Tìm kiếm sản phẩm
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = SanPham::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('maSanPham', 'LIKE', "%$keyword%")
                      ->orWhere('tenSanPham', 'LIKE', "%$keyword%");
            })
            ->orderBy('maSanPham', 'desc')
            ->paginate(10);

        $data->appends(['keyword' => $keyword]);

        return view("admin.sanpham.read", compact("data"));
    }

}
