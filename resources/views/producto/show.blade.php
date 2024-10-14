<div>
    <img src="{{ asset('storage/' . $producto->imagenes[0]) }}" alt="{{ $producto->nombre }}" >
    {{ $producto->getUrl() }}
</div>
