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

    <div wire:ignore.self class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text" id="search-icon"><i class="bi bi-search"></i></span>
                        <input wire:model.live.debounce.300ms="buscar" id="input-search" type="search" class="form-control" aria-label="Buscar producto" placeholder="Buscar productos" aria-describedby="search-icon" autofocus>
                    </div>

                    <div class="list-group">
                        @foreach( $productos as $producto)
                            <a href="{{ $producto->getUrl() }}" type="button" class="list-group-item list-group-item-action p-1 d-flex align-items-center">
                                <img src="{{ $producto->getPortada() }}" alt="{{ $producto->nombre }}" class="ratio ratio-1x1 object-fit-contain" style="width: 3rem">
                                <span class="text-truncate w-100 mx-1">{{ $producto->nombre }}</span>
                            </a>
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
