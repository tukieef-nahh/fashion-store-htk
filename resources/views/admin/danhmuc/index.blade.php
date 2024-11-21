@extends('admin.layout')

@section('title', 'Quản lý danh mục')

@section('content')
<h3>Danh sách danh mục</h3>
<div>
    <div class="col-sm-6">
        <a class="btn btn-success" href="{{route('danhmuc.create')}}">Thêm danh mục</a>
    </div>
    <div class="col-sm-6">
        <form action="{{route('danhmuc.index')}}" method="get">
            <div class="search_box pull-right">
                <input type="text" name="SearchString" placeholder="Tìm kiếm..." value="{{ request()->get('SearchString') }}"/>
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
            <th scope="col" width="5%">#</th>
            <th scope="col" width="12%">
                <a href="{{ route('danhmuc.index', ['sort_column' => 'tenDM', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc', 'SearchString' => request('SearchString')]) }}">
                    Tên danh mục
                </a>
            </th>
            <th scope="col" width="22%">Mô tả</th>
            <th scope="col" width="10%">Slug</th>
            <th scope="col" width="8%">
                <a href="{{ route('danhmuc.index', ['sort_column' => 'status', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc', 'SearchString' => request('SearchString')]) }}">
                    Trạng thái
                </a>
            </th>
            <th scope="col" width="12%">
                <a href="{{ route('danhmuc.index', ['sort_column' => 'created_at', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc', 'SearchString' => request('SearchString')]) }}">
                    Ngày tạo
                </a>
            </th>
            <th scope="col" width="12%">
                <a href="{{ route('danhmuc.index', ['sort_column' => 'updated_at', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc', 'SearchString' => request('SearchString')]) }}">
                    Ngày cập nhật
                </a>
            </th>
            
            <th scope="col" width="25%">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if($danhMucs->isNotEmpty())
            @foreach ($danhMucs as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->tenDM }}</td>
                    <td>{{ $item->moTa }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>
                        @if ($item->status == 1)
                            <span class="text text-success">Hiện</span>
                        @else
                            <span class="text text-danger">Ẩn</span>
                        @endif
                    </td>
                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $item->updated_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a class="btn btn-success btn-sm" href="{{ route('danhmuc.show', $item->id) }}">Xem</a>
                        <a class="btn btn-warning btn-sm" href="{{ route('danhmuc.edit', $item->id) }}">Chỉnh sửa</a>
                        <button class="btn btn-danger btn-sm confirmDeletion" data-id="{{ $item->id }}">Xóa</button>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">
                    <div class="col-sm-12">
                        Không tồn tại danh mục này trong danh sách.
                    </div>
                </td>
            </tr>
        @endif
    </tbody>
</table>

{{ $danhMucs->links() }}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.confirmDeletion', function() {
        var id = $(this).data('id');
        var token = '{{ csrf_token() }}';

        if (confirm("Bạn có chắc chắn muốn xóa mục này?")) {
            $.ajax({
                url: "{{ route('danhmuc.destroy', '') }}/" + id,
                type: 'DELETE',
                data: {
                    _token: token
                },
                success: function(response) {
                    $('tr').filter(function() {
                        return $(this).find('th').text() == id; 
                    }).remove();
                    alert('Danh mục đã được xóa thành công.');
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