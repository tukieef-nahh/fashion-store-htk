@extends('admin.layout')

@section('title', 'Quản lý danh mục')

@section('content')
<div class="container">
    <h1 class="text-center mt-5">Chức năng nâng cấp</h1>
    <div class="alert alert-info text-center mt-4">
        <h4>Thông báo:</h4>
        <p>Chức năng này sẽ được nâng cấp trong phiên bản sắp tới!</p>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('sanpham.index') }}" class="btn btn-primary">Quay về trang chính</a>
    </div>
</div>
@endsection

@section('styles')
<style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    h1 {
        color: #343a40;
        font-weight: bold;
    }

    .alert {
        border-radius: 8px;
        padding: 20px;
        background-color: #e7f1ff;
        color: #004085;
        border: 1px solid #b8daff;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        text-decoration: none;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>
@endsection
