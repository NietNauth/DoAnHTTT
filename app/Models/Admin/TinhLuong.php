<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TinhLuong extends Model
{
     protected $table = "TinhLuong";
    protected $primaryKey = "maTinhLuong";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "maNhanVien",
        "thangNam",
        "tongCong",
        "tongGioLam",
        "tongGioTangCa",
        "luongCoBan",
        "luongTangCa",
        "thuong",
        "phat",
        "tongLuong",
        "ghiChu"        
    ];
    
}
