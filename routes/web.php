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

use App\Http\Controllers\Admin\NguoiDungController;
Route::get('nguoidung', [NguoiDungController::class, 'index']);
Route::get('nguoidung/create', [NguoiDungController::class, 'create']);
Route::post('nguoidung/create-post', [NguoiDungController::class, 'createPost']);
Route::get('nguoidung/update/{maNguoiDung}', [NguoiDungController::class, 'update']);
Route::post('nguoidung/update-post/{maNguoiDung}', [NguoiDungController::class, 'updatePost']);
Route::get('nguoidung/delete/{maNguoiDung}', [NguoiDungController::class, 'delete']);
Route::get('nguoidung/search', [NguoiDungController::class, 'search']);

