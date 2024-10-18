<div class="d-inline-block">
    @php
        $compartir = [
            'facebook' => [
                'icono' => 'facebook',
                'url' => 'https://www.facebook.com/sharer.php?u=',
                ],
            'twitter' => [
                 'icono' => 'twitter-x',
                'url' => 'https://twitter.com/intent/tweet?text=',
                ],
            'whatsapp' => [
             'icono' => 'whatsapp',
            'url' => 'https://wa.me/?text=',
            ],
        ];
    @endphp

    @foreach($compartir as $red)
        <a
            href="{{ $red['url'] . $producto->getUrl() }}"
            target="_blank"
            x-data="{ hover: false }"
            @mouseover="hover = true"
            @mouseout="hover = false"
            :class="{ 'text-primary': hover }"
            class="btn rounded-circle p-0 border-0"
            style="width: 40px; height: 40px;">
            <i class="bi bi-{{ $red['icono'] }} fs-3"></i>
        </a>
    @endforeach
</div>
