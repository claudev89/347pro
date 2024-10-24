<span class="text-body-tertiary">
    @for($estrella = 1; $estrella <= 5; $estrella++)
        <i class="bi
        @if($valoraciones >= $estrella)
            bi-star-fill text-warning
        @elseif($valoraciones > $estrella - 1 && $valoraciones < $estrella)
            bi-star-half text-warning
        @else
            bi-star
        @endif"></i>
    @endfor
</span>
