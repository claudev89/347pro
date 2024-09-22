<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-1 py-0">
            <div class="container">
                <div>
                    <a href="#" class="text-reset" style="text-decoration: none"><strong>Contáctate con nosotros</strong></a>
                </div>
                <div>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('login') }}">
                                        <i class="bi bi-person" style="-webkit-text-stroke: 1px"></i><strong> {{ __('Login') }}</strong>
                                    </a>
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
                        <li class="nav-item">
                            <a class="nav-link text-dark">
                                <i class="bi bi-cart3" style="-webkit-text-stroke: 1px" href="#"></i><strong> Carrito (0)</strong>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="logo.png" alt="{{ config('app.name', 'Laravel') }}" title="{{ config('app.name', 'Laravel') }}">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a href="#" class="nav-link text-dark text-uppercase"><strong>Máquinas</strong></a> </li>
                        <li class="nav-item"><a href="#" class="nav-link text-dark text-uppercase"><strong>Productos para el cabello</strong></a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-dark text-uppercase"><strong>Cepillos y peinetas</strong></a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-dark text-uppercase"><strong>Afeitado</strong></a></li>
                    </ul>


                </div>
                <div>
                    <div class="input-group">
                        <span class="input-group-text" id="search-icon"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Buscar en el catálogo" aria-label="Buscar" aria-describedby="search-icon">
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
