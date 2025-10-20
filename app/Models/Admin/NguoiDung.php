<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class NguoiDung extends Model
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
}
