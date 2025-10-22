<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class NhaCC extends Model
{
    protected $table = "NhaCungCap";
    protected $primaryKey = "maNCC";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "maNCC",
        "tenNCC",
        "soDienThoai",
        "email",
        "diaChi",
        "nguoiLienHe",
        "trangThai"
    ];

    protected $casts = [
    'ngayTao' => 'datetime',
    'ngayCapNhat' => 'datetime',
    ];
}
