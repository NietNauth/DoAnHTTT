<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\TinhLuong;

class TinhLuongController extends Controller
{
    // 1️⃣ Hiển thị danh sách bảng lương
    public function index()
    {
        $dsLuong = TinhLuong::join('NhanVien', 'NhanVien.maNhanVien', '=', 'TinhLuong.maNhanVien')
            ->select('TinhLuong.*', 'NhanVien.hoTen')
            ->orderByDesc('thangNam')
            ->paginate(10);

        return view('admin.tinhluong.read', ['data' => $dsLuong]);
    }

    // 2️⃣ Form chọn tháng/năm để tính lương
    public function create()
    {
        return view('admin.tinhluong.create');
    }

    // 3️⃣ Thực hiện tính lương bằng procedure MySQL
    public function tinhLuong(Request $request)
    {
        $request->validate([
            'thang' => 'required|date_format:Y-m',
        ]);

        $thangNam = $request->thang; // YYYY-MM

        try {
            // Gọi procedure MySQL
            DB::statement("CALL TinhLuongHangThang(?)", [$thangNam]);

            return redirect()->back()->with('success', "Tính lương tháng $thangNam thành công!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Lỗi khi tính lương: " . $e->getMessage());
        }
    }

    // 6️⃣ Form sửa thưởng/phạt
    public function update($maTinhLuong)
    {
        $record = TinhLuong::join('NhanVien', 'NhanVien.maNhanVien', '=', 'TinhLuong.maNhanVien')
            ->select('TinhLuong.*', 'NhanVien.hoTen')
            ->where('TinhLuong.maTinhLuong', $maTinhLuong)
            ->firstOrFail();

        $action = url("admin/tinhluong/update-post/$maTinhLuong");

        return view('admin.tinhluong.update', compact('record', 'action'));
    }

    // 7️⃣ Lưu thay đổi thưởng/phạt
    public function updatePost(Request $request, $maTinhLuong)
    {
        $request->validate([
            'thuong' => 'nullable|numeric|min:0',
            'phat' => 'nullable|numeric|min:0',
            'ghiChu' => 'nullable|string|max:255',
        ]);

        $tl = TinhLuong::findOrFail($maTinhLuong);

        // Lưu giá trị cũ của tongLuong đã tính từ procedure
        $tongLuongGoc = $tl->tongLuong - $tl->thuong + $tl->phat;

        // Cập nhật thưởng / phạt mới
        $tl->thuong = $request->thuong ?? 0;
        $tl->phat = $request->phat ?? 0;

        // Cập nhật tongLuong = giá trị gốc + thưởng mới - phạt mới
        $tl->tongLuong = $tongLuongGoc + $tl->thuong - $tl->phat;

        // Cập nhật ghi chú (nếu có)
        $tl->ghiChu = $request->ghiChu ?? $tl->ghiChu;

        $tl->save();

        return redirect()->to('admin/tinhluong')->with('success', 'Cập nhật thưởng/phạt thành công');
    }


    // 4️⃣ Xem chi tiết bảng lương
    public function detail($maTinhLuong)
    {
        $record = TinhLuong::join('NhanVien', 'NhanVien.maNhanVien', '=', 'TinhLuong.maNhanVien')
            ->select('TinhLuong.*', 'NhanVien.hoTen', 'NhanVien.luongCoBan', 'NhanVien.phuCap')
            ->where('TinhLuong.maTinhLuong', $maTinhLuong)
            ->firstOrFail();

        return view('admin.tinhluong.detail', compact('record'));
    }

    // 5️⃣ Xóa bản ghi lương
    public function delete($maTinhLuong)
    {
        $tl = TinhLuong::findOrFail($maTinhLuong);
        $tl->delete();

        $dsLuong = TinhLuong::join('NhanVien', 'NhanVien.maNhanVien', '=', 'TinhLuong.maNhanVien')
            ->select('TinhLuong.*', 'NhanVien.hoTen')
            ->orderByDesc('thangNam')
            ->paginate(10);

        return redirect('admin/tinhluong')->with('success', 'Xóa bản ghi lương thành công');
    }

}
