<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Models\ThuongHieu;

//JointPoint
class SanPhamController extends Controller
{
    public function index(Request $request)
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

        $sanphams = $query->paginate(5);

        return view('admin.sanpham.index', compact('sanphams'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $danhMucs = DanhMuc::where('status', 1)->get();
        $thuongHieus = ThuongHieu::where('status', 1)->get();

        return view('admin.sanpham.create', compact('danhMucs', 'thuongHieus'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenSP' => 'required|string|max:255',
            'moTa' => 'nullable|string',
            'gia' => 'required|numeric',
            'soLuong' => 'required|integer|min:1',
            'danh_muc_id' => 'required|exists:danh_mucs,id',
            'thuong_hieu_id' => 'required|exists:thuong_hieus,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'tenSP.required' => 'Vui lòng nhập tên sản phẩm.',
            'tenSP.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'gia.required' => 'Vui lòng nhập giá sản phẩm.',
            'gia.numeric' => 'Giá sản phẩm phải là một số.',
            'soLuong.required' => 'Vui lòng nhập số lượng.',
            'soLuong.integer' => 'Số lượng phải là một số nguyên.',
            'soLuong.min' => 'Số lượng phải lớn hơn 0.',
            'danh_muc_id.required' => 'Vui lòng chọn danh mục.',
            'danh_muc_id.exists' => 'Danh mục không hợp lệ.',
            'thuong_hieu_id.required' => 'Vui lòng chọn thương hiệu.',
            'thuong_hieu_id.exists' => 'Thương hiệu không hợp lệ.',
            'image.image' => 'File tải lên phải là một hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, hoặc svg.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $slug = Str::slug($request->input('tenSP'));
        $imageName = null;
            
        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('tenSP')) . '-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('source/image/sanpham'), $imageName);
        }

        SanPham::create([
            'tenSP' => $request->input('tenSP'),
            'slug' => $slug,
            'moTa' => $request->input('moTa'),
            'gia' => $request->input('gia'),
            'soLuong' => $request->input('soLuong'),
            'danh_muc_id' => $request->input('danh_muc_id'),
            'thuong_hieu_id' => $request->input('thuong_hieu_id'),
            'image' => $imageName,
        ]);

        return redirect()->route('sanpham.index')->with('success', 'Sản phẩm đã được thêm thành công!');
    }

    public function show($id)
    {
        $sanpham = SanPham::findOrFail($id);
        return view('admin.sanpham.show', compact('sanpham'));
    }

    public function edit($id)
    {
        $sanpham = SanPham::findOrFail($id);
        $danhMucs = DanhMuc::where('status', 1)->pluck('tenDM', 'id');
        $thuongHieus = ThuongHieu::where('status', 1)->pluck('tenTH', 'id');

        return view('admin.sanpham.edit', compact('sanpham', 'danhMucs', 'thuongHieus'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tenSP' => 'required|string|max:255',
            'moTa' => 'nullable|string',
            'gia' => 'required|numeric',
            'soLuong' => 'required|integer|min:1',
            'danh_muc_id' => 'required|exists:danh_mucs,id',
            'thuong_hieu_id' => 'required|exists:thuong_hieus,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'tenSP.required' => 'Vui lòng nhập tên sản phẩm.',
            'tenSP.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'soLuong.min' => 'Số lượng phải lớn hơn 0.',
            'gia.required' => 'Vui lòng nhập giá sản phẩm.',
            'gia.numeric' => 'Giá sản phẩm phải là một số.',
            'soLuong.required' => 'Vui lòng nhập số lượng.',
            'soLuong.integer' => 'Số lượng phải là một số nguyên.',
            'soLuong.min' => 'Số lượng phải lớn hơn 0.',
            'danh_muc_id.required' => 'Vui lòng chọn danh mục.',
            'danh_muc_id.exists' => 'Danh mục không hợp lệ.',
            'thuong_hieu_id.required' => 'Vui lòng chọn thương hiệu.',
            'thuong_hieu_id.exists' => 'Thương hiệu không hợp lệ.',
            'image.image' => 'File tải lên phải là một hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, hoặc svg.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $sanpham = SanPham::findOrFail($id);
        $newImageName = null;

        if ($request->hasFile('image')) {
            $oldImagePath = public_path('source/image/sanpham/' . $sanpham->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $newImageName = Str::slug($request->input('tenSP')) . '-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('source/image/sanpham'), $newImageName);
            $sanpham->image = $newImageName;
        } else {
            $newImageName = $sanpham->image;
        }


        $slug = Str::slug($request->input('tenSP'));

        $sanpham->tenSP = $request->input('tenSP');
        $sanpham->slug = Str::slug($request->input('tenSP'));
        $sanpham->moTa = $request->input('moTa');
        $sanpham->gia = $request->input('gia');
        $sanpham->soLuong = $request->input('soLuong');
        $sanpham->danh_muc_id = $request->input('danh_muc_id');
        $sanpham->thuong_hieu_id = $request->input('thuong_hieu_id');
        $sanpham->image = $newImageName;
        
        $sanpham->save();

        return redirect()->route('sanpham.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }

    public function destroy($id)
    {
        $sanPham = SanPham::findOrFail($id);

        $imagePath = public_path('source/image/sanpham/' . $sanPham->image);

        $imagePath = public_path('source/image/sanpham/' . $sanPham->image);
        if ($sanPham->image && file_exists($imagePath)) {
            unlink($imagePath);
        }
    
        $sanPham->delete();
    
        return response()->json(['success' => 'Sản phẩm đã được xóa thành công.']);
    }
}
