<div class="col-4">
    <form class="row g-3">
        <div class="col-auto">
            <label for="correo" class="visually-hidden">Correo</label>
            <input
                type="email"
                class="form-control bg-white"
                id="correo"
                placeholder="Su dirección de correo electrónico"
                required
                maxlength="128"
                wire:model.live.debounce.300ms="correo"
            >
            @error('correo') <span class="alert alert-danger py-0">{{ $message }}</span> @enderror
        </div>
        <div class="col-auto">
            <button
                class="btn btn-primary mb-3 text-white fw-bold px-3 {{ $errors->count() > 0 ? 'disabled' : '' }}"
                wire:click.prevent="solicitarSuscripcion" wire:target="solicitarSuscripcion" wire:loading.attr="disabled">
                <span wire:target="solicitarSuscripcion" wire:loading class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span wire:target="solicitarSuscripcion" wire:loading class="visually-hidden" role="status">Cargando...</span>
                SUSCRIBIRSE
            </button>
        </div>
    </form>
    <span class="small text-body-tertiary mt-0">
        Puede darse de baja en cualquier momento. Para ello, consulte nuestra información de contacto en aviso legal.
    </span>
</div>
