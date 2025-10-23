<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ChamCong;
use App\Models\Admin\NhanVien;
use Carbon\Carbon;

class ChamCongController extends Controller
{
    public function index()
    {
        $data = ChamCong::orderBy('ngay', 'desc')->paginate(10);
        return view('admin.chamcong.read', compact('data'));
    }

    public function create()
    {
        $action = url('admin/chamcong/create-post');
        $nhanVienList = NhanVien::all();
        return view('admin.chamcong.create_update', compact('action', 'nhanVienList'));
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'maNhanVien' => 'required|exists:NhanVien,maNhanVien',
            'ngay' => 'required|date',
            'gioVao' => 'required|date_format:H:i',
            'gioRa' => 'required|date_format:H:i|after:gioVao',
            'soGioLam' => 'nullable|numeric|min:0',
            'soGioTangCa' => 'nullable|numeric|min:0',
            'trangThai' => 'required|in:Đi làm,Nghỉ phép,Nghỉ không phép',
            'ghiChu' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['ngayTao'] = Carbon::now();
        $data['ngayCapNhat'] = Carbon::now();

        ChamCong::create($data);

        return redirect('admin/chamcong')->with('success', 'Thêm chấm công thành công');
    }

    public function update($maChamCong)
    {
        $record = ChamCong::findOrFail($maChamCong);
        $action = url("admin/chamcong/update-post/$maChamCong");
        $nhanVienList = NhanVien::all();

        return view('admin.chamcong.create_update', compact('record', 'action', 'nhanVienList'));
    }

    public function updatePost(Request $request, $maChamCong)
    {
        $request->validate([
            'maNhanVien' => 'required|exists:NhanVien,maNhanVien',
            'ngay' => 'required|date',
            'gioVao' => 'required|date_format:H:i',
            'gioRa' => 'required|date_format:H:i|after:gioVao',
            'soGioLam' => 'nullable|numeric|min:0',
            'soGioTangCa' => 'nullable|numeric|min:0',
            'trangThai' => 'required|in:Đi làm,Nghỉ phép,Nghỉ không phép',
            'ghiChu' => 'nullable|string|max:255',
        ]);

        $record = ChamCong::findOrFail($maChamCong);
        $data = $request->all();
        $data['ngayCapNhat'] = Carbon::now();

        $record->update($data);

        return redirect('admin/chamcong')->with('success', 'Cập nhật chấm công thành công');
    }

    public function delete($maChamCong)
    {
        $record = ChamCong::findOrFail($maChamCong);
        $record->delete();

        return redirect('admin/chamcong')->with('success', 'Xóa chấm công thành công');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = ChamCong::where('maNhanVien', 'LIKE', "%$keyword%")
            ->orWhere('trangThai', 'LIKE', "%$keyword%")
            ->orderBy('ngay', 'desc')
            ->paginate(10);

        return view('admin.chamcong.read', compact('data'));
    }

    public function show($maChamCong)
    {
        $record = ChamCong::findOrFail($maChamCong);
        return view('admin.chamcong.show', compact('record'));
    }
}
