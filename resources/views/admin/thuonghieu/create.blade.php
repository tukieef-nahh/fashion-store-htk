@extends('admin.layout')

@section('title', 'Thêm thương hiệu')

@section('content')
<h4>Thêm thương hiệu</h4>
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

    <form action="{{ route('thuonghieu.store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Tên thương hiệu</label>
            <input type="text" name="tenTH" class="form-control" value="{{ old('tenTH') }}" />
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
            <a class="btn btn-warning" href="{{ route('thuonghieu.index') }}">Hủy</a>
        </div>
    </form>
</div>
@endsection