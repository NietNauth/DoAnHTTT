<?php

use Illuminate\Support\Facades\Route;

// Route::get('/test-db', function () {
//     try {
//         DB::connection()->getPdo();
//         return "✅ Kết nối database thành công!";
//     } catch (\Exception $e) {
//         return "❌ Kết nối database thất bại: " . $e->getMessage();
//     }
// });

Route::get('/', function () {
    return view('admin.trangchu.read');
});

use App\Http\Controllers\Admin\VaiTroController;
Route::get('vaitro', [VaiTroController::class, 'index']);
Route::get('vaitro/create', [VaiTroController::class, 'create']);
Route::post('vaitro/create-post', [VaiTroController::class, 'createPost']);
Route::get('vaitro/update/{maVaiTro}', [VaiTroController::class, 'update']);
Route::post('vaitro/update-post/{maVaiTro}', [VaiTroController::class, 'updatePost']);
Route::get('vaitro/delete/{maVaiTro}', [VaiTroController::class, 'delete']);
Route::get('vaitro/search', [VaiTroController::class, 'search']);

use App\Http\Controllers\Admin\ChucVuController;
Route::get('chucvu', [ChucVuController::class, 'index']);
Route::get('chucvu/create', [ChucVuController::class, 'create']);
Route::post('chucvu/create-post', [ChucVuController::class, 'createPost']);
Route::get('chucvu/update/{maChucVu}', [ChucVuController::class, 'update']);
Route::post('chucvu/update-post/{maChucVu}', [ChucVuController::class, 'updatePost']);
Route::get('chucvu/delete/{maChucVu}', [ChucVuController::class, 'delete']);
Route::get('chucvu/search', [ChucVuController::class, 'search']);

use App\Http\Controllers\Admin\NguoiDungController;
Route::get('nguoidung', [NguoiDungController::class, 'index']);
Route::get('nguoidung/create', [NguoiDungController::class, 'create']);
Route::post('nguoidung/create-post', [NguoiDungController::class, 'createPost']);
Route::get('nguoidung/update/{maNguoiDung}', [NguoiDungController::class, 'update']);
Route::post('nguoidung/update-post/{maNguoiDung}', [NguoiDungController::class, 'updatePost']);
Route::get('nguoidung/delete/{maNguoiDung}', [NguoiDungController::class, 'delete']);
Route::get('nguoidung/search', [NguoiDungController::class, 'search']);

use App\Http\Controllers\Admin\KhachHangController;
Route::get('khachhang', [KhachHangController::class, 'index']);
Route::get('khachhang/create', [KhachHangController::class, 'create']);
Route::post('khachhang/create-post', [KhachHangController::class, 'createPost']);
Route::get('khachhang/update/{maKhachHang}', [KhachHangController::class, 'update']);
Route::post('khachhang/update-post/{maKhachHang}', [KhachHangController::class, 'updatePost']);
Route::get('khachhang/delete/{maKhachHang}', [KhachHangController::class, 'delete']);
Route::get('khachhang/search', [KhachHangController::class, 'search']);

use App\Http\Controllers\Admin\NhanVienController;
Route::get('nhanvien', [NhanVienController::class, 'index']);
Route::get('nhanvien/create', [NhanVienController::class, 'create']);
Route::post('nhanvien/create-post', [NhanVienController::class, 'createPost']);
Route::get('nhanvien/update/{maNhanVien}', [NhanVienController::class, 'update']);
Route::post('nhanvien/update-post/{maNhanVien}', [NhanVienController::class, 'updatePost']);
Route::get('nhanvien/delete/{maNhanVien}', [NhanVienController::class, 'delete']);
Route::get('nhanvien/search', [NhanVienController::class, 'search']);
Route::get('nhanvien/detail/{maNhanVien}', [NhanVienController::class, 'detail']);

use App\Http\Controllers\Admin\ChamCongController;
Route::get('chamcong', [ChamCongController::class, 'index']);
Route::get('chamcong/create', [ChamCongController::class, 'create']);
Route::post('chamcong/create-post', [ChamCongController::class, 'createPost']);
Route::get('chamcong/update/{maChamCong}', [ChamCongController::class, 'update']);
Route::post('chamcong/update-post/{maChamCong}', [ChamCongController::class, 'updatePost']);
Route::get('chamcong/delete/{maChamCong}', [ChamCongController::class, 'delete']);
Route::get('chamcong/search', [ChamCongController::class, 'search']);
Route::get('chamcong/detail/{maChamCong}', [ChamCongController::class, 'detail']);

use App\Http\Controllers\Admin\TinhLuongController;
Route::get('tinhluong', [TinhLuongController::class, 'index']);
Route::get('tinhluong/create', [TinhLuongController::class, 'create']);
Route::post('tinhluong/create-post', [TinhLuongController::class, 'createPost']);
Route::get('tinhluong/update/{maTinhLuong}', [TinhLuongController::class, 'update']);
Route::post('tinhluong/update-post/{maTinhLuong}', [TinhLuongController::class, 'updatePost']);
Route::get('tinhluong/delete/{maTinhLuong}', [TinhLuongController::class, 'delete']);
Route::get('tinhluong/detail/{maTinhLuong}', [TinhLuongController::class, 'detail']);
Route::post('tinhluong/tinh', [TinhLuongController::class, 'tinhLuong']);


