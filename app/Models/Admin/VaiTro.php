<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class VaiTro extends Model
{
    protected $table = "VaiTro";
    protected $primaryKey = "maVaiTro";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        "tenVaiTro",
        "moTa"
    ];
}
