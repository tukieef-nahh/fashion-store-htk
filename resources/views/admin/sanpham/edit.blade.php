@extends('admin.layout')

@section('title', 'Chỉnh sửa thông tin sản phẩm')

@section('content')
<h4>Chỉnh sửa thông tin sản phẩm</h4>
<div class="col-sm-7">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sanpham.update', $sanpham->id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label for="tenSP">Tên sản phẩm</label>
            <input type="text" name="tenSP" class="form-control" value="{{ old('tenSP', $sanpham->tenSP) }}" />
        </div>

        <div class="form-group">
            <label for="moTa">Mô tả</label>
            <textarea name="moTa" class="form-control">{{ old('moTa', $sanpham->moTa) }}</textarea>
        </div>

        <div class="form-group">
            <label for="gia">Giá</label>
            <input type="text" name="gia" class="form-control" value="{{ old('gia', $sanpham->gia) }}" />
        </div>

        <div class="form-group">
            <label for="soLuong">Số lượng</label>
            <input type="number" name="soLuong" class="form-control" value={{ old('soLuong', $sanpham->soLuong) }} />
        </div>

        <div class="form-group">
            <label for="danh_muc_id">Danh mục</label>
            <select name="danh_muc_id" class="form-control">
                <option value="">--Chọn danh mục--</option>
                @foreach($danhMucs as $id => $name)
                    <option value="{{ $id }}" {{ $sanpham->danh_muc_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="thuong_hieu_id">Thương hiệu</label>
            <select name="thuong_hieu_id" class="form-control">
                <option value="">--Chọn thương hiệu--</option>
                @foreach($thuongHieus as $id => $name)
                    <option value="{{ $id }}" {{ $sanpham->thuong_hieu_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Ảnh</label>
            <input type="file" name="image" class="form-control" />
            @if($sanpham->image)
                <img src="{{ asset('source/image/sanpham/' . $sanpham->image) }}" width="100px" alt="Sản phẩm">
            @endif
        </div>

        <div class="shop-menu pull-right">
            <button type="submit" class="btn btn-success">Lưu</button>
            <a class="btn btn-warning" href="{{ route('sanpham.index') }}">Hủy</a>
        </div>
    </form>
</div>
@endsection