<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mb-3">
    <div class="card" style="width: 18rem;" x-data="{ vistaPrevia: false }" x-on:mouseover="vistaPrevia = true" x-on:mouseleave="vistaPrevia = false">
        <div class="position-relative">
                            <span class="badge text-bg-primary position-absolute top-0 start-0 pb-0 mt-2 ms-1 text-white pt-2 pb-1">
                                <i class="bi bi-stars"></i> NUEVO
                            </span>
            <button class="btn bg-white position-absolute top-0 end-0 pb-0 mt-2 me-2 rounded-circle shadow text-body-tertiary">
                <i class="bi bi-heart fs-3"></i>
            </button>
            <a href="#paginaDelProducto">
                <img src="{{ $props['imagen'] }}" class="card-img-top object-fit-cover" alt="{{ $props['titulo'] }}">
            </a>
            <button class="btn bg-white col-12 position-absolute bottom-0 start-0 p-2 mb-1 shadow" x-show="vistaPrevia" x-transition.duration.300ms data-bs-toggle="modal" data-bs-target="#{{'shavingGel'}}">
                <i class="bi bi-search"></i> Vista previa
            </button>
            @include('producto.productoModal',
                [
                    'id' => 'shavingGel',
                    'titulo' => 'Transparent Shaving Gel',
                    'imagen' => 'https://347pro.cl/29-home_default/transparent-shaving-gel-aqua.jpg',
                    'precio' => 15990,
                ])

        </div>
        <div class="card-body bg-white rounded">
            <h5 class="card-title text-body-tertiary text-truncate text-center">{{ $props['titulo'] }}</h5>
            <p class="card-text text-center"><strong>{{ number_format($props['precio'], 0, ',', '.') }}</strong></p>
        </div>
    </div>
</div>
