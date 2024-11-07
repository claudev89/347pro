<div class="row g-3 align-items-center" x-data="{cantidad: 1, tope: @json($producto->cantidad)}" x-init="$watch('cantidad', value => $wire.set('cantidad', value))">
    <form @submit.prevent>
        <label for="cantidad-{{ $producto->id }}" class="form-label">Cantidad</label>
        <div
            class="d-flex"
            x-on:keydown.up="cantidad < tope ? cantidad++ : cantidad = tope"
            x-on:keydown.down="cantidad > 1 ? cantidad-- : cantidad = 1">
            <input
                class="form-control form-control-lg"
                type="text" aria-label="cantidad" style="width: 4rem"
                maxlength="3"
                x-model="cantidad"
                wire:model.live="cantidad">
            <div class="col-1 me-0 pe-0">
                <button
                    class="btn btn-primary px-1 py-0 border text-white fw-bold"
                    :class="cantidad === tope ? 'disabled' : ''"
                    style="width: 24px"
                    x-on:click.prevent="cantidad < tope ? cantidad++ : cantidad = tope">
                    +
                </button>
                <button
                    class="btn btn-primary px-1 py-0 border text-white fw-bold"
                    :class="cantidad === 1 ? 'disabled' : ''"
                    style="width: 24px"
                    x-on:click.prevent="cantidad > 1 ? cantidad-- : cantidad = 1">
                    -
                </button>
            </div>
            <button
                class="btn btn-primary text-white fw-bold ms-0 {{ $producto->cantidad == 0 || $errors->count() > 0 ? 'disabled' : '' }}"
                wire:target="aniadirAlCarro"
                wire:loading.attr="disabled"
                wire:click="aniadirAlCarro">
                <i class="bi bi-cart3"></i> AÑADIR AL CARRITO
            </button>
        </div>
        @error('cantidad') <span class="alert alert-danger py-0">{{ $message }}</span> @enderror
    </form>
</div>
