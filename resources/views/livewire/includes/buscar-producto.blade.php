<div>
    <div id="input-chico" class="input-group" data-bs-toggle="modal" data-bs-target="#searchModal" style="cursor: pointer">
        <span class="input-group-text" id="search-icon"><i class="bi bi-search"></i></span>
        <input
            style="cursor: pointer"
            type="search"
            class="form-control"
            placeholder="Buscar en el catálogo"
            aria-label="Buscar"
            aria-describedby="search-icon"
        >
    </div>

    <div
        wire:ignore.self
        class="modal fade"
        id="searchModal"
        tabindex="-1"
        aria-labelledby="searchModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text" id="search-icon"><i class="bi bi-search"></i></span>
                        <input
                            wire:model.live.debounce.300ms="buscar"
                            id="input-search"
                            type="search"
                            class="form-control"
                            aria-label="Buscar producto"
                            placeholder="Buscar productos"
                            aria-describedby="search-icon">
                    </div>

                    <div class="list-group">
                        @if(strlen($buscar) < 3 && $historial->count()>0)
                            <span class="fw-bold">Búsquedas recientes:</span>
                            @foreach($historial as $busqueda)
                                @php($productoBuscado = \App\Models\Producto::findOrFail($busqueda->producto_id))
                                <div class="position-relative">
                                    <button
                                        type="button"
                                        class="list-group-item list-group-item-action p-1 d-flex align-items-center w-100"
                                        wire:click="registrarBusqueda({{ $productoBuscado->id }})">
                                        <span class="d-flex align-items-center w-100">
                                            <i class="bi bi-clock-history fw-bold mx-1 fs-4 pe-1 text-body-tertiary"></i>
                                            <img
                                                src="{{ $productoBuscado->getPortada() }}"
                                                alt="{{ $productoBuscado->nombre }}"
                                                 class="ratio ratio-1x1 object-fit-contain" style="width: 3rem">
                                            <span class="text-truncate mx-1 pe-4" style="max-width: calc(100% - 6rem); overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                                {{ $productoBuscado->nombre }}
                                            </span>
                                        </span>
                                    </button>

                                    <button class="btn position-absolute top-50 end-0 translate-middle-y me-2"
                                            style="z-index: 10;"
                                            wire:click="borrarDelHistorial({{ $productoBuscado->id }})">
                                        <i class="bi bi-x fw-bold fs-4 text-body-tertiary"></i>
                                    </button>
                                </div>
                            @endforeach

                        @endif
                        @foreach( $productos as $producto)
                            <button
                                type="button"
                                class="list-group-item list-group-item-action p-1 d-flex align-items-center"
                                wire:click="registrarBusqueda({{ $producto->id }})">
                                <img
                                    src="{{ $producto->getPortada() }}" alt="{{ $producto->nombre }}"
                                    class="ratio ratio-1x1 object-fit-contain" style="width: 3rem">
                                <span class="text-truncate w-100 mx-1">{{ $producto->nombre }}</span>
                            </button>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        /* Este CSS aplica el efecto hover usando las variables de Bootstrap */
        #input-chico .form-control:hover {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.3rem rgba(var(--bs-primary-rgb), 0.25);
        }

        .list-group-item:hover {
            background-color: var(--bs-secondary-bg); /* Cambia a tu color preferido */
        }
    </style>

    <script>
        const mySearchModal = document.getElementById('searchModal')
        const mySearchInput = document.getElementById('input-search')

        mySearchModal.addEventListener('shown.bs.modal', () => {
            mySearchInput.focus()
        })

    </script>

</div>
