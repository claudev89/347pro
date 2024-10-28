<div class="input-group">
    <span class="input-group-text" id="search-icon"><i class="bi bi-search"></i></span>
    <input
        wire:model.live.debounce.300ms="buscar"
        type="search"
        class="form-control"
        placeholder="Buscar en el catálogo"
        aria-label="Buscar"
        aria-describedby="search-icon"
    >
    @forelse($productos as $producto)
        <div><img src="{{ $producto->getPortada() }}" style="width: 3rem"> - {{ $producto->nombre }}</div>
    @empty
        No hay na
    @endforelse
</div>
