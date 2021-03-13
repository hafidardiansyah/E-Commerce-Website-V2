<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'App' }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    ITShop
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="{{ route('products') }}" class="nav-link{{ request()->segment(1) == 'products' ? ' active' : '' }}">
                                List Product
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <form action="{{ route('search') }}" method="GET" class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="text" placeholder="Enter keyword..." aria-label="Search" name="keyword" autocomplete="on">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                                Search
                            </button>
                        </form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link{{ request()->segment(1) == 'login' ? ' active' : '' }}" href="{{ route('login') }}">{{ __('Login') }}
                            </a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link{{ request()->segment(1) == 'register' ? ' active' : '' }}" href="{{ route('register') }}">{{ __('Register') }}
                            </a>
                        </li>
                        @endif
                        @else

                        @if (Auth::user()->role == 1)
                        <a href="{{ route('cart') }}" class="nav-link{{ request()->segment(1) == 'cart' ? ' active' : '' }}"><i class='bx bxs-cart'></i>
                        </a>
                        @endif

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->role == 0)
                                <a class="dropdown-item" href="{{ route('create') }}">New Product</a>
                                <a class="dropdown-item" href="{{ route('payment') }}">Payment</a>
                                <a class="dropdown-item" href="{{ route('purchase') }}">Purchase</a>
                                @endif
                                @if (Auth::user()->role == 1)
                                <a class="dropdown-item" href="{{ route('my-order') }}">My Order</a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}
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
        </nav>

        <main class="py-4">
            @include('alert')
            @yield('content')
        </main>
    </div>

    <script>
        function previewImg() {

            // Img preview & file input
            const cover = document.querySelector('#image');
            const coverLabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview');

            // file input
            coverLabel.textContent = cover.files[0].name;

            // Image preview
            const fileCover = new FileReader();
            fileCover.readAsDataURL(cover.files[0]);
            fileCover.onload = function(e) {
                imgPreview.src = e.target.result;
            }

        }
    </script>
</body>

</html>