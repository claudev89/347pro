<div class="modal fade modal-xl" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div id="cerrar" class="text-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="row" x-data="{
                    imagenPrincipal: '',
                    videoUrl: '',
                    autoplay: 'true',
                    init() {
                        const file = '{{ $imagen }}';
                        const extension = file.split('.').pop().toLowerCase();

                        if (['mp4', 'mpeg4'].includes(extension)) {
                            this.videoUrl = file;
                            this.autoplay = false;
                        } else {
                            this.imagenPrincipal = file;
                        }
                    }
                }">
                    <div class="col-10 col-lg-5 mb-3 bg-white">
                        <template x-if="!videoUrl">
                            <img :src="imagenPrincipal" class="w-100 object-fit-contain" alt="{{ $titulo }}" style="height: 40rem">
                        </template>
                        <template x-if="videoUrl">
                            <video x-ref="video" x-bind:src="videoUrl" x-bind:autoplay="autoplay" controls class="w-100 object-fit-contain" style="height: 40rem" :src="videoUrl"></video>
                        </template>
                    </div>
                    <div class="col-2 col-lg-1">
                        @foreach($producto->imagenes as $imagenProducto)
                            @if(pathinfo(asset('storage/' . $imagenProducto), PATHINFO_EXTENSION) === 'mp4' ||
                                pathinfo(asset('storage/' . $imagenProducto), PATHINFO_EXTENSION) === 'mpeg4')

                                <div
                                    class="position-relative bg-white"
                                    @click="videoUrl = '{{ asset('storage/' . $imagenProducto) }}#t=0.1';
                                    imagenPrincipal = ''; $refs.video.pause();
                                    $refs.video.currentTime = 0;"
                                    :class="videoUrl == '{{ asset('storage/' . $imagenProducto) }}#t=0.1' ?
                                    'border border-4 border-primary' :
                                    ''"
                                >
                                    <video class="w-100 object-fit-contain" style="height: 4rem;">
                                        <source src="{{ asset('storage/' . $imagenProducto) }}#t=0.1" type="video/mp4">
                                    </video>
                                    <div class="position-absolute top-50 start-50 translate-middle">
                                        <i class="bi bi-play-circle-fill" style="font-size: 2rem; color: white;"></i>
                                    </div>
                                </div>

                                @else
                                <img
                                    src="{{ asset('storage/' . $imagenProducto) }}"
                                    class="mb-2 object-fit-contain bg-white"
                                    alt="{{ $titulo }}"
                                    style="height: 5rem; width: 100%; cursor: pointer"
                                    @click="imagenPrincipal = '{{ asset('storage/' . $imagenProducto) }}'; videoUrl = ''; if ($refs.video) { $refs.video.pause(); $refs.video.currentTime = 0; }"
                                    :class="imagenPrincipal == '{{ asset('storage/' . $imagenProducto) }}' ? 'border border-4 border-primary' : ''"
                                >
                            @endif
                        @endforeach
                    </div>
                    <div class="col-12 col-lg-6">
                        <h4 class="text-uppercase fw-bold">{{ $titulo }}</h4>
                        <span class="text-primary fw-bold">${{ number_format($precio, 0, ',', '.') }}</span>

                        <p>
                            {!! $descripcion !!}
                        </p>

                        <form>
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <div class="row g-3 align-items-center">
                                <div class="col-2 pe-0">
                                    <input type="number" id="cantidad" class="form-control" value="1" min="1">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary text-white fw-bold {{ $producto->cantidad == 0 ? 'disabled' : '' }}">
                                        <i class="bi bi-cart3" style="-webkit-text-stroke: 1px"></i> AÑADIR AL CARRITO
                                    </button>
                                </div>
                            </div>
                        </form>
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
                </div>

            </div>
            <hr>
            <div class="pb-3 px-3 fs-5 text-center">
                Compartir
                @include('includes.sharer')
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var videoModal = document.getElementById('<?= $id ?>');

            if (videoModal) {
                videoModal.addEventListener('hidden.bs.modal', function (event) {
                    var video = videoModal.querySelector('video');
                    if (video) {
                        video.pause();
                        video.currentTime = 0;
                    }
                });
            }
        });
    </script>



</div>
