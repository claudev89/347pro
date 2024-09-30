<div>
    <h4 class="text-center">NOVEDADES</h4>

    <div class="container">
        <div class="row">
            @for($i = 0; $i<4; $i++)
                <livewire:includes.producto-thumb
                    :props="[
                    'imagen' => 'https://347pro.cl/29-home_default/transparent-shaving-gel-aqua.jpg',
                    'titulo' => 'Shaving Gel Aqua',
                    'precio' => 15990,
                    ]"
                />
            @endfor

            <a class="text-end text-body-tertiary btn" href="#"><h5 class="me-3">Todas las novedades ></h5></a>
        </div>

    </div>
</div>
