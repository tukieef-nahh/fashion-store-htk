@extends('admin.layout')

@section('title', 'Chỉnh sửa thương hiệu')

@section('content')
<h4>Chỉnh sửa thông tin thương hiệu</h4>
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

    <form action="{{ route('thuonghieu.update', $thuongHieu->id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label>Tên thương hiệu</label>
            <input type="text" name="tenTH" class="form-control" value="{{ old('tenTH', $thuongHieu->tenTH) }}"/>
        </div>

        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="moTa" class="form-control">{{ old('moTa', $thuongHieu->moTa) }}</textarea>
        </div>

        <div class="form-group">
            <label>Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1" {{ $thuongHieu->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ $thuongHieu->status == 0 ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>

        <div class="shop-menu pull-right">
            <button type="submit" class="btn btn-success">Lưu</button>
            <a class="btn btn-warning btn-sm" href="{{ route('thuonghieu.index') }}">Hủy</a>
        </div>
    </form>
</div>
@endsection