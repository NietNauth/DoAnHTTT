<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SanPhamHinhAnh;
use Illuminate\Support\Str;

class SanPhamHinhAnhController extends Controller
{
    // Hiển thị danh sách hình ảnh sản phẩm
    public function index()
    {
        $data = SanPhamHinhAnh::orderBy("maSanPham", "desc")->paginate(10);
        return view("admin.sanpham_hinhanh.read", compact("data"));
    }

    // Form tạo hình ảnh mới
    public function create()
    {
        $action = url('sanpham-hinhanh/create-post');
        $sanPhamList = \App\Models\Admin\SanPham::all();
        return view("admin.sanpham_hinhanh.create_update", compact('action', 'sanPhamList'));
    }

    // Lưu hình ảnh mới
    public function createPost(Request $request)
    {
        $request->validate([
            'maSanPham' => 'required|string|max:20',
            'duongDan' => 'required|image|mimes:jpg,jpeg,png,gif,webp',
            'thuTu' => 'nullable|integer',
        ]);

        // Kiểm tra thứ tự trùng
        $exists = SanPhamHinhAnh::where('maSanPham', $request->maSanPham)
                    ->where('thuTu', $request->thuTu)
                    ->exists();

        if ($exists) {
            return back()->withErrors(['thuTu' => 'Thứ tự này đã tồn tại cho sản phẩm này'])->withInput();
        }

        $data = $request->only('maSanPham', 'thuTu');

        // Upload file ảnh
        if ($request->hasFile('duongDan')) {
            $file = $request->file('duongDan');
            $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/sanpham'), $filename);
            $data['duongDan'] = 'uploads/sanpham/' . $filename;
        }

        $data['ngayTao'] = now();
        $data['ngayCapNhat'] = now();

        SanPhamHinhAnh::create($data);

        return redirect()->to('sanpham-hinhanh')
            ->with('success', 'Thêm hình ảnh thành công');
    }

    // Form cập nhật hình ảnh
    public function update($maSPHA)
    {
        $record = SanPhamHinhAnh::findOrFail($maSPHA);
        $action = url("sanpham-hinhanh/update-post/$maSPHA");
        $sanPhamList = \App\Models\Admin\SanPham::all();
        return view("admin.sanpham_hinhanh.create_update", compact('record', 'action', 'sanPhamList'));
    }

    // Lưu cập nhật hình ảnh
    public function updatePost(Request $request, $maSPHA)
    {
        $request->validate([
            'maSanPham' => 'required|string|max:20',
            'duongDan' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp',
            'thuTu' => 'nullable|integer',
        ]);

        $record = SanPhamHinhAnh::findOrFail($maSPHA);

        // Kiểm tra thứ tự trùng
        $exists = SanPhamHinhAnh::where('maSanPham', $request->maSanPham)
                    ->where('thuTu', $request->thuTu)
                    ->where('maSPHA', '<>', $maSPHA)
                    ->exists();

        if ($exists) {
            return back()->withErrors(['thuTu' => 'Thứ tự này đã tồn tại cho sản phẩm này'])->withInput();
        }

        $data = $request->only('maSanPham', 'thuTu');

        // Nếu upload file mới, xóa file cũ và lưu file mới
        if ($request->hasFile('duongDan')) {
            if ($record->duongDan && file_exists(public_path($record->duongDan))) {
                unlink(public_path($record->duongDan));
            }
            $file = $request->file('duongDan');
            $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/sanpham'), $filename);
            $data['duongDan'] = 'uploads/sanpham/' . $filename;
        }

        $data['ngayCapNhat'] = now();

        $record->update($data);

        return redirect('sanpham-hinhanh')->with('success', 'Cập nhật hình ảnh thành công');
    }

    // Xóa hình ảnh
    public function delete($maSPHA)
    {
        $record = SanPhamHinhAnh::findOrFail($maSPHA);
        if ($record->duongDan && file_exists(public_path($record->duongDan))) {
            unlink(public_path($record->duongDan));
        }
        $record->delete();

        return redirect('sanpham-hinhanh')->with('success', 'Xóa hình ảnh thành công');
    }

    // Tìm kiếm hình ảnh
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = SanPhamHinhAnh::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('maSanPham', 'LIKE', "%$keyword%")
                      ->orWhere('duongDan', 'LIKE', "%$keyword%");
            })
            ->orderBy("maSanPham", "desc")
            ->paginate(10);

        $data->appends(['keyword' => $keyword]);

        return view("admin.sanpham_hinhanh.read", compact("data"));
    }
}
