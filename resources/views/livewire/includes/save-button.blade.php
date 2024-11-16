<div class="col-auto" id="svdProducto-{{ $producto->id }}"
     x-data="{ estado: '' }"
     x-on:saved-creado.window="$event.detail.productoId === {{ $producto->id }} ? estado = 'sumado' : ''"
     x-on:saved-eliminado.window="$event.detail.productoId === {{ $producto->id }} ? estado = 'restado' : ''">
        <button
            wire:target="toggleSaved()" wire:loading.attr="disabled"
            @auth()
                wire:click.prevent="toggleSaved()"
            @else
                wire:click.prevent
                data-bs-toggle="modal" data-bs-target="#loginModal"
            @endauth
            class="btn btn-light bg-white rounded-circle p-2 shadow"
            style="width: 48px; height: 48px"
        >
            <i wire:target="toggleSaved()"
               :class="{
               'guardado': estado === 'sumado' && $wire.loading,
               'desguardado': estado === 'restado' && $wire.loading
           }"
               class="bi bi-heart{{ $saved ? '-fill text-danger' : '' }} fs-3"
               wire:loading.class="guardado"
               wire:loading.class.remove="desguardado">
            </i>
        </button>
</div>
