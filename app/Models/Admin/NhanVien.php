<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    protected $table = "NhanVien";
    protected $primaryKey = "maNhanVien";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "maNhanVien",
        "maNguoiDung",
        "hoTen",
        "soDienThoai",
        "email",
        "diaChi",
        "ngaySinh",
        "gioiTinh",
        "maChucVu",
        "ngayVaoLam",
        "trangThai"
    ];
}
