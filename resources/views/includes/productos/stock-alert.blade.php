<div>
    @if($stock > 0 && $stock <= 3)
        <span class="alert alert-warning d-inline-block mt-3">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                Últimas unidades en stock.
                            </span>
    @elseif($stock == 0)
        <span class="alert alert-danger d-inline-block mt-3">
                                <i class="bi bi-x-circle-fill"></i>
                                Producto temporalmente no disponible.
                            </span>
    @endif
</div>
