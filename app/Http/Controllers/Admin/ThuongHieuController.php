<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Events\ThuongHieuActionPerformed;
use Illuminate\Support\Facades\Auth;
use App\Models\ThuongHieu;

class ThuongHieuController extends Controller
{
    public function index(Request $request)
    {
        $query = ThuongHieu::query();

        if ($request->has('SearchString') && $request->SearchString != '') {
            $query->where('tenTH', 'like', '%' . $request->SearchString . '%');
        }

        $sortColumn = $request->get('sort_column', 'id');
        $sortOrder = $request->get('sort_order', 'asc');

        $query->orderBy($sortColumn, $sortOrder);

        $thuongHieus = $query->paginate(10)->appends($request->query());

        return view('admin.thuonghieu.index', compact('thuongHieus', 'sortColumn', 'sortOrder'));
    }

    public function create()
    {
        return view('admin.thuonghieu.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenTH' => 'required|string|max:255',
            'moTa' => 'nullable|string',
            'status' => 'required|boolean',
        ], [
            'tenTH.required' => 'Vui lòng nhập tên thương hiệu.',
            'tenTH.max' => 'Tên thương hiệu không được vượt quá 255 ký tự.',
            'status.required' => 'Vui lòng chọn status.',
            'status.boolean' => 'Status không hợp lệ.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $slug = Str::slug($request->input('tenTH'));

        ThuongHieu::create([
            'tenTH' => $request->input('tenTH'),
            'moTa' => $request->input('moTa'),
            'slug' => $slug,
            'status' => $request->input('status'),
        ]);

        return redirect()->route('thuonghieu.index')->with('success', 'Thương hiệu đã được thêm thành công!');
    }

    public function show($id)
    {
        $thuongHieu = ThuongHieu::findOrFail($id);
        return view('admin.thuonghieu.show', compact('thuongHieu'));
    }

    public function edit($id)
    {
        $thuongHieu = ThuongHieu::findOrFail($id);
        return view('admin.thuonghieu.edit', compact('thuongHieu'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tenTH' => 'required|string|max:255',
            'moTa' => 'nullable|string',
            'status' => 'required|boolean',
        ], [
            'tenTH.required' => 'Vui lòng nhập tên thương hiệu.',
            'tenTH.max' => 'Tên thương hiệu không được vượt quá 255 ký tự.',
            'status.required' => 'Vui lòng chọn status.',
            'status.boolean' => 'Status không hợp lệ.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $thuongHieu = ThuongHieu::findOrFail($id);
    
        $data = $request->all();

        $slug = Str::slug($data['tenTH']);

        $thuongHieu->update([
            'tenTH' => $data['tenTH'],
            'moTa' => $data['moTa'],
            'slug' => $slug,
            'status' => $data['status'],
        ]);

        //JoinPoint
        event(new ThuongHieuActionPerformed(Auth::user(), 'update', $thuongHieu));

        return redirect()->route('thuonghieu.index')->with('success', 'Thương hiệu đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $thuongHieu = ThuongHieu::findOrFail($id);

        $thuongHieu->delete();

        //JoinPoint
        event(new ThuongHieuActionPerformed(Auth::user(), 'delete', $thuongHieu));

        return response()->json(['success' => 'Thương hiệu đã được xóa thành công.']);
    }
}
