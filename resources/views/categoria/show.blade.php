@extends('layouts.app')
@section('content')
    <main class="container">
        <div>
            @if($subcategoria)
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-reset fw-bold" style="text-decoration: none">
                                Inicio
                            </a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{ url($categoria->slug) }}" class="text-reset fw-bold" style="text-decoration: none">
                                {{ $subcategoria->categoriaPadre->nombre }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-body-tertiary fw-bold" aria-current="page">
                            {{ $subcategoria->nombre }}
                        </li>
                    </ol>
                </nav>
            @else
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-reset fw-bold" style="text-decoration: none">
                                Inicio
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-body-tertiary fw-bold" aria-current="page">
                            {{ $categoria->nombre }}
                        </li>
                    </ol>
                </nav>
            @endif
        </div>

        <div class="row">
            <div id="barraLateral" class="col-12 col-lg-3 col-sm-4">
                <div id="navegacion" class="bg-white px-3 py-4 mb-4">
                    @if($subcategoria)
                        <h4 class="fw-bold text-uppercase">
                            <a href="{{ url($categoria->slug.'/'.$subcategoria->slug) }}" class="text-reset" style="text-decoration: none">
                                {{ $subcategoria->nombre }}
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
                    @if($subcategoria )
                        @include('includes.categorias-header',
                            [
                                'imgCat' => $subcategoria->imagen,
                                'nomCat' => $subcategoria->nombre,
                                'descCat' => $subcategoria->descripcion
                                ])
                </div>
                    @elseif($categoria->subcategorias->count()>0)
                    @include('includes.categorias-header',
                       [
                           'imgCat' => $categoria->imagen,
                           'nomCat' => $categoria->nombre,
                           'descCat' => $categoria->descripcion
                           ])
            </div>
            <div id="subcategorias" class="bg-white p-3 mb-4">
                <h3 class="">Subcategorías</h3>

                <div id="subThumbs" class="row p-3 d-flex justify-content-center">
                    @foreach($categoria->subcategorias as $miniSub)
                        <div class="card p-0 me-2 mb-3 {{ $miniSub->imagen ? '': 'bg-dark' }}" style="width: 12rem; height: 12rem">
                            @if($miniSub->imagen)
                                <img src="{{ asset('storage/'.$miniSub->imagen) }}" class="card-img-top object-fit-cover h-100 w-100" alt="...">
                            @else
                                <div class="card-img-top"></div>
                            @endif

                            <div class="card-img-overlay mx-auto">
                                <h5 class="card-title text-white text-uppercase" style="text-shadow: -2px 2px black, -2px 2px black">
                                    {{ $miniSub->nombre }}
                                </h5>
                            </div>
                            <a href="{{ url($categoria->slug.'/'.$miniSub->slug) }}" class="stretched-link"></a>
                        </div>
                    @endforeach
                </div>
            </div>
            @else
                @include('includes.categorias-header',
                           [
                               'imgCat' => $categoria->imagen,
                               'nomCat' => $categoria->nombre,
                               'descCat' => $categoria->descripcion
                               ])
        </div>
                    @endif


            <div id="productos" class="p-3">
                Acá irian los productos de la categoría o subcategoría en un componetne de LiveWire
            </div>
            </div>
    </main>
    @include('includes.footer')
@endsection
