@extends('admin.layout')

@section('title', 'Thêm danh mục')

@section('content')
<h4>Thêm danh mục</h4>
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

    <form action="{{ route('danhmuc.store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Tên danh mục</label>
            <input type="text" name="tenDM" class="form-control" value="{{ old('tenDM') }}" />
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="moTa" class="form-control">{{ old('moTa') }}</textarea>
        </div>
        <div class="form-group">
            <label>Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1">Hiển thị</option>
                <option value="0">Ẩn</option>
            </select>
        </div>
        <div class="shop-menu pull-right">
            <button class="btn btn-success">Thêm</button>
            <a class="btn btn-warning" href="{{ route('danhmuc.index') }}">Hủy</a>
        </div>
    </form>
</div>
@endsection