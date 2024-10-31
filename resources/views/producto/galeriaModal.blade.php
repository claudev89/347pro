{{-- Modal de imágenes del producto --}}
<div
    class="modal fade modal-xl"
    id="galeriaModal"
    tabindex="-1"
    aria-labelledby="galeriaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-body position-relative">
                <div class="bg-white p-4 rounded">
                    <button data-bs-dismiss="modal" class="btn-close end-0 me-4 top-0 mt-4 position-absolute"></button>

                    <div id="carouselExampleIndicators" class="carousel slide">
                        <div class="carousel-indicators">
                            @foreach($producto->imagenes as $img)
                                <div class="bg-dark bg-opacity-25">
                                    <button
                                        type="button"
                                        data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="{{$loop->index}}"
                                        class="{{ $loop->first ? 'active' : '' }}"
                                        aria-current="{{ $loop->first ? true : false }}"
                                        aria-label="Slide 1">
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <div class="carousel-inner" style="height: 90vh;">

                            @foreach($producto->imagenes as $imagen)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
                                        @php
                                            $nombres = explode('.', $imagen);
                                            $extension = '';

                                            isset($nombres[1]) ? $extension = $nombres[1] : $extension = '';
                                        @endphp
                                        @if($extension == 'mp4' || $extension == 'mpeg4')
                                            <video
                                                src="{{ asset('storage/' . $imagen) }}"
                                                controls loop
                                                class="d-block"
                                                style="max-width: 100%; max-height: 100%; object-fit: contain;"
                                                alt="...">
                                                Tu navegador no admite el elemento <code>video</code>.
                                            </video>
                                        @else
                                            <img src="{{ asset('storage/' . $imagen) }}" class="d-block" style="max-width: 100%; max-height: 100%; object-fit: contain;" alt="...">
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <button
                            class="carousel-control-prev"
                            type="button"
                            data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="text-dark"><i class="bi bi-caret-left-fill fs-1"></i></span>

                        </button>
                        <button
                            class="carousel-control-next"
                            type="button"
                            data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="text-dark"><i class="bi bi-caret-right-fill fs-1"></i></span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var galeriaModal = document.getElementById('galeriaModal');

            galeriaModal.addEventListener('hide.bs.modal', function () {
                // Selecciona todos los videos dentro del modal y los pausa al cerrarlo
                var videos = galeriaModal.querySelectorAll('video');
                videos.forEach(function(video) {
                    video.pause();
                    video.currentTime = 0; // Opcional: reinicia el video al principio
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var carousel = document.getElementById('carouselExampleIndicators');

            carousel.addEventListener('slid.bs.carousel', function () {
                // Pausa todos los videos en el carrusel cuando cambie de slide
                var videos = carousel.querySelectorAll('video');
                videos.forEach(function(video) {
                    video.pause();
                });

                // Reproduce el video en el slide activo si existe
                var activeSlide = carousel.querySelector('.carousel-item.active video');
                if (activeSlide) {
                    activeSlide.play();
                }
            });
        });

    </script>
</div>
