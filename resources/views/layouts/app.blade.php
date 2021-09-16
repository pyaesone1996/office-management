<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @yield('style')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mycustom.css') }}" rel="stylesheet">
</head>

<body>

    @auth
        <header id="app" class="sticky-top">
            <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm navbar">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->


                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="{{ url('/') }}" class="nav-link text-sucess {{ active('/') }}">Companies</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/employees') }}"
                                    class="nav-link text-sucess {{ active('employees') }}">Employees</a>
                            </li>
                        </ul>

                        <div class="navbar-nav mr-3">
                            <input class="form-control mr-sm-2 rounded-pill" id="myInput" type="text"
                                placeholder="Search In Here">
                        </div>


                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right mt-3" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>

                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

        </header>
    @endauth
    <main class="my-4 wrapper" style="min-height:620px">
        @yield('content')
    </main>

    <footer class="bg-white shadow py-4 shadow-sm">
        <p class="text-center mb-0"> © 2020 Power By <a href="https://github.com/pyaesone1996" target="_blank">
                <i class="ti-github pr-2"></i>Pyae Sone </a></p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')

</body>

</html>
