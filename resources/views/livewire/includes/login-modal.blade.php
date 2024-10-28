<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="loginModalLabel"><i class="bi bi-person-check"></i> Iniciar sesión</h1>
                <button id="btnCerrar" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" wire:keydown.enter="login()" x-data="{visibleTooltip: false}">
                <div class="justify-content-center align-content-center d-flex mb-3">
                    <img class="img-fluid" src="{{ asset('logo.png') }}">
                </div>
                <span class="text-body-tertiary">Ingresa tu dirección de correo electrónico y contraseña para iniciar sesión:</span>

                <div class="input-group mb-3 mt-3">
                    <span class="input-group-text" id="correo"><i class="bi bi-envelope"></i></span>
                    <input wire:model.live.debounce.300ms="email" type="text" class="form-control" placeholder="Correo electrónico" aria-label="correo" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3" x-data="{ pwdType: true }">
                    <span class="input-group-text"><i class="bi bi-key"></i></span>
                    <input wire:model.live="contrasenia" :type="pwdType ? 'password' : 'text'" class="form-control" aria-label="pwd" placeholder="Contraseña">
                    <span class="input-group-text">
                        <span
                            class="bg-dark text-white px-2 py-1 rounded position-absolute end-0 me-1 mb-5 z-3"
                            x-show="visibleTooltip"
                            x-transition.opacity
                            x-transition.delay.70ms
                            x-text="pwdType ? 'Mostrar contraseña' : 'Ocultar contraseña'">
                        </span>
                        <button class="btn p-0" x-on:click="pwdType = !pwdType">
                            <i :class="pwdType ? 'bi bi-eye' : 'bi bi-eye-slash'" @mouseover="visibleTooltip = true" @mouseout="visibleTooltip = false"></i>
                        </button>
                    </span>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="form-check d-inline-block">
                        <input wire:model.change="remember" class="form-check-input" type="checkbox" value="" id="recordarme">
                        <label class="form-check-label" for="recordarme">
                            Recordarme
                        </label>
                    </div>
                    <div>
                        <a href="{{ route('password.request') }}" style="text-decoration: none">Olvidé mi contraseña</a>
                    </div>
                </div>


                @if($errors->count() > 0 || $this->errorCredenciales)
                    <div class="alert alert-danger d-block pb-0 mt-3">
                        <ul>
                            @error('email')<li>{{ $message }}</li>@enderror
                            @error('contrasenia')<li>{{ $message }}</li>@enderror
                            @if($this->errorCredenciales) <li>Las credenciales no coinciden.</li> @endif
                        </ul>
                    </div>
                @endif

            </div>
            <div class="modal-footer">
                <a href="{{ route('register') }}" class="btn btn-secondary">Registrarse</a>
                <button wire:target="login()" wire:loading.attr="disabled" wire:click="login()" type="button" class="btn btn-primary text-white {{ $errors->count() >0 || $errorCredenciales ? 'disabled' : '' }}">
                    <span wire:loading.remove wire:target="login()">Iniciar sesión</span>
                    <span wire:loading wire:target="login()"></span>
                    <span wire:loading wire:target="login()" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    <span wire:loading wire:target="login()" role="status">Iniciando sesión...</span>
                </button>

            </div>
        </div>
    </div>

    @script
    <script type="module">
        $wire.on('logeado', () => {
            document.getElementById('btnCerrar').click();
        });
    </script>
    @endscript

</div>
