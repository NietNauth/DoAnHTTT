<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\SanPhamThuocTinh;

class ChiTietDonHang extends Model
{
    protected $table = "ChiTietDonHang";
    protected $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        "maDonHang",
        "maSPTT",
        "soLuong",
        "donGia",
        "giamGia",
        "thanhTien"
    ];

    public function sanPhamThuocTinh()
    {
        return $this->belongsTo(SanPhamThuocTinh::class, 'maSPTT', 'maSPTT');
    }
}
