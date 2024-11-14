<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title', 'Admin | Fashion Shop')</title>

    <base href="/">
    <link href="source/assets/dest/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.1/css/font-awesome.css" rel="stylesheet">
    <link href="source/assets/dest/css/prettyPhoto.css" rel="stylesheet">
    <link href="source/assets/dest/css/price-range.css" rel="stylesheet">
    <link href="source/assets/dest/css/animate.css" rel="stylesheet">
    <link href="source/assets/dest/css/main2.css" rel="stylesheet">
    <link href="source/assets/dest/css/responsive.css" rel="stylesheet">
    
    <link rel="shortcut icon" href="source/favicon.ico">
</head>

<body>
    <!--header-->
    <header id="header">
        <!--header-middle-->
        <div class="header-middle">
            <div class="container d-flex justify-content-between align-items-center">
                <a href="{{ route('sanpham.index') }}" class="header-logo">Fashion Store</a>
                <div class="shop-menu">
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" style="background:none; border:none; color: inherit; cursor:pointer;">
                            <i class="fa fa-sign-out"></i> Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!--/header-middle-->
        
        <!--header-bottom-->
        <div class="header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mainmenu text-center">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                                    <a href="{{ route('users.index') }}"><i class="fa"></i>Quản lý Users</a>
                                </li>
                                <li class="{{ request()->routeIs('sanpham.index') ? 'active' : '' }}">
                                    <a href="{{ route('sanpham.index') }}"><i class="fa"></i>Quản lý sản phẩm</a>
                                </li>
                                <li class="{{ request()->routeIs('danhmuc.index') ? 'active' : '' }}">
                                    <a href="{{ route('danhmuc.index') }}"><i class="fa"></i>Quản lý danh mục</a>
                                </li>
                                <li class="{{ request()->routeIs('thuonghieu.index') ? 'active' : '' }}">
                                    <a href="{{ route('thuonghieu.index') }}"><i class="fa"></i>Quản lý thương hiệu</a>
                                </li>
                                <li class="{{ request()->routeIs('donhang.index') ? 'active' : '' }}">
                                    <a href="{{ route('donhang.index') }}"><i class="fa"></i>Quản lý đơn hàng</a>
                                </li>
                            </ul>
                        </div>
                    </div>      
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->

    <section>
        <div class="container">
            <div class="row">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </section>

    <script src="source/assets/dest/js/jquery.js"></script>
    <script src="source/assets/dest/js/bootstrap.min.js"></script>
    <script src="source/assets/dest/js/jquery.scrollUp.min.js"></script>
    <script src="source/assets/dest/js/price-range.js"></script>
    <script src="source/assets/dest/js/jquery.prettyPhoto.js"></script>
    <script src="source/assets/dest/js/main.js"></script>
    <script src="source/assets/dest/backend/js/site.js"></script>

    @stack('scripts')
</body>
</html>
