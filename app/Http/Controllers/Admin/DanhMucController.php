<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\DanhMuc;

class DanhMucController extends Controller
{
    public function index(Request $request)
    {
        $query = DanhMuc::query();

        if ($request->has('SearchString') && $request->SearchString != '') {
            $query->where('tenDM', 'like', '%' . $request->SearchString . '%');
        }

        $sortColumn = $request->get('sort_column', 'id');
        $sortOrder = $request->get('sort_order', 'asc');

        $query->orderBy($sortColumn, $sortOrder);

        $danhMucs = $query->paginate(10)->appends($request->query());

        return view('admin.danhmuc.index', compact('danhMucs', 'sortColumn', 'sortOrder'));
    }

    public function create()
    {
        return view('admin.danhmuc.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenDM' => 'required|string|max:255',
            'moTa' => 'nullable|string',
            'status' => 'required|boolean',
        ], [
            'tenDM.required' => 'Vui lòng nhập tên danh mục.',
            'tenDM.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'status.required' => 'Vui lòng chọn status.',
            'status.boolean' => 'Status không hợp lệ.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $slug = Str::slug($request->input('tenDM'));

        DanhMuc::create([
            'tenDM' => $request->input('tenDM'),
            'moTa' => $request->input('moTa'),
            'slug' => $slug,
            'status' => $request->input('status'),
        ]);

        return redirect()->route('danhmuc.index')->with('success', 'Danh mục đã được thêm thành công!');
    }

    public function show($id)
    {
        $danhMuc = DanhMuc::findOrFail($id);
        return view('admin.danhmuc.show', compact('danhMuc'));
    }

    public function edit($id)
    {
        $danhMuc = DanhMuc::findOrFail($id);
        return view('admin.danhmuc.edit', compact('danhMuc'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tenDM' => 'required|string|max:255',
            'moTa' => 'nullable|string',
            'status' => 'required|boolean',
        ], [
            'tenDM.required' => 'Vui lòng nhập tên danh mục.',
            'tenDM.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'status.required' => 'Vui lòng chọn status.',
            'status.boolean' => 'Status không hợp lệ.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $danhMuc = DanhMuc::findOrFail($id);
    
        $data = $request->all();

        $slug = Str::slug($data['tenDM']);

        $danhMuc->update([
            'tenDM' => $data['tenDM'],
            'moTa' => $data['moTa'],
            'slug' => $slug,
            'status' => $data['status'],
        ]);

        return redirect()->route('danhmuc.index')->with('success', 'Danh mục đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $danhMuc = DanhMuc::findOrFail($id);

        $danhMuc->delete();

        return response()->json(['success' => 'Danh mục đã được xóa thành công.']);
    }
}
