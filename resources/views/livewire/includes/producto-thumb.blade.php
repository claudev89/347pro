<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mb-3 d-flex justify-content-center">
    <div class="card bg-white" style="width: 18rem;" x-data="{ vistaPrevia: false }" x-on:mouseover="vistaPrevia = true" x-on:mouseleave="vistaPrevia = false">
        <div class="position-relative">
            @if($producto->created_at->diffInDays(now()) <= 30)
                <span class="badge text-bg-primary position-absolute top-0 start-0 mt-2 ms-1 text-white pt-2 pb-1">
                    <i class="bi bi-stars"></i> NUEVO
                </span>
            @endif
            <button class="btn bg-white position-absolute top-0 end-0 pb-0 mt-2 me-2 rounded-circle shadow text-body-tertiary">
                <i class="bi bi-heart fs-3"></i>
            </button>
            <a href="{{ $producto->getUrl() }}">
                <img
                    src="{{ asset('storage/'.$producto->imagenes[0]) }}"
                    class="card-img-top object-fit-contain" alt="{{ $producto->nombre }}"
                    style="width: 100%; height: 17.9rem" title="{{ $producto->nombre }}"
                >
            </a>
            <button
                class="btn bg-white col-12 position-absolute bottom-0 start-0 p-2 mb-1 shadow"
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
        <div class="card-body bg-white rounded">
            <h5 class="card-title text-body-tertiary text-truncate text-center">{{ $producto->nombre }}</h5>
            <p class="card-text text-center"><strong>{{ number_format($producto->precio, 0, ',', '.') }}</strong></p>
        </div>
    </div>
</div>
