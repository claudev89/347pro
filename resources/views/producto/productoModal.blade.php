<div class="modal fade modal-xl" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div id="cerrar" class="text-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="row">
                    <div class="col-5">
                        <img src="{{ $imagen }}" class="w-100" alt="{{ $titulo }}">
                    </div>
                    <div class="col-1">
                        <img src="{{ $imagen }}" class="img-fluid mb-2 border border-4 border-primary" alt="{{ $titulo }}">
                        <img src="{{ $imagen }}" class="img-fluid mb-2" alt="{{ $titulo }}">
                        <img src="{{ $imagen }}" class="img-fluid mb-2" alt="{{ $titulo }}">
                        <img src="{{ $imagen }}" class="img-fluid mb-2" alt="{{ $titulo }}">
                    </div>
                    <div class="col-6">
                        <h4 class="text-uppercase fw-bold">{{ $titulo }}</h4>
                        <span class="text-primary fw-bold">${{ number_format($precio, 0, ',', '.') }}</span>

                        <p class="fw-bold fs-5 mt-4">Nuestro gel de afeitar transparente elimina la incertidumbre del cuidado personal. Bienvenido al futuro.</p>
                        <ul>
                            <li>Observa fácilmente dónde te has afeitado con el gel claro no espumante.</li>
                            <li>Pasadas de navaja más suaves y precisas significan menos irritación y mejores resultados.</li>
                            <li>Lubrica e hidrata la piel, dejándola con una fragancia refrescante.</li>
                            <li>Crea una capa protectora entre la piel y la cuchilla para prevenir cortes y quemaduras de afeitar.</li>
                            <li>Más eficiente que la crema de afeitar, por lo que es una elección económica para el hogar y el salón.</li>
                        </ul>

                        <form>
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <div class="row g-3 align-items-center">
                                <div class="col-2 pe-0">
                                    <input type="number" id="cantidad" class="form-control" value="1">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary text-white fw-bold">
                                        <i class="bi bi-cart3" style="-webkit-text-stroke: 1px"></i> AÑADIR AL CARRITO
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <hr>
            <div class="pb-3 px-3 fs-5 text-center">
                Compartir
                <a href="#facebook" x-data="{ hover: false }" @mouseover="hover = true" @mouseout="hover = false" :class="{ 'text-primary': hover }" class="btn rounded-circle p-0 border-0" style="width: 40px; height: 40px;"><i class="bi bi-facebook fs-3"></i></a>
                <a href="#twitter" x-data="{ hover: false }" @mouseover="hover = true" @mouseout="hover = false" :class="{ 'text-primary': hover }" class="btn rounded-circle p-0 border-0" style="width: 40px; height: 40px;"><i class="bi bi-twitter-x fs-3"></i></a>
                <a href="#instagram" x-data="{ hover: false }" @mouseover="hover = true" @mouseout="hover = false" :class="{ 'text-primary': hover }" class="btn rounded-circle p-0 border-0" style="width: 40px; height: 40px;"><i class="bi bi-instagram fs-3"></i></a>
                <a href="#whatsapp" x-data="{ hover: false }" @mouseover="hover = true" @mouseout="hover = false" :class="{ 'text-primary': hover }" class="btn rounded-circle p-0 border-0" style="width: 40px; height: 40px;"><i class="bi bi-whatsapp fs-3"></i></a>
            </div>
        </div>
    </div>

</div>
