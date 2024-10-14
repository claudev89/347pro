<div>
    <h4 class="text-center">PRODUCTOS DESTACADOS</h4>

    <div class="container mb-4">
        <div class="row">
            @foreach(\App\Models\Producto::all()->sortBy('visitas')->take(8) as $producto)
                @livewire('includes.producto-thumb', ['productoId' => $producto->id])
            @endforeach

            <a class="text-end text-body-tertiary btn" href="#"><h5 class="me-3">Todos los productos ></h5></a>
        </div>
    </div>
</div>
