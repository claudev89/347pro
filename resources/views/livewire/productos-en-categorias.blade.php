<div class="container">
    <div class="row mb-3">
        <div class="col-6">
            Hay {{ $categoria->obtenerProductos()->count() }} {{ $categoria->obtenerProductos()->count() === 1 ? 'producto.' : 'productos.' }}
        </div>
        <div class="col-6 d-flex justify-content-end">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="ordenar" class="col-form-label">Ordenar por: </label>
                </div>
                <div class="col-auto">
                    <select class="form-select bg-white" id="ordenar" wire:model.change="ordenSeleccionado">
                        <option value="created_at?desc">Más vendidos</option>
                        <option value="visitas?desc">Relevancia</option>
                        <option value="nombre?asc">Nombre, A a Z</option>
                        <option value="nombre?desc">Nombre, Z a A</option>
                        <option value="precio?asc">Precio: de más bajo a más alto</option>
                        <option value="precio?desc">Precio: de más alto a más bajo</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row" id="productos">
            @forelse($productos as $producto)
                @livewire('includes.producto-thumb',  ['productoId' => $producto->id], key($producto->id))
            @empty
                Todavía no hay productos en esta categoría.
            @endforelse
        </div>

    </div>

    {{ $productos->links(data: ['scrollTo' => '#productos']) }}

</div>
