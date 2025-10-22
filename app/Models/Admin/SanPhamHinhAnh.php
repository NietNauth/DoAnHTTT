<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SanPhamHinhAnh extends Model
{
    protected $table = "SanPhamHinhAnh";
    protected $primaryKey = "maSPHA";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        "maSanPham",
        "duongDan",
        "thuTu",
    ];

    protected $casts = [
    'ngayTao' => 'datetime',
    'ngayCapNhat' => 'datetime',
    ];
}
