<div id="descripcionCategoria" class="bg-white px-3 pt-4 pb-2 mb-4">
    <h3 class="text-uppercase fw-bold">{{ $categoria->nombre }}</h3>
    <div class="row">
        <div class="col-12">
            @if ($categoria->defaultImage())
                <img src="{{ asset('storage/' . $categoria->defaultImage()) }}"
                     alt="{{ $categoria->nombre }}"
                     class="img-fluid float-md-end ms-md-3 mb-3"
                     style="max-width: 30%; height: auto;">
            @endif
            <p>
                {!! $categoria->descripcion !!}
            </p>
        </div>
    </div>
</div>
