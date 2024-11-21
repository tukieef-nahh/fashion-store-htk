@extends('admin.layout')

@section('title', 'Thêm sản phẩm')

@section('content')
<h4>Thêm sản phẩm</h4>
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

    <form action="{{ route('sanpham.store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Tên sản phẩm</label>
            <input type="text" name="tenSP" class="form-control" value="{{ old('tenSP') }}" />
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="moTa" class="form-control">{{ old('moTa') }}</textarea>
        </div>
        <div class="form-group">
            <label>Giá</label>
            <input type="text" name="gia" class="form-control" value="{{ old('gia') }}" />
        </div>
        <div class="form-group">
            <label>Số lượng</label>
            <input type="number" name="soLuong" class="form-control" value="{{ old('soLuong') }}" />
        </div>
        <div class="form-group">
            <label for="danh_muc_id">Danh mục</label>
            <select name="danh_muc_id" class="form-control">
                <option value="">--Chọn danh mục--</option>
                @foreach ($danhMucs as $danhMuc)
                    <option value="{{ $danhMuc->id }}" {{ old('danh_muc_id') == $danhMuc->id ? 'selected' : '' }}>
                        {{ $danhMuc->tenDM }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="thuong_hieu_id">Thương hiệu</label>
            <select name="thuong_hieu_id" class="form-control">
                <option value="">--Chọn thương hiệu--</option>
                @foreach ($thuongHieus as $thuongHieu)
                    <option value="{{ $thuongHieu->id }}" {{ old('thuong_hieu_id') == $thuongHieu->id ? 'selected' : '' }}>
                        {{ $thuongHieu->tenTH }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Ảnh</label>
            <input type="file" name="image" class="form-control" id="ImageUpload">
            <img id="imgpreview" class="pt-2" style="max-width: 200px;" />
        </div>
        <div class="shop-menu pull-right">
            <button class="btn btn-success">Thêm</button>
            <a class="btn btn-warning" href="{{ route('sanpham.index') }}">Hủy</a>
        </div>
    </form>
</div>
@endsection
