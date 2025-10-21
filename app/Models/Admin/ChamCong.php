<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ChamCong extends Model
{
    protected $table = "ChamCong";
    protected $primaryKey = "maChamCong";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        "maNhanVien",
        "ngay",
        "gioVao",
        "gioRa",
        "soGioLam",
        "soGioTangCa",
        "trangThai",
        "ghiChu"
    ];
    
}
