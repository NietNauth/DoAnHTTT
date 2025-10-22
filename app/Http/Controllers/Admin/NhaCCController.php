<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\NhaCC;

class NhaCCController extends Controller
{
    // Hiển thị danh sách nhà cung cấp
    public function index()
    {
        $data = NhaCC::orderBy("maNCC", "desc")->paginate(10);
        return view("admin.nhacc.read", compact("data"));
    }

    // Form tạo nhà cung cấp mới
    public function create()
    {
        $action = url('nhacc/create-post');
        return view("admin.nhacc.create_update", compact('action'));
    }

    // Lưu nhà cung cấp mới
    public function createPost(Request $request)
    {
        $request->validate([
            'tenNCC' => 'required|string|max:150',
            'soDienThoai' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:100',
            'diaChi' => 'nullable|string|max:255',
            'nguoiLienHe' => 'nullable|string|max:100',
            'trangThai' => 'nullable|in:0,1',
        ]);

        // Sinh mã nhà cung cấp tự động
        $last = NhaCC::orderBy('maNCC', 'desc')->first();
        if ($last) {
            $lastNumber = (int) str_replace('NCC', '', $last->maNCC);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $maNCC = 'NCC' . $newNumber;

        $data = $request->only('tenNCC', 'soDienThoai', 'email', 'diaChi', 'nguoiLienHe', 'trangThai');
        $data['maNCC'] = $maNCC;
        $data['ngayTao'] = now();
        $data['ngayCapNhat'] = now();

        NhaCC::create($data);

        return redirect()->to('nhacc')
            ->with('success', 'Thêm nhà cung cấp thành công');
    }

    // Form cập nhật nhà cung cấp
    public function update($maNCC)
    {
        $record = NhaCC::findOrFail($maNCC);
        $action = url("nhacc/update-post/$maNCC");
        return view("admin.nhacc.create_update", compact('record', 'action'));
    }

    // Lưu cập nhật nhà cung cấp
    public function updatePost(Request $request, $maNCC)
    {
        $nhacc = NhaCC::findOrFail($maNCC);

        $request->validate([
            'tenNCC' => 'required|string|max:150',
            'soDienThoai' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:100',
            'diaChi' => 'nullable|string|max:255',
            'nguoiLienHe' => 'nullable|string|max:100',
            'trangThai' => 'nullable|in:0,1',
        ]);

        $data = $request->only('tenNCC', 'soDienThoai', 'email', 'diaChi', 'nguoiLienHe', 'trangThai');
        $data['ngayCapNhat'] = now();

        $nhacc->update($data);

        return redirect('nhacc')->with('success', 'Cập nhật nhà cung cấp thành công');
    }

    // Xóa nhà cung cấp
    public function delete($maNCC)
    {
        $nhacc = NhaCC::findOrFail($maNCC);
        $nhacc->delete();

        return redirect('nhacc')->with('success', 'Xóa nhà cung cấp thành công');
    }

    // Tìm kiếm nhà cung cấp
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = NhaCC::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('maNCC', 'LIKE', "%$keyword%")
                      ->orWhere('tenNCC', 'LIKE', "%$keyword%");
            })
            ->orderBy('maNCC', 'desc')
            ->paginate(10);

        $data->appends(['keyword' => $keyword]);

        return view("admin.nhacc.read", compact("data"));
    }

}
