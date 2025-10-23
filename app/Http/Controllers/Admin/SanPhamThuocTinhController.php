<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SanPhamThuocTinh;
use Illuminate\Support\Str;

class SanPhamThuocTinhController extends Controller
{
    // Hiển thị danh sách thuộc tính sản phẩm
    public function index()
    {
        $data = SanPhamThuocTinh::orderBy("maSanPham", "desc")->paginate(10);
        return view("admin.sanpham_thuoctinh.read", compact("data"));
    }

    // Form tạo thuộc tính mới
    public function create()
    {
        $action = url('admin/sanpham-thuoctinh/create-post');
        $sanPhamList = \App\Models\Admin\SanPham::all();
        return view("admin.sanpham_thuoctinh.create_update", compact('action', 'sanPhamList'));
    }

    // Lưu thuộc tính mới
    public function createPost(Request $request)
    {
        $request->validate([
            'maSanPham' => 'required|string|max:20',
            'mauSac' => 'required|string|max:50',
            'soLuong' => 'required|integer|min:0',
        ]);

        // Kiểm tra màu trùng
        $exists = SanPhamThuocTinh::where('maSanPham', $request->maSanPham)
            ->where('mauSac', $request->mauSac)
            ->exists();

        if ($exists) {
            return back()->withErrors(['mauSac' => 'Màu này đã tồn tại cho sản phẩm này'])->withInput();
        }

        $data = $request->only('maSanPham', 'mauSac', 'soLuong');
        $data['ngayTao'] = now();
        $data['ngayCapNhat'] = now();

        SanPhamThuocTinh::create($data);

        return redirect()->to('admin/sanpham-thuoctinh')
            ->with('success', 'Thêm thuộc tính thành công');
    }

    // Form cập nhật thuộc tính
    public function update($maSPTT)
    {
        $record = SanPhamThuocTinh::findOrFail($maSPTT);
        $action = url("admin/sanpham-thuoctinh/update-post/$maSPTT");
        $sanPhamList = \App\Models\Admin\SanPham::all();
        return view("admin.sanpham_thuoctinh.create_update", compact('record', 'action', 'sanPhamList'));
    }

    // Lưu cập nhật thuộc tính
    public function updatePost(Request $request, $maSPTT)
    {
        $request->validate([
            'maSanPham' => 'required|string|max:20',
            'mauSac' => 'required|string|max:50',
            'soLuong' => 'required|integer|min:0',
        ]);

        $record = SanPhamThuocTinh::findOrFail($maSPTT);

        // Kiểm tra màu trùng
        $exists = SanPhamThuocTinh::where('maSanPham', $request->maSanPham)
            ->where('mauSac', $request->mauSac)
            ->where('maSPTT', '<>', $maSPTT)
            ->exists();

        if ($exists) {
            return back()->withErrors(['mauSac' => 'Màu này đã tồn tại cho sản phẩm này'])->withInput();
        }

        $data = $request->only('maSanPham', 'mauSac', 'soLuong');
        $data['ngayCapNhat'] = now();

        $record->update($data);

        return redirect('admin/sanpham-thuoctinh')->with('success', 'Cập nhật thuộc tính thành công');
    }

    // Xóa thuộc tính
    public function delete($maSPTT)
    {
        $record = SanPhamThuocTinh::findOrFail($maSPTT);
        $record->delete();

        return redirect('admin/sanpham-thuoctinh')->with('success', 'Xóa thuộc tính thành công');
    }

    // Tìm kiếm thuộc tính
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = SanPhamThuocTinh::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('maSanPham', 'LIKE', "%$keyword%")
                    ->orWhere('mauSac', 'LIKE', "%$keyword%");
            })
            ->orderBy("maSanPham", "desc")
            ->paginate(10);

        $data->appends(['keyword' => $keyword]);

        return view("admin.sanpham_thuoctinh.read", compact("data"));
    }

    public function addSoLuong($maSPTT)
    {
        $record = SanPhamThuocTinh::findOrFail($maSPTT); // Lấy thông tin thuộc tính

        $action = url("admin/sanpham-thuoctinh/add-so-luong/$maSPTT"); // URL submit POST

        return view("admin.sanpham_thuoctinh.add-so-luong", compact('record', 'action'));
    }

    public function addSoLuongPost(Request $request, $maSPTT)
    {
        $request->validate([
            'soLuongThem' => 'required|integer|min:1', // số lượng muốn thêm
        ]);

        $record = SanPhamThuocTinh::findOrFail($maSPTT);

        // Cộng số lượng hiện tại với số lượng thêm
        $record->soLuong += $request->soLuongThem;
        $record->ngayCapNhat = now();

        $record->save();

        return redirect('admin/sanpham-thuoctinh')->with('success', 'Cập nhật số lượng thành công');
    }

}
