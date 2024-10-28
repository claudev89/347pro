<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mb-3 d-flex justify-content-center">
    @php($portada = '')
    <div class="card bg-white"
         style="width: 18rem;"
         x-data="{ vistaPrevia: false }" x-on:mouseover="vistaPrevia = true" x-on:mouseleave="vistaPrevia = false">
        <div class="position-relative">
            <div id="etiquetasYBotones" class="z-2">
                @if($producto->created_at->diffInDays(now()) <= 30)
                    <span class="badge text-bg-primary position-absolute top-0 start-0 mt-2 ms-1 text-white pt-2 pb-1 z-2">
                    <i class="bi bi-stars"></i> NUEVO
                </span>
                @endif
                @if($producto->cantidad == 0)
                    <a href="{{ url($producto->getUrl()) }}">
                        <span
                            class="w-100 bg-danger position-absolute top-50 text-center bg-opacity-75 text-white fs-4 fw-bold z-2">
                            AGOTADO
                        </span>
                    </a>
                @endif

                    <div class="position-absolute z-2 end-0 mt-2 me-2">
                        @livewire('includes.save-button', ['producto' => $producto])
                    </div>

                    <button
                        class="btn bg-white col-12 position-absolute bottom-0 start-0 p-2 mb-1 shadow z-2"
                        x-show="vistaPrevia"
                        x-transition.duration.300ms data-bs-toggle="modal"
                        data-bs-target="#{{ $producto->slug }}"
                    >
                        <i class="bi bi-search"></i> Vista previa
                    </button>
                    @include('producto.productoModal',
                        [
                            'id' => $producto->slug,
                            'titulo' => $producto->nombre,
                            'imagen' => asset('storage/'. $producto->imagenes[0]),
                            'imagenes' => $producto->imagenes,
                            'precio' => $producto->precio,
                            'descripcion' => $producto->descripcion_corta,
                            'stock' => $producto->cantidad
                        ])

            </div>

            <a href="{{ $producto->getUrl() }}">
                <img
                    src="{{ $producto->getPortada() }}"
                    class="card-img-top object-fit-contain z-0 position-relative {{ $producto->cantidad == 0 ? 'opacity-25' : '' }}"
                    alt="{{ $producto->nombre }}"
                    style="width: 100%;"
                    title="{{ $producto->nombre }}"
                />
            </a>

        </div>

        <div class="card-body bg-white rounded">
            <h5 class="card-title text-body-tertiary text-truncate text-center">{{ $producto->nombre }}</h5>
            <p class="card-text text-center"><strong>{{ number_format($producto->precio, 0, ',', '.') }}</strong></p>
        </div>
    </div>
</div>
