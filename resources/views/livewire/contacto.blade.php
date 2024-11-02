<div
    class="modal fade"
    id="contacto"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="contactoLabel"
    aria-hidden="true"
    wire:ignore.self
    wire:keydown.ctrl.enter="enviarCorreo()">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="contactoLabel"><i class="bi bi-envelope"></i> Contáctanos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control @error('nombre') is-invalid @enderror"
                        id="nombre"
                        placeholder="Nombre"
                        required minlength="3"
                        maxlength="50"
                        wire:model.live.debounce.300ms="nombre"
                        @if(auth()->user()) disabled @endif>
                    <label for="nombre">Nombre</label>
                    @error('nombre') <span class="alert alert-danger py-0">{{ $message }}</span> @enderror
                </div>

                <div class="form-floating mb-3">
                    <input
                        type="email"
                        class="form-control @error('correo') is-invalid @enderror"
                        id="email"
                        placeholder="hola@example.com"
                        required
                        maxlength="128"
                        wire:model.live.debounce.300ms="correo"
                        @if(auth()->user()) disabled @endif>
                    <label for="email">Dirección de correo electrónico</label>
                    @error('correo') <span class="alert alert-danger py-0">{{ $message }}</span> @enderror
                </div>

                <div class="form-floating mb-3" x-data="{largo: 0}">
                    <textarea
                        class="form-control @error('mensaje') is-invalid @enderror"
                        placeholder="Deje su mensaje aquí"
                        id="mensaje"
                        minlength="30"
                        maxlength="1000"
                        x-on:input="largo = $event.target.value.length"
                        style="field-sizing: content; min-height: 160px; max-height: 400px"
                        wire:model.live.debounce.300ms="mensaje"></textarea>
                    <label for="mensaje">Escriba su mensaje aquí...</label>
                    <div class="w-100 d-flex justify-content-between">
                        <span class="text-body-tertiary d-none d-md-inline">
                            Puedes enviar tu mensaje presionando <kbd>Ctrl</kbd> + <kbd>Enter</kbd>
                        </span>
                        <span class="text-body-tertiary ms-auto d-block d-md-inline" x-text="largo + '/1000'"></span>
                    </div>

                    @error('mensaje') <span class="alert alert-danger py-0">{{ $message }}</span> @enderror
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button
                    type="button"
                    class="btn btn-primary text-white" @if($errors->count() > 0) disabled @endif
                    wire:click="enviarCorreo" wire:target="enviarCorreo" wire:loading.class="disabled">
                    <span wire:loading.remove wire:target="enviarCorreo"><i class="bi bi-send"></i> Enviar mensaje</span>

                    <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading wire:target="enviarCorreo"></span>
                    <span role="status" wire:loading wire:target="enviarCorreo">Enviando mensaje...</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        const contactoModal = document.getElementById('contacto')
        const nombreInput = document.getElementById('nombre')

        contactoModal.addEventListener('shown.bs.modal', () => {
            nombreInput.focus()
        })
    </script>
</div>
