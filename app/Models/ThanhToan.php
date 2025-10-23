<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThanhToan extends Model
{
    protected $table = "ThanhToan";
    protected $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        "maDonHang",
        "phuongThuc",
        "soTien",
        "trangThai",
        "ghiChu"
    ];
}
