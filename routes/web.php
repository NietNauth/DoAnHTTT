<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckLogin;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\VaiTroController;
use App\Http\Controllers\Admin\ChucVuController;
use App\Http\Controllers\Admin\NguoiDungController;
use App\Http\Controllers\Admin\KhachHangController;
use App\Http\Controllers\Admin\NhanVienController;
use App\Http\Controllers\Admin\ChamCongController;
use App\Http\Controllers\Admin\TinhLuongController;
use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\NhaCCController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\SanPhamHinhAnhController;
use App\Http\Controllers\Admin\SanPhamThuocTinhController;
use App\Http\Controllers\Index\HomeController;
use App\Http\Controllers\Index\ProductsController;
use App\Http\Controllers\Index\CartController;



// Route::get('/test-db', function () {
//     try {
//         DB::connection()->getPdo();
//         return "✅ Kết nối database thành công!";
//     } catch (\Exception $e) {
//         return "❌ Kết nối database thất bại: " . $e->getMessage();
//     }
// });


Route::prefix('admin')->group(function () {

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware([CheckLogin::class])->group(function () {
        Route::get('/', function () {
            return view('admin.trangchu.read');
        });

        // VaiTro
        Route::get('vaitro', [VaiTroController::class, 'index']);
        Route::get('vaitro/create', [VaiTroController::class, 'create']);
        Route::post('vaitro/create-post', [VaiTroController::class, 'createPost']);
        Route::get('vaitro/update/{maVaiTro}', [VaiTroController::class, 'update']);
        Route::post('vaitro/update-post/{maVaiTro}', [VaiTroController::class, 'updatePost']);
        Route::get('vaitro/delete/{maVaiTro}', [VaiTroController::class, 'delete']);
        Route::get('vaitro/search', [VaiTroController::class, 'search']);

        // ChucVu
        Route::get('chucvu', [ChucVuController::class, 'index']);
        Route::get('chucvu/create', [ChucVuController::class, 'create']);
        Route::post('chucvu/create-post', [ChucVuController::class, 'createPost']);
        Route::get('chucvu/update/{maChucVu}', [ChucVuController::class, 'update']);
        Route::post('chucvu/update-post/{maChucVu}', [ChucVuController::class, 'updatePost']);
        Route::get('chucvu/delete/{maChucVu}', [ChucVuController::class, 'delete']);
        Route::get('chucvu/search', [ChucVuController::class, 'search']);

        // NguoiDung
        Route::get('nguoidung', [NguoiDungController::class, 'index']);
        Route::get('nguoidung/create', [NguoiDungController::class, 'create']);
        Route::post('nguoidung/create-post', [NguoiDungController::class, 'createPost']);
        Route::get('nguoidung/update/{maNguoiDung}', [NguoiDungController::class, 'update']);
        Route::post('nguoidung/update-post/{maNguoiDung}', [NguoiDungController::class, 'updatePost']);
        Route::get('nguoidung/delete/{maNguoiDung}', [NguoiDungController::class, 'delete']);
        Route::get('nguoidung/search', [NguoiDungController::class, 'search']);

        // KhachHang
        Route::get('khachhang', [KhachHangController::class, 'index']);
        Route::get('khachhang/create', [KhachHangController::class, 'create']);
        Route::post('khachhang/create-post', [KhachHangController::class, 'createPost']);
        Route::get('khachhang/update/{maKhachHang}', [KhachHangController::class, 'update']);
        Route::post('khachhang/update-post/{maKhachHang}', [KhachHangController::class, 'updatePost']);
        Route::get('khachhang/delete/{maKhachHang}', [KhachHangController::class, 'delete']);
        Route::get('khachhang/search', [KhachHangController::class, 'search']);

        // NhanVien
        Route::get('nhanvien', [NhanVienController::class, 'index']);
        Route::get('nhanvien/create', [NhanVienController::class, 'create']);
        Route::post('nhanvien/create-post', [NhanVienController::class, 'createPost']);
        Route::get('nhanvien/update/{maNhanVien}', [NhanVienController::class, 'update']);
        Route::post('nhanvien/update-post/{maNhanVien}', [NhanVienController::class, 'updatePost']);
        Route::get('nhanvien/delete/{maNhanVien}', [NhanVienController::class, 'delete']);
        Route::get('nhanvien/search', [NhanVienController::class, 'search']);
        Route::get('nhanvien/detail/{maNhanVien}', [NhanVienController::class, 'detail']);

        // ChamCong
        Route::get('chamcong', [ChamCongController::class, 'index']);
        Route::get('chamcong/create', [ChamCongController::class, 'create']);
        Route::post('chamcong/create-post', [ChamCongController::class, 'createPost']);
        Route::get('chamcong/update/{maChamCong}', [ChamCongController::class, 'update']);
        Route::post('chamcong/update-post/{maChamCong}', [ChamCongController::class, 'updatePost']);
        Route::get('chamcong/delete/{maChamCong}', [ChamCongController::class, 'delete']);
        Route::get('chamcong/search', [ChamCongController::class, 'search']);
        Route::get('chamcong/detail/{maChamCong}', [ChamCongController::class, 'detail']);

        // TinhLuong
        Route::get('tinhluong', [TinhLuongController::class, 'index']);
        Route::get('tinhluong/create', [TinhLuongController::class, 'create']);
        Route::post('tinhluong/create-post', [TinhLuongController::class, 'createPost']);
        Route::get('tinhluong/update/{maTinhLuong}', [TinhLuongController::class, 'update']);
        Route::post('tinhluong/update-post/{maTinhLuong}', [TinhLuongController::class, 'updatePost']);
        Route::get('tinhluong/delete/{maTinhLuong}', [TinhLuongController::class, 'delete']);
        Route::get('tinhluong/detail/{maTinhLuong}', [TinhLuongController::class, 'detail']);
        Route::post('tinhluong/tinh', [TinhLuongController::class, 'tinhLuong']);

        // DanhMuc
        Route::get('danhmuc', [DanhMucController::class, 'index']);
        Route::get('danhmuc/create', [DanhMucController::class, 'create']);
        Route::post('danhmuc/create-post', [DanhMucController::class, 'createPost']);
        Route::get('danhmuc/update/{maDanhMuc}', [DanhMucController::class, 'update']);
        Route::post('danhmuc/update-post/{maDanhMuc}', [DanhMucController::class, 'updatePost']);
        Route::get('danhmuc/delete/{maDanhMuc}', [DanhMucController::class, 'delete']);
        Route::get('danhmuc/search', [DanhMucController::class, 'search']);

        // NhaCC
        Route::get('nhacc', [NhaCCController::class, 'index']);
        Route::get('nhacc/create', [NhaCCController::class, 'create']);
        Route::post('nhacc/create-post', [NhaCCController::class, 'createPost']);
        Route::get('nhacc/update/{maNCC}', [NhaCCController::class, 'update']);
        Route::post('nhacc/update-post/{maNCC}', [NhaCCController::class, 'updatePost']);
        Route::get('nhacc/delete/{maNCC}', [NhaCCController::class, 'delete']);
        Route::get('nhacc/search', [NhaCCController::class, 'search']);

        // SanPham
        Route::get('sanpham', [SanPhamController::class, 'index']);
        Route::get('sanpham/create', [SanPhamController::class, 'create']);
        Route::post('sanpham/create-post', [SanPhamController::class, 'createPost']);
        Route::get('sanpham/update/{maSanPham}', [SanPhamController::class, 'update']);
        Route::post('sanpham/update-post/{maSanPham}', [SanPhamController::class, 'updatePost']);
        Route::get('sanpham/delete/{maSanPham}', [SanPhamController::class, 'delete']);
        Route::get('sanpham/search', [SanPhamController::class, 'search']);

        // SanPhamHinhAnh
        Route::get('sanpham-hinhanh', [SanPhamHinhAnhController::class, 'index']);
        Route::get('sanpham-hinhanh/create', [SanPhamHinhAnhController::class, 'create']);
        Route::post('sanpham-hinhanh/create-post', [SanPhamHinhAnhController::class, 'createPost']);
        Route::get('sanpham-hinhanh/update/{maSPHA}', [SanPhamHinhAnhController::class, 'update']);
        Route::post('sanpham-hinhanh/update-post/{maSPHA}', [SanPhamHinhAnhController::class, 'updatePost']);
        Route::get('sanpham-hinhanh/delete/{maSPHA}', [SanPhamHinhAnhController::class, 'delete']);
        Route::get('sanpham-hinhanh/search', [SanPhamHinhAnhController::class, 'search']);

        // SanPhamThuocTinh
        Route::get('sanpham-thuoctinh', [SanPhamThuocTinhController::class, 'index']);
        Route::get('sanpham-thuoctinh/create', [SanPhamThuocTinhController::class, 'create']);
        Route::post('sanpham-thuoctinh/create-post', [SanPhamThuocTinhController::class, 'createPost']);
        Route::get('sanpham-thuoctinh/update/{maSPTT}', [SanPhamThuocTinhController::class, 'update']);
        Route::post('sanpham-thuoctinh/update-post/{maSPTT}', [SanPhamThuocTinhController::class, 'updatePost']);
        Route::get('sanpham-thuoctinh/delete/{maSPTT}', [SanPhamThuocTinhController::class, 'delete']);
        Route::get('sanpham-thuoctinh/search', [SanPhamThuocTinhController::class, 'search']);
        Route::get('sanpham-thuoctinh/add-so-luong/{maSPTT}', [SanPhamThuocTinhController::class, 'addSoLuong']);
        Route::post('sanpham-thuoctinh/add-so-luong/{maSPTT}', [SanPhamThuocTinhController::class, 'addSoLuongPost']);

    });
});

Route::get("", [HomeController::class, 'index']);
Route::get('products/detail/{id}', [ProductsController::class, 'detail']);
Route::get('products/category/{maDanhMuc}', [ProductsController::class, 'category']);
Route::get('products/all', [ProductsController::class, 'allProducts']);



Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart');

    Route::post('/buy', [CartController::class, 'buy'])->name('cart.buy');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');

    // Chuyển remove và clear sang POST
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
});



