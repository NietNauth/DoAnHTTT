<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\SanPham;


class SanPhamThuocTinh extends Model
{
    protected $table = "SanPhamThuocTinh";
    protected $primaryKey = "maSPTT";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        "maSanPham",
        "mauSac",
        "soLuong",
    ];

    protected $casts = [
        'ngayTao' => 'datetime',
        'ngayCapNhat' => 'datetime',
    ];

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'maSanPham', 'maSanPham');
    }

}
