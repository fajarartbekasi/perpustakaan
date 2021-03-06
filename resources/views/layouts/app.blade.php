<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    @if (Route::has('login'))
                        @auth
                            <ul class="navbar-nav mr-3">
                                @role('petugas|anggota')
                                    <a href="{{route('home')}}">
                                        <li class="navbar-nav mr-auto text-muted">
                                            Home
                                        </li>
                                    </a>
                                    <a href="{{route('books.index')}}">
                                        <li class="navbar-nav ml-3 text-muted">
                                            Buku
                                        </li>
                                    </a>
                                @endrole
                                @role('petugas')
                                    <a href="{{route('users.index')}}">
                                        <li class="navbar-nav mr-auto text-muted ml-3">
                                            User
                                        </li>
                                    </a>
                                    <a href="{{route('cetak')}}">
                                        <li class="navbar-nav mr-auto text-muted ml-3">
                                            Cetak Kartu Anggota
                                        </li>
                                    </a>
                                    <a href="{{route('category.create')}}">
                                        <li class="navbar-nav mr-auto text-muted ml-3">
                                            Category
                                        </li>
                                    </a>
                                    <a href="{{route('borrowings.index')}}">
                                        <li class="navbar-nav mr-auto text-muted ml-3">
                                            Peminjaman
                                        </li>
                                    </a>
                                    <a href="{{route('pengembalian.index')}}">
                                        <li class="navbar-nav mr-auto text-muted ml-3">
                                           Buat Pengembalian
                                        </li>
                                    </a>
                                    <a href="{{route('rekap-laporan.pengembalian')}}">
                                        <li class="navbar-nav mr-auto text-muted ml-3">
                                            Pengembalian
                                        </li>
                                    </a>
                                @endrole
                            </ul>
                        @endauth
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
            <div class="container">
                <div id="flash-msg">
                </div>
                @include('flash::message')
                @include('layouts._errors')
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
