<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = "DonHang";
    protected $primaryKey = "maDonHang";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "maDonHang",
        "maKhachHang",
        "ngayDat",
        "hoTen",
        "soDienThoai",
        "email",
        "diaChi",
        "trangThai",
        "tongTien",
        "ghiChu",
        "trangThai"
    ];

    protected $casts = [
        'ngayDat' => 'datetime',
        'ngayTao' => 'datetime',
        'ngayCapNhat' => 'datetime',
    ];

    public function chiTietDonHang()
    {
        return $this->hasMany(ChiTietDonHang::class, 'maDonHang', 'maDonHang');
    }
}
