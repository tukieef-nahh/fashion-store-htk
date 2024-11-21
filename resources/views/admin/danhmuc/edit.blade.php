@extends('admin.layout')

@section('title', 'Chỉnh sửa danh mục')

@section('content')
<h4>Chỉnh sửa thông tin danh mục</h4>
<div class="col-sm-6">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>

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

    <form action="{{ route('danhmuc.update', $danhMuc->id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label>Tên danh mục</label>
            <input type="text" name="tenDM" class="form-control" value="{{ old('tenDM', $danhMuc->tenDM) }}" />
        </div>

        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="moTa" class="form-control">{{ old('moTa', $danhMuc->moTa) }}</textarea>
        </div>

        <div class="form-group">
            <label>Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1" {{ $danhMuc->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ $danhMuc->status == 0 ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>

        <div class="shop-menu pull-right">
            <button type="submit" class="btn btn-success">Lưu</button>
            <a class="btn btn-warning btn-sm" href="{{ route('danhmuc.index') }}">Hủy</a>
        </div>
    </form>
</div>
@endsection