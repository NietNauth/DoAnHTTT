<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = "SanPham";
    protected $primaryKey = "maSanPham";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "maSanPham",
        "tenSanPham",
        "moTa",
        "giaNhap",
        "giaGoc",
        "maDanhMuc",
        "maNCC",
        "trangThai"
    ];

    protected $casts = [
        'ngayTao' => 'datetime',
        'ngayCapNhat' => 'datetime',
    ];

    public function hinhAnhs()
    {
        return $this->hasMany(SanPhamHinhAnh::class, 'maSanPham', 'maSanPham')->orderBy('thuTu');
    }
}
