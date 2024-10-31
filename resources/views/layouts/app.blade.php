@php($categorias = \App\Models\Categoria::all()->sortBy('posicion'))

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if(View::hasSection('titulo'))
            @yield('titulo') - {{ config('app.name', 'Laravel') }}
        @else
            {{ config('app.name', 'Laravel') }}
        @endif
    </title>


    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @livewire('includes.toast-notification')
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-1 py-0">
            <div class="container">
                <div>
                    <a href="#" class="text-reset" style="text-decoration: none"><strong>Contáctate con nosotros</strong></a>
                </div>
                <div>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto d-flex flex-row">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a
                                        class="nav-link text-dark"
                                        href="{{ route('login') }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#loginModal">
                                        <i class="bi bi-person" style="-webkit-text-stroke: 1px"></i><strong> {{ __('Login') }}</strong>
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a
                                    id="navbarDropdown"
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    v-pre>
                                    <img src="{{ Auth::user()->profile_photo_url }}" class="rounded-circle" style="height: 1.8rem">
                                    <div class="d-inline-block my-auto py-2">
                                        <strong class="ms-1"> {{ Auth::user()->name }}</strong>
                                    </div>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end position-absolute" aria-labelledby="navbarDropdown">
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
                        <li class="nav-item ms-2 my-auto">
                            <a class="nav-link text-dark" href="#">
                                <i class="bi bi-cart3" style="-webkit-text-stroke: 1px"></i><strong> Carrito (0)</strong>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>


        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="/logo.png" alt="{{ config('app.name', 'Laravel') }}" title="{{ config('app.name', 'Laravel') }}">
            </a>

            <!-- Botón de colapso -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Elementos colapsables dentro de la barra de navegación -->
            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                <div class="row w-100">
                    <!-- Barra de navegación -->
                    <div class="col-12 col-xl-9 col-md-8 w-100">
                        <ul class="navbar-nav me-auto">
                            @foreach($categorias as $categoria)
                                @if(is_null($categoria->categoriaPadre) && $categoria->subcategorias->count() > 0)
                                    <li class="nav-item dropdown text-uppercase me-2">
                                        <a href="{{ url($categoria->slug) }}" class="nav-link dropdown-toggle" role="button">
                                            <strong class="text-wrap-custom">{{ $categoria->nombre }}</strong>
                                        </a>
                                        <ul class="dropdown-menu">
                                            @foreach($categoria->subcategorias as $subcategoria)
                                                <li>
                                                    <a
                                                        class="dropdown-item z-3"
                                                        href="{{ url($categoria->slug, $subcategoria->slug) }}">
                                                        {{ $subcategoria->nombre }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @elseif(is_null($categoria->categoriaPadre))
                                    <li class="nav-item text-uppercase">
                                        <a class="nav-link" href="{{ url($categoria->slug) }}">
                                            <strong>{{ $categoria->nombre }}</strong>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Barra de búsqueda siempre visible en pantallas pequeñas -->
            <div class="col-12 col-md-2 col-xl-3 mt-md-0 mt-2">
                @livewire('includes.buscar-producto')
            </div>
        </div>
    </nav>


    <main class="py-3">
            @yield('content')
        </main>
    </div>

{{--    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}

    <style>
         #navbarSupportedContent .navbar-nav .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0; /* Evita un salto al mostrar el menú */
        }

         #navbarSupportedContent .dropdown-toggle::after {
            display: none;
        }

         .text-wrap-custom {
             white-space: nowrap; /* No hacer wrap por defecto */
         }

         @media (max-width: 1400px) {
             .text-wrap-custom {
                 white-space: normal; /* Permitir wrap en pantallas pequeñas */
             }
         }
    </style>
    @livewire('includes.login-modal')

</body>
</html>
