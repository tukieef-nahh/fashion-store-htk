<?php

Auth::routes();

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


//Route cho trang login
Route::get('dang-nhap', [
    'as' => 'login',
    'uses' => 'App\Http\Controllers\Auth\LoginController@showLoginForm'
]);

Route::post('dang-nhap', [
    'as' => 'login.submit',
    'uses' => 'App\Http\Controllers\Auth\LoginController@login'
]);

// Route cho trang register
Route::get('dang-ky', [
    'as' => 'register',
    'uses' => 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm'
]);

Route::post('dang-ky', [
    'as' => 'register.submit',
    'uses' => 'App\Http\Controllers\Auth\RegisterController@register'
]);



// Route cho logout
Route::post('logout', [
    'as' => 'logout',
    'uses' => 'App\Http\Controllers\Auth\LoginController@logout'
]);


//Auth
Route::get('/home', [
    'as' => 'home',
    'uses' => function () {
        return view('home');
    }
]);

Route::middleware(['auth'])->group(function () {
    //Route::resource('sanpham', SanPhamController::class);
    //Admin/Quản lý sản phẩm
    Route::middleware(['logSanPhamActivity'])->group(function () {
        Route::get('quan-ly-san-pham', [
            'as' => 'sanpham.index',
            'uses' => 'App\Http\Controllers\Admin\SanPhamController@index'
        ]);

        Route::get('quan-ly-san-pham/them-san-pham', [
            'as' => 'sanpham.create',
            'uses' => 'App\Http\Controllers\Admin\SanPhamController@create'
        ]);

        Route::post('quan-ly-san-pham/luu-san-pham', [
            'as' => 'sanpham.store',
            'uses' => 'App\Http\Controllers\Admin\SanPhamController@store'
        ]);

        Route::get('quan-ly-san-pham/xem-san-pham/{id}', [
            'as' => 'sanpham.show',
            'uses' => 'App\Http\Controllers\Admin\SanPhamController@show'
        ]);

        Route::get('quan-ly-san-pham/sua-san-pham/{id}', [
            'as' => 'sanpham.edit',
            'uses' => 'App\Http\Controllers\Admin\SanPhamController@edit'
        ]);

        Route::put('quan-ly-san-pham/cap-nhat-san-pham/{id}', [
            'as' => 'sanpham.update',
            'uses' => 'App\Http\Controllers\Admin\SanPhamController@update'
        ]);

        Route::delete('quan-ly-san-pham/xoa-san-pham/{id}', [
            'as' => 'sanpham.destroy',
            'uses' => 'App\Http\Controllers\Admin\SanPhamController@destroy'
        ])->middleware(['is_admin']);
    });





    //Admin/Quản lý danh mục
    Route::get('quan-ly-danh-muc', [
        'as' => 'danhmuc.index',
        'uses' => 'App\Http\Controllers\Admin\DanhMucController@index'
    ]);

    Route::get('quan-ly-danh-muc/them-danh-muc', [
        'as' => 'danhmuc.create',
        'uses' => 'App\Http\Controllers\Admin\DanhMucController@create'
    ]);

    Route::post('quan-ly-danh-muc/luu-danh-muc', [
        'as' => 'danhmuc.store',
        'uses' => 'App\Http\Controllers\Admin\DanhMucController@store'
    ]);

    Route::get('quan-ly-danh-muc/xem-danh-muc/{id}', [
        'as' => 'danhmuc.show',
        'uses' => 'App\Http\Controllers\Admin\DanhMucController@show'
    ]);

    Route::get('quan-ly-danh-muc/sua-danh-muc/{id}', [
        'as' => 'danhmuc.edit',
        'uses' => 'App\Http\Controllers\Admin\DanhMucController@edit'
    ]);

    Route::put('quan-ly-danh-muc/cap-nhat-danh-muc/{id}', [
        'as' => 'danhmuc.update',
        'uses' => 'App\Http\Controllers\Admin\DanhMucController@update'
    ]);

    Route::delete('quan-ly-danh-muc/xoa-danh-muc/{id}', [
        'as' => 'danhmuc.destroy',
        'uses' => 'App\Http\Controllers\Admin\DanhMucController@destroy'
    ])->middleware(['is_admin']);




    //Admin/Quản lý thương hiệu
    Route::get('quan-ly-thuong-hieu', [
        'as' => 'thuonghieu.index',
        'uses' => 'App\Http\Controllers\Admin\ThuongHieuController@index'
    ]);

    Route::get('quan-ly-thuong-hieu/them-thuong-hieu', [
        'as' => 'thuonghieu.create',
        'uses' => 'App\Http\Controllers\Admin\ThuongHieuController@create'
    ]);

    Route::post('quan-ly-thuong-hieu/thuonghieu-thuong-hieu', [
        'as' => 'thuonghieu.store',
        'uses' => 'App\Http\Controllers\Admin\ThuongHieuController@store'
    ]);

    Route::get('quan-ly-thuong-hieu/xem-thuong-hieu/{id}', [
        'as' => 'thuonghieu.show',
        'uses' => 'App\Http\Controllers\Admin\ThuongHieuController@show'
    ]);

    Route::get('quan-ly-thuong-hieu/sua-thuong-hieu/{id}', [
        'as' => 'thuonghieu.edit',
        'uses' => 'App\Http\Controllers\Admin\ThuongHieuController@edit'
    ]);

    Route::put('quan-ly-thuong-hieu/cap-nhat-thuong-hieu/{id}', [
        'as' => 'thuonghieu.update',
        'uses' => 'App\Http\Controllers\Admin\ThuongHieuController@update'
    ]);

    Route::delete('quan-ly-thuong-hieu/xoa-thuong-hieu/{id}', [
        'as' => 'thuonghieu.destroy',
        'uses' => 'App\Http\Controllers\Admin\ThuongHieuController@destroy'
    ])->middleware(['is_admin']);




    //Admin/Quản lý đơn hàng
    Route::get('quan-ly-don-hang', [
        'as' => 'donhang.index',
        'uses' => 'App\Http\Controllers\Admin\DonHangController@index'
    ]);




    //Admin/Quản lý users
    Route::get('quan-ly-users', [
        'as' => 'users.index',
        'uses' => 'App\Http\Controllers\Admin\UsersController@index'
    ]);
});