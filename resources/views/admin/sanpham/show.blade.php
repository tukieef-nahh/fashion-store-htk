<head>
    <base href="/">
    <link href="source/assets/dest/css/show.css" rel="stylesheet">
</head>

@extends('admin.layout')

@section('title', 'Thông tin sản phẩm')

@section('content')
<h4>Thông tin sản phẩm</h4>
<div class="col-sm-8">
    <div class="col-sm-4">
        <div class="form-group">
            <h4><b>Id sản phẩm:</b> {{ $sanpham->id }}</h4>
        </div>
        <div class="form-group">
            <h4><b>Tên sản phẩm:</b> {{ $sanpham->tenSP }}</h4>
        </div>
        <div class="form-group">
            <h4><b>Mô tả:</b> {{ $sanpham->moTa }}</h4>
        </div>
        <div class="form-group">
            <h4><b>Giá:</b> {{ number_format($sanpham->gia, 0, ',', '.') }} VND</h4>
        </div>
        <div class="form-group">
            <h4><b>Số lượng:</b> {{ $sanpham->soLuong }}</h4>
        </div>
        <div class="form-group">
            <h4><b>Danh mục:</b> {{ isset($sanpham->DanhMuc) ? $sanpham->DanhMuc->tenDM : 'N/A' }}</h4>
        </div>
        <div class="form-group">
            <h4><b>Thương hiệu:</b> {{ isset($sanpham->ThuongHieu) ? $sanpham->ThuongHieu->tenTH : 'N/A' }}</h4>
        </div>
    </div>
    <div class="col-sm-3 shop-menu pull-right">
        <div class="form-group">
            <h4><b>Ảnh:</b></h4>
            <img src="{{ asset('source/image/sanpham/' . $sanpham->image) }}" width="100px" />
        </div>
    </div>
    <div class="col-sm-12" style="margin-bottom: 15px">
        <div class="shop-menu pull-left">
            <button class="btn btn-danger confirmDeletion" data-id="{{ $sanpham->id }}">Xóa</button>
        </div>
        <div class="shop-menu pull-right">
            <a class="btn btn-success" href="{{ route('sanpham.edit', $sanpham->id) }}">Chỉnh sửa</a>
            <a class="btn btn-warning" href="{{ route('sanpham.index') }}">Quay lại</a>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.confirmDeletion', function() {
        var id = $(this).data('id');
        var token = '{{ csrf_token() }}'; // CSRF token

        if (confirm("Bạn có chắc chắn muốn xóa mục này?")) {
            $.ajax({
                url: "{{ route('sanpham.destroy', '') }}/" + id, // Sử dụng route để tạo URL
                type: 'DELETE',
                data: {
                    _token: token
                },
                success: function(response) {
                    alert('Sản phẩm đã được xóa thành công.');
                    window.location.href = "{{ route('sanpham.index') }}";
                },
                error: function(xhr) {
                    if (xhr.status === 403) {
                        var response = JSON.parse(xhr.responseText);
                        alert(response.error);
                    } else {
                        alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
                    }
                }
            });
        }
    });
</script>