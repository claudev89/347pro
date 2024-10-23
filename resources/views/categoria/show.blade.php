@extends('layouts.app')
@section('titulo', isset($categoria) ? $categoria->nombre : $subcategoria->nombre)
@section('content')
    <main class="container">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-reset fw-bold" style="text-decoration: none">Inicio</a></li>
                    @if(isset($subcategoria))
                        <li class="breadcrumb-item"><a href="{{ url($subcategoria->categoriaPadre->slug . '/'. $subcategoria->slug) }}" class="text-reset fw-bold" style="text-decoration: none">{{ $subcategoria->categoriaPadre->nombre }}</a></li>
                        <li class="breadcrumb-item active text-body-tertiary fw-bold" aria-current="page">{{ $subcategoria->nombre }}</li>
                    @else
                        <li class="breadcrumb-item active text-body-tertiary fw-bold" aria-current="page">{{ $categoria->nombre }}</li>
                    @endif
                </ol>
            </nav>
        </div>

        <div class="row">
            <div id="barraLateral" class="col-12 col-lg-3 col-sm-4">
                <div id="navegacion" class="bg-white px-3 py-4 mb-4">
                    @if(isset($subcategoria))
                        <h4 class="fw-bold text-uppercase">
                            <a href="{{ url($subcategoria->categoriaPadre->slug.'/'.$subcategoria->slug) }}" class="text-reset" style="text-decoration: none">
                                {{ $subcategoria->categoriaPadre->nombre }}
                            </a>
                        </h4>
                    @else
                        <h4 class="fw-bold text-uppercase mb-3">
                            <a href="{{ url($categoria->slug) }}" class="text-reset" style="text-decoration: none">
                                {{ $categoria->nombre }}
                            </a>
                        </h4>
                        @foreach($categoria->subcategorias as $subcat)
                            <h5 class="fw-bold text-capitalize">
                                <a href="{{ url($categoria->slug.'/'.$subcat->slug) }}" class="text-reset" style="text-decoration: none">
                                    {{ $subcat->nombre }}
                                </a>
                            </h5>
                        @endforeach
                    @endif
                </div>

                <div id="marcas" class="bg-white px-3 py-4 mb-4">
                    <span class="fw-bold">MARCAS</span>
                    <ul style="list-style-type: none; padding-left: 0">
                        <li>Marca 1</li>
                        <li>Marca 2</li>
                        <li>Marca n...</li>
                    </ul>
                </div>
            </div>

            <div id="contenido" class="col-12 col-lg-9 col-sm-8 mb-4">
                <div id="descripcionCategoria" class="bg-white px-3 pt-4 pb-2 mb-4">
                    @if(isset($subcategoria) )
                        @include('includes.categorias-header', ['categoria' => $subcategoria,])
                </div>
                    @elseif($categoria->subcategorias->count()>0)
                    @include('includes.categorias-header', ['categoria' => $categoria,])

            </div>
            <div id="subcategorias" class="bg-white p-3 mb-4">
                <h3 class="">Subcategorías</h3>

                <div id="subThumbs" class="row p-3 d-flex justify-content-center">
                    @foreach($categoria->subcategorias as $miniSub)
                        <div class="card p-0 me-2 mb-3 position-relative {{ $miniSub->defaultImage() ? '': 'bg-dark' }}" style="width: 12rem; height: 12rem">
                            @if($miniSub->defaultImage())
                                <img src="{{ asset('storage/'.$miniSub->defaultImage()) }}" class="card-img-top object-fit-cover h-100 w-100" alt="...">
                            @else
                                <div class="card-img-top"></div>
                            @endif

                            <div class="position-absolute bottom-0 w-100 text-center">
                                <h5 class="text-white text-uppercase bg-dark bg-opacity-25 py-1" style="text-shadow: 1px 1px 2px #3e4348, 0 0 1em #000000, 0 0 0.2em #000000;">
                                    {{ $miniSub->nombre }}
                                </h5>
                            </div>
                            <a href="{{ url($categoria->slug.'/'.$miniSub->slug) }}" class="stretched-link"></a>
                        </div>
                    @endforeach
                </div>
            </div>
            @else
                @include('includes.categorias-header', ['$categoria' => $categoria])
        </div>
                    @endif


            <div id="productos" class="p-3">
                <livewire:productos-en-categorias :categoria="isset($categoria) ? $categoria : $subcategoria" />
            </div>
            </div>
    </main>
    @include('includes.footer')
@endsection
