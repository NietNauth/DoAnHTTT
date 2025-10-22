<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\DanhMuc;

class DanhMucController extends Controller
{
    // Hiển thị danh sách danh mục
    public function index()
    {
        $data = DanhMuc::orderBy("maDanhMuc", "desc")->paginate(10);
        return view("admin.danhmuc.read", compact("data"));
    }

    // Form tạo danh mục mới
    public function create()
    {
        $action = url('danhmuc/create-post');
        return view("admin.danhmuc.create_update", compact('action'));
    }

    // Lưu danh mục mới
    public function createPost(Request $request)
    {
        $request->validate([
            'tenDanhMuc' => 'required|string|max:100',
            'moTa' => 'nullable|string',
            'trangThai' => 'nullable|in:0,1',
        ]);

        // Sinh mã danh mục tự động
        $last = DanhMuc::orderBy('maDanhMuc', 'desc')->first();
        if ($last) {
            $lastNumber = (int) str_replace('DM', '', $last->maDanhMuc);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $maDanhMuc = 'DM' . $newNumber;

        $data = $request->only('tenDanhMuc', 'moTa', 'trangThai');
        $data['maDanhMuc'] = $maDanhMuc;
        $data['ngayTao'] = now();
        $data['ngayCapNhat'] = now();

        DanhMuc::create($data);

        return redirect()->to('danhmuc')
            ->with('success', 'Thêm danh mục thành công');
    }

    // Form cập nhật danh mục
    public function update($maDanhMuc)
    {
        $record = DanhMuc::findOrFail($maDanhMuc);
        $action = url("danhmuc/update-post/$maDanhMuc");
        return view("admin.danhmuc.create_update", compact('record', 'action'));
    }

    // Lưu cập nhật danh mục
    public function updatePost(Request $request, $maDanhMuc)
    {
        $danhMuc = DanhMuc::findOrFail($maDanhMuc);

        $request->validate([
            'tenDanhMuc' => 'required|string|max:100',
            'moTa' => 'nullable|string',
            'trangThai' => 'nullable|in:0,1',
        ]);

        $data = $request->only('tenDanhMuc', 'moTa', 'trangThai');
        $data['ngayCapNhat'] = now();

        $danhMuc->update($data);

        return redirect('danhmuc')->with('success', 'Cập nhật danh mục thành công');
    }

    // Xóa danh mục
    public function delete($maDanhMuc)
    {
        $danhMuc = DanhMuc::findOrFail($maDanhMuc);
        $danhMuc->delete();

        return redirect('danhmuc')->with('success', 'Xóa danh mục thành công');
    }

    // Tìm kiếm danh mục
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = DanhMuc::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('maDanhMuc', 'LIKE', "%$keyword%")
                      ->orWhere('tenDanhMuc', 'LIKE', "%$keyword%");
            })
            ->orderBy('maDanhMuc', 'desc')
            ->paginate(10);

        $data->appends(['keyword' => $keyword]);

        return view("admin.danhmuc.read", compact("data"));
    }
    
}
