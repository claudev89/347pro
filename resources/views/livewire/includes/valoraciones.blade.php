<div>
    <div id="headerResenias">
        <h4 class="mb-3 d-inline-block"><i class="bi bi-chat-left-text-fill"></i> Reseñas ({{ $producto->valoraciones->count() }})</h4>
        @php($valoraciones = round($producto->valoraciones->avg('puntuacion') * 2) / 2)
        {{ $valoraciones }}
        @include('includes.valoraciones', ['valoraciones' => $valoraciones])
    </div>

    <div
        x-data="{ valoracionSeleccionada: $wire.entangle('valoracionSeleccionada'), limit: $refs.mensaje.maxLength, comentario: '' }"
        x-init="$wire.on('valoracion-publicada', () => { valoracionSeleccionada = 0; comentario = '';})"
        class="bg-white p-4 rounded">
        @auth
            <h5>Puedes dejar una valoración sobre el producto acá:</h5>
            <div class="row mb-3 position-relative">
                <div class="col-2 col-md-1 me-2">
                    <img src="{{ auth()->user()->profile_photo_url }}" class="rounded-circle" alt="{{ auth()->user()->name }}" style="width: 4rem">
                </div>
                <div class="col-9 col-md-10 position-relative">
                    <form wire:submit.prevent="" wire:keydown.ctrl.enter="valorar()">
                        @for($i = 1; $i <= 5; $i++)
                            <input type="radio"
                                   class="btn-check" name="valoracion"
                                   id="valoracion{{ $i }}"
                                   value="{{ $i }}"
                                   @click="valoracionSeleccionada = {{ $i }}; $wire.set('valoracionSeleccionada', valoracionSeleccionada)"
                            >
                            <label class="btn px-0 border-0" for="valoracion{{ $i }}">
                                <i :class="{
                    'bi-star-fill text-warning': valoracionSeleccionada >= {{ $i }},
                    'bi-star': valoracionSeleccionada < {{ $i }}
                }"></i>
                            </label>
                        @endfor
                        <span x-text="comentario.length + '/' + limit" class="end-0 position-absolute"></span>
                            @error('valoracionSeleccionada')
                                <span class="alert alert-danger py-0">
                                    <i class="bi bi-exclamation-octagon"></i>
                                    La valoración no puede estar en blanco.
                                </span>
                            @enderror

                        <div class="form-floating mb-2">
                        <textarea
                            wire:model="comentario"
                            class="form-control"
                            placeholder="Deja tu comentario aquí"
                            id="comentario"
                            x-ref="mensaje"
                            x-model="comentario"
                            maxlength="255"
                            style="height: 100px">
                        </textarea>
                            <label for="comentario">Comentario</label>
                        </div>

                        <span class="d-none d-md-block text-body-tertiary">
                            También puedes publicar tu valoración pulsando
                            <kbd class="bg-white text-dark fw-bold border border-dark">Ctrl</kbd> +
                            <kbd class="bg-white text-dark fw-bold border border-dark">Enter</kbd>.
                        </span>

                        <button
                            wire:click="valorar()"
                            wire:target="valorar()"
                            wire:loading.remove
                            class="btn btn-primary text-white end-0 position-absolute me-2 {{ $valoracionSeleccionada == 0 ? 'disabled' : '' }}">
                            <i class="bi bi-send"></i> Publicar
                        </button>

                            <button
                                wire:loading
                                wire:target="valorar()"
                                class="btn btn-primary text-white end-0 position-absolute me-2 disabled">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Publicando...</span>
                                </div>
                                Publicando...

                            </button>

                    </form>
                </div>

            </div>

        @else
            <a href="{{route('login')}}" style="text-decoration: none">Inicia sesión</a> para poder dejar una valoración.
        @endauth

        <section id="valoraciones" class="position-relative mt-4 pt-4">
            @forelse($producto->valoraciones->sortByDesc('created_at') as $valoracion)
                <div class="row mb-2">
                    <div class="col-2 col-md-1 text-end me-0 pe-0 align-top">
                        <a href="#">
                            <img
                                src="{{ $valoracion->user->profile_photo_url }}"
                                alt="{{$valoracion->user->nombre}}"
                                class="rounded-circle w-100"
                                style="max-width: 3rem"
                            >
                        </a>
                    </div>
                    <div class="col-10 col-md-11">
                        <span class="text-small text-body-tertiary">
                            <a href="#" style="text-decoration: none">{{ $valoracion->user->name }}</a>
                            hace {{ $valoracion->created_at->longAbsoluteDiffForHumans(now()) }}
                        </span>
                        <br>
                        @include('includes.valoraciones', ['valoraciones' => $valoracion->puntuacion])
                        <div>
                            {{ $valoracion?->comentario }}
                        </div>

                    </div>
                </div>
            @empty
                <div class="text-center">
                    Este producto aún no tiene valoraciones. ¡Sé el primero en dejar una!.
                </div>
            @endforelse
        </section>
    </div>

</div>
