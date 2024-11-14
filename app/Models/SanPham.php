<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenSP',
        'slug',
        'moTa',
        'gia',
        'soLuong',
        'danh_muc_id',
        'thuong_hieu_id',
        'image'
    ];

    public $timestamps = true; 

    public function danhMuc()
    {
        return $this->belongsTo('App\Models\DanhMuc', 'danh_muc_id', 'id'); //khóa ngoại chung, khóa chính của bảng
    }

    public function thuongHieu()
    {
        return $this->belongsTo('App\Models\ThuongHieu', 'thuong_hieu_id', 'id');
    }
}
