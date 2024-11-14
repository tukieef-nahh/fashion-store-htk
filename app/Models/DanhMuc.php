<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenDM',
        'moTa',
        'slug',
        'status',
    ];

    public $timestamps = true; 

    public function sanPhams()
    {
        return $this->hasMany('App\Models\SanPham', 'danh_muc_id', 'id');
    }
}
