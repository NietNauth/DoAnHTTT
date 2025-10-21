<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\NhanVien;
use App\Models\Admin\NguoiDung;
use App\Models\Admin\ChucVu;

class NhanVienController extends Controller
{
    public function index()
    {
        $data = NhanVien::orderBy("maNhanVien", "desc")->paginate(10);
        return view("admin.nhanvien.read", compact("data"));
    }

    public function create()
    {
        $action = url('nhanvien/create-post');
        $nguoiDungList = NguoiDung::all();
        $chucVuList = ChucVu::all();
        return view("admin.nhanvien.create_update", compact('action', 'nguoiDungList', 'chucVuList'));
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'maNguoiDung' => 'nullable|integer|exists:NguoiDung,maNguoiDung',
            'hoTen' => 'required|string|max:100',
            'soDienThoai' => 'required|string|max:20',
            'email' => 'nullable|string|email|max:100|unique:NhanVien,email',
            'diaChi' => 'nullable|string|max:255',
            'ngaySinh' => 'nullable|date',
            'gioiTinh' => 'nullable|in:Nam,Nữ,Khác',
            'maChucVu' => 'nullable|integer|exists:ChucVu,maChucVu',
            'ngayVaoLam' => 'nullable|date',
            'trangThai' => 'nullable|in:0,1',
            'luongCoBan' => 'nullable|numeric|min:0',
            'phuCap' => 'nullable|numeric|min:0',
        ]);

        // Sinh mã nhân viên tự động
        $lastNhanVien = NhanVien::orderBy('maNhanVien', 'desc')->first();
        if ($lastNhanVien) {
            $lastNumber = (int) str_replace('NV', '', $lastNhanVien->maNhanVien);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $maNhanVien = 'NV' . $newNumber;

        $data = $request->only(
            'maNguoiDung',
            'hoTen',
            'soDienThoai',
            'email',
            'diaChi',
            'ngaySinh',
            'gioiTinh',
            'maChucVu',
            'ngayVaoLam',
            'trangThai',
            'luongCoBan',
            'phuCap'
        );
        $data['maNhanVien'] = $maNhanVien;
        $data['ngayTao'] = now();
        $data['ngayCapNhat'] = now();

        NhanVien::create($data);

        return redirect()->to('nhanvien')
            ->with('success', 'Thêm nhân viên thành công');
    }

    public function update($maNhanVien)
    {
        $record = NhanVien::findOrFail($maNhanVien);
        $action = url("nhanvien/update-post/$maNhanVien");
        $nguoiDungList = NguoiDung::all();
        $chucVuList = ChucVu::all();
        return view("admin.nhanvien.create_update", compact('record', 'action', 'nguoiDungList', 'chucVuList'));
    }

    public function updatePost(Request $request, $maNhanVien)
    {
        $nhanVien = NhanVien::findOrFail($maNhanVien);

        $request->validate([
            'maNguoiDung' => 'nullable|integer|exists:NguoiDung,maNguoiDung',
            'hoTen' => 'required|string|max:100',
            'soDienThoai' => 'required|string|max:20',
            'email' => 'nullable|string|email|max:100|unique:NhanVien,email,' . $maNhanVien . ',maNhanVien',
            'diaChi' => 'nullable|string|max:255',
            'ngaySinh' => 'nullable|date',
            'gioiTinh' => 'nullable|in:Nam,Nữ,Khác',
            'maChucVu' => 'nullable|integer|exists:ChucVu,maChucVu',
            'ngayVaoLam' => 'nullable|date',
            'trangThai' => 'nullable|in:0,1',
            'luongCoBan' => 'nullable|numeric|min:0',
            'phuCap' => 'nullable|numeric|min:0',
        ]);

        $data = $request->only(
            'maNguoiDung',
            'hoTen',
            'soDienThoai',
            'email',
            'diaChi',
            'ngaySinh',
            'gioiTinh',
            'maChucVu',
            'ngayVaoLam',
            'trangThai',
            'luongCoBan',
            'phuCap'
        );
        $data['ngayCapNhat'] = now();

        $nhanVien->update($data);

        return redirect('nhanvien')->with('success', 'Cập nhật nhân viên thành công');
    }

    public function delete($maNhanVien)
    {
        $nhanVien = NhanVien::findOrFail($maNhanVien);
        $nhanVien->delete();

        return redirect('nhanvien')->with('success', 'Xóa nhân viên thành công');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = NhanVien::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('maNhanVien', 'LIKE', "%$keyword%")
                    ->orWhere('hoTen', 'LIKE', "%$keyword%")
                    ->orWhere('email', 'LIKE', "%$keyword%");
            })
            ->orderBy('maNhanVien', 'desc')
            ->paginate(10);

        $data->appends(['keyword' => $keyword]);

        return view("admin.nhanvien.read", compact("data"));
    }

    public function detail($maNhanVien)
    {
        $record = NhanVien::findOrFail($maNhanVien);
        return view('admin.nhanvien.detail', compact('record'));
    }
}
