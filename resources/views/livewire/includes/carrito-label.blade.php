<div>
    <li class="nav-item ms-2 my-auto">
        <a class="nav-link text-dark" href="#">
            <i class="bi bi-cart3" style="-webkit-text-stroke: 1px"></i><strong> Carrito (0)</strong>
        </a>
    </li>

    <div x-data="{ pageLoaded: false }"
         x-init="pageLoaded = true"
         @carro-actualizado.window="if (pageLoaded) document.getElementById('abrirCarritoModal').click()">
    </div>

    <!-- Button trigger modal -->
    <button type="button" id="abrirCarritoModal" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#carritoModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="carritoModal" tabindex="-1" aria-labelledby="carritoModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-white">
                    <h1 class="modal-title fs-5" id="carritoModalLabel">
                        <i class="bi bi-check text-success fs-3"></i> Producto añadido correctamente al carrito de compras
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body bg-white">

                    <div class="row p-4">
                        <div id="infoProducto" class="col-12 col-md-5 d-flex align-items-center border-end">
                            <div id="imagen" class="me-3">
                                <img class="w-100" src="{{ $producto?->getPortada() }}" alt="{{ $producto?->nombre }}">
                            </div>
                            <div id="info">
                                <h5 class="text-primary fw-bold">{{ $producto?->nombre }}</h5>
                                $ {{ number_format($producto?->precio, 0, ',', '.') }}
                                <p>Cantidad: <strong>{{ $cantidad }}</strong></p>
                            </div>
                        </div>
                        <div id="precio" class="col-12 col-md-7 px-3">
                            <span class="fs-5 text-body-tertiary fw-bold mb-4"> Hay {{ $cantidad }} artículos en su carrito.</span>

                            <table class="table mt-3 w-100">
                                <tr>
                                    <td class="bg-white"><strong>Subtotal</strong></td>
                                    <td class="bg-white"><strong>${{ number_format($producto?->precio * $cantidad, 0, ',', '.') }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="bg-white">Envío</td>
                                    <td class="bg-white">Gratis</td>
                                </tr>
                                <tr class="fw-bold">
                                    <td>TOTAL</td>
                                    <td>${{ number_format($producto?->precio * $cantidad, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Continuar comprando</button>
                    <button type="button" class="btn btn-primary text-white fw-bold">
                        <i class="bi bi-check"></i> Finalizar compra
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>
