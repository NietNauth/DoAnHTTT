<?php

namespace App\Models\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;

class NguoiDung extends Authenticatable
{
    protected $table = "NguoiDung";
    protected $primaryKey = "maNguoiDung";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        "tenDangNhap",
        "matKhau",
        "vaiTro",
    ];

    // Tên cột mật khẩu
    public function getAuthPassword()
    {
        return $this->matKhau;
    }

    // Quan hệ với bảng VaiTro
    public function role()
    {
        return $this->belongsTo(VaiTro::class, 'vaiTro', 'maVaiTro');
    }

    public function khachHang()
    {
        return $this->hasOne(KhachHang::class, 'maNguoiDung', 'maNguoiDung');
    }
}
