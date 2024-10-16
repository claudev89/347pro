<div class="modal fade modal-xl" id="galeriaModal" tabindex="-1" aria-labelledby="galeriaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body position-relative">
                <button type="button" class="btn-close position-absolute end-0 me-2 pt-0" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                <div class="row">
                    <div class="bg-white">
                        <template x-if="!videoUrl">
                            <div class="ratio ratio-1x1 bg-white position-relative">
                                <img :src="imagenActual" alt="Imagen del producto" class="object-fit-contain w-100">
                            </div>
                        </template>
                        <template x-if="videoUrl">
                            <div class="ratio ratio-1x1 bg-white position-relative">
                                <video x-ref="video" autoplay controls class="w-100 object-fit-contain" :src="videoUrl"></video>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .modal-content {
            background-color: transparent !important;
            border: 0px !important
        }
    </style>
</div>
