<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/57fbadb1d3.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @toastr_css

</head>

<body>
    <div class="nav_container">
        <div class="container-fluid">
            <!-- First section -->
            <nav class="navbar navbar-dark bg-dark">
                <div class="container">
                    <h1>
                        <a href="/" class="navbar-brand">MC Forum</a>
                    </h1>
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white mb-2 " href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="{{ asset('storage/avatars/'.Auth::user()->avatar) }}"
                                alt="{{ Auth::user()->name }}'s avatar" style="width: 40px">

                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('home', auth()->id()) }}">
                                Account
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
    </nav>
    </div>
    </nav>

    <!-- first section end -->
    </div>
    <div class="footer_container">
        <div class="container">
            <main class="py-4">
                @yield('content')
            </main>
            <div class="container-fluid">
                <footer class="small bg-dark text-white">
                    <div class="container py-4">
                        <ul class="list-inline mb-0 text-center">
                            <li class="list-inline-item">
                                &copy; 2022 MC Forum
                            </li>
                            <li class="list-inline-item">All rights reserved</li>
                            <li class="list-inline-item">Terms and privacy policy</li>
                        </ul>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</body>
@jquery
@toastr_js

</html>
