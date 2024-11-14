<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title', 'Wellcome | Fashion Shop')</title>

    <base href="/">
    <link href="source/assets/dest/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.1/css/font-awesome.css" rel="stylesheet">
    <link href="source/assets/dest/css/prettyPhoto.css" rel="stylesheet">
    <link href="source/assets/dest/css/price-range.css" rel="stylesheet">
    <link href="source/assets/dest/css/animate.css" rel="stylesheet">
    <link href="source/assets/dest/css/main2.css" rel="stylesheet">
    <link href="source/assets/dest/css/responsive.css" rel="stylesheet">
    
    <link rel="shortcut icon" href="source/favicon.ico">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <!--header-->
    <header id="header">
        <!--header-middle-->
        <div class="header-middle">
            <div class="container d-flex justify-content-between align-items-center">
                <a href="/home" class="header-logo">Fashion Store</a>
                <div class="shop-menu">
                    <div id="app">
                        <ul class="navbar-nav-acc ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif
    
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
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
                                <li>
                                    <a href="{{ route('sanpham.index') }}">Quản lý sản phẩm</a>
                                </li>
                                <li>
                                    <a href=""><i class="fa"></i>Danh mục</a>
                                </li>
                                <li>
                                    <a href=""><i class="fa"></i>Thương hiệu</a>
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
