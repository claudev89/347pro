@extends('layouts.app')
@section('titulo', $producto->nombre)
@section('content')
    <main class="container" x-data="{ imagenPrincipal: '{{ asset('storage/' . $producto->imagenes[0]) }}', videoUrl: '', indiceActual: 0 }">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fw-bold">
                <li class="breadcrumb-item"><a href="/" class="text-reset" style="text-decoration: none">Inicio</a></li>
                @if($producto->categoria->categoriaPadre)
                    <li class="breadcrumb-item">
                        <a
                            href="{{ url($producto->categoria->categoriaPadre->slug) }}"
                            class="text-reset"
                            style="text-decoration: none"
                        >
                            {{ $producto->categoria->categoriaPadre->nombre }}
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a
                            href="{{ url($producto->categoria->categoriaPadre->slug . '/' . $producto->categoria->slug) }}"
                            class="text-reset"
                            style="text-decoration: none">
                            {{ $producto->categoria->nombre }}
                        </a>
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a
                            href="{{ url($producto->categoria->slug) }}"
                            class="text-reset"
                            style="text-decoration: none">
                            {{ $producto->categoria->nombre }}
                        </a>
                    </li>
                @endif

                <li class="breadcrumb-item active" aria-current="page">{{ $producto->nombre }}</li>
            </ol>
        </nav>

        <div class="row" id="fotosYDescCorta">
            <div id="fotos" class="col-12 col-md-6 px-4 mb-3 position-relative">
                <div class="sticky-top z-0 pt-2">
                    <template x-if="!videoUrl">
                        <div class="ratio ratio-1x1 mb-3 bg-white position-relative">
                            <img :src="imagenPrincipal" class="object-fit-contain mb-3 d-block mx-auto" alt="{{ $producto->nombre }}">
                            <div class="overlay-button position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-dark bg-opacity-75">
                                <a class="btn rounded-circle px-3 stretched-link text-white" data-bs-toggle="modal" data-bs-target="#galeriaModal">
                                    <i class="bi bi-search fs-1"></i>
                                </a>
                            </div>
                            @if($producto->created_at->diffInDays(now()) <= 30)
                                <span class="badge text-bg-primary top-0 start-0 mt-2 ms-1 text-white w-auto h-auto position-absolute fs-6">
                                    <i class="bi bi-stars"></i> NUEVO
                                </span>
                            @endif
                        </div>
                    </template>
                    <template x-if="videoUrl">
                        <div class="ratio ratio-1x1 mb-3 bg-white position-relative">
                            <video x-ref="video" autoplay controls class="w-100 object-fit-contain" :src="videoUrl"></video>
                            <div class="overlay-button position-absolute top-0 start-0 w-100" style="height: 90%">
                                <div class="d-flex justify-content-center align-items-center w-100 h-100 bg-dark bg-opacity-75">
                                    <a class="btn rounded-circle px-3 stretched-link text-white" data-bs-toggle="modal" data-bs-target="#galeriaModal">
                                        <i class="bi bi-search fs-1"></i>
                                    </a>
                                </div>
                                @if($producto->created_at->diffInDays(now()) <= 30)
                                    <span class="badge text-bg-primary top-0 start-0 mt-2 ms-1 text-white w-auto h-auto position-absolute fs-6">
                                    <i class="bi bi-stars"></i> NUEVO
                                </span>
                                @endif
                            </div>
                        </div>
                    </template>

                    <div class="row">
                        @foreach($producto->imagenes as $imagen)
                            <div class="col-3">
                                @if(pathinfo(asset('storage/' . $imagen), PATHINFO_EXTENSION) === 'mp4' ||
                                pathinfo(asset('storage/' . $imagen), PATHINFO_EXTENSION) === 'mpeg4')
                                    <div class="ratio ratio-1x1 position-relative bg-white" style="cursor: pointer"
                                         @click="videoUrl = '{{ asset('storage/' . $imagen) }}#t=0.1'; imagenPrincipal = ''; indiceActual = {{ $loop->index }}; if ($refs.video) { $refs.video.pause(); $refs.video.currentTime = 0; }"
                                         :class="videoUrl == '{{ asset('storage/' . $imagen) }}#t=0.1' ?
                                        'border border-4 border-primary' :
                                        ''"
                                    >
                                        <video class="w-100 object-fit-contain">
                                            <source src="{{ asset('storage/' . $imagen) }}#t=0.1" type="video/mp4">
                                        </video>
                                        <div class="position-absolute top-50 start-50 translate-middle d-flex justify-content-center align-items-center w-100 h-100">
                                            <i class="bi bi-play-circle-fill text-white opacity-70" style="font-size: 3rem;"></i>
                                        </div>
                                    </div>
                                @else
                                    <div class="ratio ratio-1x1 bg-white" style="cursor: pointer;">
                                        <img
                                            src="{{ asset('storage/' . $imagen) }}"
                                            alt="{{ $producto->nombre . ' - ' }}"
                                            class="object-fit-contain bg-white"
                                            @click="imagenPrincipal = '{{ asset('storage/' . $imagen) }}'; videoUrl = ''; if ($refs.video) { $refs.video.pause(); $refs.video.currentTime = 0; } indiceActual = {{ $loop->index }}; galeria.mostrarImagen({{ $loop->index }})"
                                            :class="imagenPrincipal == '{{ asset('storage/' . $imagen) }}' ? 'border border-4 border-primary' : ''"
                                        >
                                    </div>
                                @endif

                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

            <div id="descripcion" class="col-12 col-md-6">
                <h4 class="text-uppercase fw-bold">{{ $producto->nombre }}</h4>
                <span class="text-primary fw-bold fs-5">${{ number_format($producto->precio, 0, ',', '.') }}</span>

                <p>
                    {!! $producto->descripcion_corta !!}
                </p>

                <div class="mb-3" style="max-width: 20rem">
                    @livewire('includes.aniadir-al-carro', ['producto' => \App\Models\Producto::where('slug', $producto->slug)->first()])
                    @include('includes.productos.stock-alert', ['stock' => $producto->cantidad])
                </div>

                <div class="mb-3">
                    <span class="fs-5">Compartir</span>
                    @include('includes.sharer')
                </div>

                <section id="descripcionProducto">

                    <ul class="nav nav-underline justify-content-center" id="descripcionTabs" role="tablist">
                        <li class="nav-item bg-white px-2 rounded-top" role="presentation" style="margin-right: -14px;">
                            <button class="nav-link active bg-white" id="descripcion-tab" data-bs-toggle="tab" data-bs-target="#descripcion-tab-pane" type="button" role="tab" aria-controls="descripcion-tab-pane" aria-selected="true">Descripción</button>
                        </li>
                        <li class="nav-item bg-white px-2 rounded-top" role="presentation">
                            <button class="nav-link" id="detalles-tab" data-bs-toggle="tab" data-bs-target="#detalles-tab-pane" type="button" role="tab" aria-controls="detalles-tab-pane" aria-selected="false">Detalles</button>
                        </li>
                    </ul>
                    <div class="tab-content bg-white p-3 mb-4" id="myTabContent">
                        <div class="tab-pane fade show active" id="descripcion-tab-pane" role="tabpanel" aria-labelledby="descripcion-tab" tabindex="0">
                            {!! $producto->descripcion_larga !!}
                        </div>
                        <div class="tab-pane fade" id="detalles-tab-pane" role="tabpanel" aria-labelledby="detalles-tab" tabindex="0">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th scope="col">Marca</th>
                                    <th scope="col">
                                        @if($producto->marca)
                                            <img src="{{ asset('storage/' . $producto->marca->imagen) }}" alt="{{ $producto->marca->nombre }}" style="height: 5rem">
                                        @else
                                            Genérico
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="row">Unidades disponibles</th>
                                    <td>{{ $producto->cantidad }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

            </div>
        </div>

        <section id="resenias" class="mb-4 p-4">
            @livewire('includes.valoraciones', ['producto' => $producto])
        </section>

        @if($producto->categoria->productos->count() > 1)
            <section id="related" class="px-4 mb-4">
                <h4 class="fw-bold">Otros productos en la misma categoría:</h4>
                <div class="row">
                    @foreach($producto->categoria->productos->where('id', '!=', $producto->id)->take(4) as $productoRelacionado)
                        @livewire('includes.producto-thumb',  ['productoId' => $productoRelacionado->id], key($productoRelacionado->id))
                    @endforeach
                </div>
            </section>
        @endif

        <section id="masVistos" class="px-4 mb-4">
            <h4 class="fw-bold">Productos más vistos</h4>
            <div class="row">
                @foreach(\App\Models\Producto::orderBy('visitas', 'desc')->take(4)->get() as $productoMasVisto)
                    @livewire('includes.producto-thumb',  ['productoId' => $productoMasVisto->id], key($productoMasVisto->id))
                @endforeach
            </div>
        </section>

        @include('producto.galeriaModal', ['producto' => $producto])


        <style>
            .overlay-button {
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            /* Mostrar el botón cuando se hace hover sobre el div que contiene la imagen */
            .ratio:hover .overlay-button {
                opacity: 1;
            }

            #galeriaModal .modal-content {
                background-color: transparent !important;
                border: 0px !important
            }
        </style>

    </main>

    @include('includes.footer')
@endsection
