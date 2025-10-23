<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use App\Models\Admin\KhachHang;
use Carbon\Carbon;


class DonHangController extends Controller
{
    public function index()
    {
        $data = DonHang::orderBy('ngayDat', 'desc')->paginate(10);
        return view('admin.donhang.read', compact('data'));
    }

    public function create()
    {
        $action = url('admin/donhang/create-post');
        $khachHangList = KhachHang::all();
        return view('admin.donhang.create_update', compact('action', 'khachHangList'));
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'maKhachHang' => 'required|exists:KhachHang,maKhachHang',
            'ngayDat' => 'required|date',
            'trangThai' => 'required|in:Chờ xử lý,Đang chuẩn bị,Đang giao,Hoàn thành,Hủy',
            'maKhuyenMai' => 'nullable|string|max:20',
            'ghiChu' => 'nullable|string|max:255',
            'sanPham.*.maSPTT' => 'required|exists:SanPhamThuocTinh,maSPTT',
            'sanPham.*.soLuong' => 'required|integer|min:1',
            'sanPham.*.donGia' => 'required|numeric|min:0',
            'sanPham.*.giamGia' => 'nullable|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            // Tạo DonHang
            $data = $request->only(['maKhachHang', 'ngayDat', 'trangThai', 'maKhuyenMai', 'ghiChu']);
            $data['tongTien'] = 0; // sẽ tính sau
            $data['ngayTao'] = Carbon::now();
            $data['ngayCapNhat'] = Carbon::now();
            $donHang = DonHang::create($data);

            $tongTien = 0;

            // Tạo ChiTietDonHang
            foreach ($request->sanPham as $item) {
                $thanhTien = ($item['soLuong'] * $item['donGia']) - ($item['giamGia'] ?? 0);
                ChiTietDonHang::create([
                    'maDonHang' => $donHang->maDonHang,
                    'maSPTT' => $item['maSPTT'],
                    'soLuong' => $item['soLuong'],
                    'donGia' => $item['donGia'],
                    'giamGia' => $item['giamGia'] ?? 0,
                    'thanhTien' => $thanhTien
                ]);
                $tongTien += $thanhTien;
            }

            // Cập nhật tổng tiền
            $donHang->update(['tongTien' => $tongTien]);
        });

        return redirect('admin/donhang')->with('success', 'Thêm đơn hàng thành công');
    }


    public function update($maDonHang)
    {
        $record = DonHang::findOrFail($maDonHang);
        $action = url("admin/donhang/update-post/$maDonHang");
        $khachHangList = KhachHang::all();

        return view('admin.donhang.create_update', compact('record', 'action', 'khachHangList'));
    }

    public function updatePost(Request $request, $maDonHang)
    {
        $request->validate([
            'maKhachHang' => 'required|exists:KhachHang,maKhachHang',
            'ngayDat' => 'required|date',
            'trangThai' => 'required|in:Chờ xử lý,Đang chuẩn bị,Đang giao,Hoàn thành,Hủy',
            'tongTien' => 'required|numeric|min:0',
            'maKhuyenMai' => 'nullable|string|max:20',
            'ghiChu' => 'nullable|string|max:255',
        ]);

        $record = DonHang::findOrFail($maDonHang);
        $data = $request->all();
        $data['ngayCapNhat'] = Carbon::now();

        $record->update($data);

        return redirect('admin/donhang')->with('success', 'Cập nhật đơn hàng thành công');
    }

    public function delete($maDonHang)
    {
        $record = DonHang::findOrFail($maDonHang);
        $record->delete();

        return redirect('admin/donhang')->with('success', 'Xóa đơn hàng thành công');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = DonHang::where('maDonHang', 'LIKE', "%$keyword%")
            ->orWhere('trangThai', 'LIKE', "%$keyword%")
            ->orderBy('ngayDat', 'desc')
            ->paginate(10);

        return view('admin.donhang.read', compact('data'));
    }

    public function detail($maDonHang)
    {
        $record = DonHang::with(['chiTietDonHang.sanPhamThuocTinh.sanPham.hinhAnhs'])->findOrFail($maDonHang);
        return view('admin.donhang.detail', compact('record'));
    }

}
