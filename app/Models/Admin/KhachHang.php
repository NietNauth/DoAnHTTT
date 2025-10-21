<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    protected $table = "KhachHang";
    protected $primaryKey = "maKhachHang";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "maKhachHang",
        "maNguoiDung",
        "hoTen",
        "soDienThoai",
        "email",
        "diaChi",
        "diemThuong",
    ];
}
