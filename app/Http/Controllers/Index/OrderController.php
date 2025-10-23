<?php
namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Xem danh sách đơn hàng của khách
     */
    public function myOrders()
    {
        $user = Auth::user();
        $khachHangId = $user->khachHang->maKhachHang ?? $user->maNguoiDung;

        // Lấy tất cả đơn hàng của khách
        $donHangs = DonHang::where('maKhachHang', $khachHangId)
            ->orderBy('maDonHang', 'desc')
            ->get();

        return view('index.main.my_orders', compact('donHangs'));
    }

    /**
     * Xem chi tiết 1 đơn hàng
     */
    public function orderDetail($maDonHang)
    {
        $user = Auth::user();
        $khachHangId = $user->khachHang->maKhachHang ?? $user->maNguoiDung;

        // Kiểm tra đơn hàng thuộc khách hàng hiện tại
        $donHang = DonHang::where('maDonHang', $maDonHang)
            ->where('maKhachHang', $khachHangId)
            ->firstOrFail();

        // Lấy chi tiết sản phẩm kèm thông tin sản phẩm và thuộc tính
        $chiTiets = ChiTietDonHang::with('sanPhamThuocTinh.sanPham.hinhAnhs')
            ->where('maDonHang', $maDonHang)
            ->get();

        return view('index.main.detail_order', compact('donHang', 'chiTiets'));
    }

}
