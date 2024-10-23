<div>
    <h4 class="text-center">NOVEDADES</h4>

    <div class="container">
        <div class="row">
            @foreach(\App\Models\Producto::all()->sortByDesc('created_at')->take(8) as $producto)
                @livewire('includes.producto-thumb', ['productoId' => $producto->id])
            @endforeach

            <a class="text-end text-body-tertiary btn" href="#"><h5 class="me-3">Todas las novedades ></h5></a>
        </div>

    </div>
</div>
