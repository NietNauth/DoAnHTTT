<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    protected $table = "DanhMuc";
    protected $primaryKey = "maDanhMuc";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "maDanhMuc",
        "tenDanhMuc",
        "moTa",
        "email",
        "trangThai"
    ];

    protected $casts = [
    'ngayTao' => 'datetime',
    'ngayCapNhat' => 'datetime',
    ];
}
