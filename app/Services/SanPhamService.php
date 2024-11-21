<?php

namespace App\Services;

use App\Models\SanPham;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SanPhamService
{
    public function index($request)
    {
        $query = SanPham::with(['DanhMuc', 'ThuongHieu']);

        if ($request->has('SearchString') && !empty($request->SearchString)) {
            $query->where('tenSP', 'like', '%' . $request->SearchString . '%');
        }

        $sortField = $request->get('sortField', 'id');
        $sortOrder = $request->get('sortOrder', 'asc');
        if (in_array($sortField, ['tenSP', 'gia', 'danh_muc_id', 'thuong_hieu_id'])) {
            $query->orderBy($sortField, $sortOrder);
        }

        return $query->paginate(5);
    }

    public function store($data)
    {
        $slug = Str::slug($data['tenSP']);
        $imageName = $data['image'] ?? null;

        if (!empty($data['image'])) {
            $imageName = Str::slug($data['tenSP']) . '-' . time() . '.' . $data['image']->extension();
            $data['image']->move(public_path('source/image/sanpham'), $imageName);
        }

        return SanPham::create([
            'tenSP' => $data['tenSP'],
            'slug' => $slug,
            'moTa' => $data['moTa'],
            'gia' => $data['gia'],
            'soLuong' => $data['soLuong'],
            'danh_muc_id' => $data['danh_muc_id'],
            'thuong_hieu_id' => $data['thuong_hieu_id'],
            'image' => $imageName,
        ]);
    }

    public function update($sanpham, $data)
    {
        $newImageName = null;

        if (!empty($data['image'])) {
            $oldImagePath = public_path('source/image/sanpham/' . $sanpham->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $newImageName = Str::slug($data['tenSP']) . '-' . time() . '.' . $data['image']->extension();
            $data['image']->move(public_path('source/image/sanpham'), $newImageName);
        }

        $sanpham->update([
            'tenSP' => $data['tenSP'],
            'slug' => Str::slug($data['tenSP']),
            'moTa' => $data['moTa'],
            'gia' => $data['gia'],
            'soLuong' => $data['soLuong'],
            'danh_muc_id' => $data['danh_muc_id'],
            'thuong_hieu_id' => $data['thuong_hieu_id'],
            'image' => $newImageName ?? $sanpham->image,
        ]);

        return $sanpham;
    }

    public function destroy($sanpham)
    {
        $imagePath = public_path('source/image/sanpham/' . $sanpham->image);
        if ($sanpham->image && file_exists($imagePath)) {
            unlink($imagePath);
        }
        $sanpham->delete();
        return true;
    }
}
