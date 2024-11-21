@extends('admin.layout')

@section('title', 'Quản lý sản phẩm')

@section('content')
<h3>Danh sách sản phẩm</h3>
<div class="row mb-3">
    <div class="col-sm-6">
        <a href="{{route('sanpham.create')}}" class="btn btn-success">Thêm sản phẩm</a>
    </div>
    <div class="col-sm-6">
        <form action="{{route('sanpham.index')}}" method="GET">
            <div class="search_box pull-right">
                <input type="text" name="SearchString" placeholder="Tìm kiếm tên..." value="{{ request()->get('SearchString') }}"/>
                <button class="btn btn-success" type="submit">Tìm kiếm</button>
            </div>
        </form>
    </div>
</div>

<div class="col-sm-6">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col" width="3%">#</th>
            <th scope="col" width="11%">
                <a href="{{ route('sanpham.index', ['sort_column' => 'tenDM', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc', 'SearchString' => request('SearchString')]) }}">
                    Tên sản phẩm
                </a>
            </th>
            <th scope="col" width="13%">Mô tả</th>
            <th scope="col" width="5%">
                <a href="{{ route('sanpham.index', ['sort_column' => 'tenDM', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc', 'SearchString' => request('SearchString')]) }}">
                    Giá
                </a>
            </th>
            <th scope="col" width="8%">Số lượng</th>
            <th scope="col" width="5%">Ảnh</th>
            <th scope="col" width="8%">
                <a href="{{ route('sanpham.index', ['sort_column' => 'status', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc', 'SearchString' => request('SearchString')]) }}">
                    Danh mục

                </a>
            </th>
            <th scope="col" width="10%">
                <a href="{{ route('sanpham.index', ['sort_column' => 'status', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc', 'SearchString' => request('SearchString')]) }}">
                    Thương hiệu
                </a>
            </th>
            <th scope="col" width="6%">
                <a href="{{ route('sanpham.index', ['sort_column' => 'created_at', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc', 'SearchString' => request('SearchString')]) }}">
                    Ngày tạo
                </a>
            </th>
            <th scope="col" width="11%">
                <a href="{{ route('sanpham.index', ['sort_column' => 'updated_at', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc', 'SearchString' => request('SearchString')]) }}">
                    Ngày cập nhật
                </a>
            </th>
            <th scope="col" width="20%">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sanphams as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>{{ $item->tenSP }}</td>
                <td>{{ $item->moTa }}</td>
                <td>{{ number_format($item->gia, 3, ',', '.') }} VND</td>
                <td>{{ $item->soLuong }}</td>
                <td><img src="{{ asset('source/image/sanpham/' . $item->image) }}" width="100px" height="100px" /></td>
                <td>{{ isset($item->DanhMuc) ? $item->DanhMuc->tenDM : 'N/A' }}</td>
                <td>{{ isset($item->ThuongHieu) ? $item->ThuongHieu->tenTH : 'N/A' }}</td>
                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $item->updated_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{route('sanpham.show', $item->id)}}" class="btn btn-success btn-sm">Xem</a>
                    <a href="{{route('sanpham.edit', $item->id)}}" class="btn btn-warning btn-sm">Chỉnh sửa</a>
                    <button class="btn btn-danger btn-sm confirmDeletion" data-id="{{ $item->id }}">Xóa</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">
                    <div class="col-sm-12">
                        Không tồn tại sản phẩm này trong danh sách.
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $sanphams->links() }}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.confirmDeletion', function() {
        var id = $(this).data('id');
        var token = '{{ csrf_token() }}';

        if (confirm("Bạn có chắc chắn muốn xóa mục này?")) {
            $.ajax({
                url: "{{ route('sanpham.destroy', '') }}/" + id,
                type: 'DELETE',
                data: {
                    _token: token
                },
                success: function(response) {
                    $('tr').filter(function() {
                        return $(this).find('th').text() == id; 
                    }).remove();
                    alert('Sản phẩm đã được xóa thành công.');
                    location.reload(); 
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

@endsection