<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuongHieu extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenTH',
        'moTa',
        'slug',
        'status'
    ];

    public $timestamps = true; 

    public function sanPhams()
    {
        return $this->hasMany('App\Models\SanPham', 'thuong_hieu_id', 'id'); //khóa ngoại, khóa chính của bảng
    }
}
