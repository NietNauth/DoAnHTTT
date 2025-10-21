<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ChucVu extends Model
{
    protected $table = "ChucVu";
    protected $primaryKey = "maChucVu";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        "tenChucVu",
        "moTa"
    ];
    
}
