<section class="container">
    @php($valorTotal = 0)
    <div class="row">
        <div class="col-12 col-md-7 bg-white me-4 p-4 rounded mb-4">
            <h4>CARRITO</h4>
            <hr class="mt-0">
            <div class="row align-items-center">
                @if(auth()->check() && $orden)
                    @foreach($carrito as $prod)
                        @php($producto = \App\Models\Producto::find($prod->producto_id))
                        @php($valorTotal += $producto->precio * $prod->cantidad)
                        <div class="col-2"><img src="{{ $producto->getPortada() }}" class="w-100" alt="{{ $producto->nombre }}"></div>
                        <div class="col-4">
                            <a class="text-reset fw-bold" href="{{ $producto->getUrl() }}" style="text-decoration: none">
                                {{ $producto->nombre }}
                            </a> <br>
                            <span class="fw-bold text-primary">{{ number_format($producto->precio, 0, ',', '.') }}</span>
                        </div>
                        <div class="col-2 d-flex align-items-center" x-data="{cantidad: {{ $prod->cantidad }}}">
                            <div class="input-group" style="width: 4rem">
                                <input
                                    class="form-control"
                                    type="text" aria-label="cantidad"
                                    x-model="cantidad"
                                    maxlength="3">
                                <div class="col-1 me-0 pe-0">
                                    <button
                                        class="btn btn-primary px-1 py-0 border text-white fw-bold"
                                        :class="cantidad === {{ $producto->cantidad }} ? 'disabled' : ''"
                                        style="width: 24px"
                                        x-on:click.prevent="cantidad < {{ $producto->cantidad }} ? cantidad++ : cantidad = {{ $producto->cantidad }}">
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
                            </div>
                        </div>
                        <div class="col-3 d-flex align-items-center justify-content-end ms-4">
                            <span class="text-end fw-bold">${{ number_format($producto->precio * $prod->cantidad, 0, ',', '.') }}</span>
                            <button class="btn"><i class="bi bi-trash-fill fs-5"></i></button>
                        </div>
                        @if(!$loop->last)<div><hr class="text-body-tertiary mt-3"></div>  @endif
                    @endforeach

                @else
                    @if($carrito)
                        @foreach($carrito as $carritoItem)
                            @php($producto = \App\Models\Producto::find($carritoItem->producto_id))
                            @php($valorTotal += $producto->precio * $carritoItem->cantidad)
                            <div class="col-2"><img src="{{ $producto->getPortada() }}" class="w-100" alt="{{ $producto->nombre }}"></div>
                            <div class="col-4">
                                <a class="text-reset fw-bold" href="{{ $producto->getUrl() }}" style="text-decoration: none">
                                    {{ $producto->nombre }}
                                </a> <br>
                                <span class="fw-bold text-primary">{{ number_format($producto->precio, 0, ',', '.') }}</span>
                            </div>
                            <div class="col-2 d-flex align-items-center" x-data="{cantidad: {{ $carritoItem->cantidad }}}">
                                <div class="input-group" style="width: 4rem">
                                    <input
                                        class="form-control"
                                        type="text" aria-label="cantidad"
                                        x-model="cantidad"
                                        maxlength="3">
                                    <div class="col-1 me-0 pe-0">
                                        <button
                                            class="btn btn-primary px-1 py-0 border text-white fw-bold"
                                            :class="cantidad === {{ $producto->cantidad }} ? 'disabled' : ''"
                                            style="width: 24px"
                                            x-on:click.prevent="cantidad < {{ $producto->cantidad }} ? cantidad++ : cantidad = {{ $producto->cantidad }}">
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
                                </div>
                            </div>
                            <div class="col-3 d-flex align-items-center justify-content-end ms-4">
                                <span class="text-end fw-bold">${{ number_format($producto->precio * $carritoItem->cantidad, 0, ',', '.') }}</span>
                                <button class="btn"><i class="bi bi-trash-fill fs-5"></i></button>
                            </div>
                            @if(!$loop->last)<div><hr class="text-body-tertiary mt-3"></div>  @endif
                        @endforeach
                    @else
                        <span class="px-2">Aún no hay productos en su carrito de compras.</span>
                    @endif
                @endif

            </div>
            <div class="mt-4">
                <a class="text-reset" href="/" style="text-decoration: none">
                    <strong><</strong> Continuar comprando
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 bg-white p-4 rounded mb-4" style="max-height: 16rem">
            @if($carrito->sum('cantidad') > 0)
                <div class="d-flex justify-content-between flex-wrap">
                    <div>
                        <div>{{ $carrito->sum('cantidad') }} artículos</div>
                        <div class="mt-4">Transporte</div>
                    </div>
                    <div class="fw-bold text-end">
                        <div>${{ number_format($valorTotal, 0, ',', '.') }}</div>
                        <div class="mt-4">Gratis</div>
                    </div>
                    <div class="w-100 mt-2 text-center">
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <div>TOTAL</div>
                            <div>${{ number_format($valorTotal, 0, ',', '.') }}</div>
                        </div>
                        <button class="btn btn-primary text-white fw-bold mt-4 w-100">FINALIZAR COMPRA</button>
                    </div>
                </div>
            @endif
        </div>

    </div>
</section>
