@extends('layouts.app')
@section('titulo', 'Productos')
@section('content')
    <main class="container">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-reset fw-bold" style="text-decoration: none">Inicio</a></li>
                    <li class="breadcrumb-item active text-body-tertiary fw-bold" aria-current="page">Productos</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div id="barraLateral" class="col-12 col-lg-3 col-sm-4">

                <div id="marcas" class="bg-white px-3 py-4 mb-4">
                    <span class="fw-bold">MARCAS</span>
                    <ul style="list-style-type: none; padding-left: 0">
                        @foreach(\App\Models\Marca::all() as $marca)
                            <li>
                                <a href="{{ request()->fullUrlWithQuery(['marca' => $marca->slug]) }}" style="text-decoration: none">
                                    {{$marca->nombre}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div id="contenido" class="col-12 col-lg-9 col-sm-8 mb-4">
                <div id="productos" class="px-3 pt-4 pb-2 mb-4">
                    @livewire('productos-en-categorias')
                </div>
            </div>
        </div>
    </main>
    @include('includes.footer')
@endsection
