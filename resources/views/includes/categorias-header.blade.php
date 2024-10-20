<div id="descripcionCategoria" class="bg-white px-3 pt-4 pb-2 mb-4">
        <h3 class="text-uppercase fw-bold">{{ $categoria->nombre }}</h3>
        <div class="row">
            <div class="{{ $categoria->defaultImage() ? 'col-12 col-md-8' : 'col-12' }}">
                <p>
                    {!! $categoria->descripcion  !!}
                </p>
            </div>
                <div class="col-12 col-md-4">
                    <img src="{{ asset('storage/' . $categoria->defaultImage()) }}"
                         alt="{{$categoria->nombre}}"
                         class="img-fluid">
                </div>
        </div>
</div>
