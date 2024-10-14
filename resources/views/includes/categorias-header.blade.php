<div id="descripcionCategoria" class="bg-white px-3 pt-4 pb-2 mb-4">
        <h3 class="text-uppercase fw-bold">{{ $nomCat }}</h3>
        <div class="row">
            <div class="{{ $imgCat ? 'col-12 col-md-8' : 'col-12' }}">
                <p>
                    {!! $descCat  !!}
                </p>
            </div>
            @if($imgCat)
                <div class="col-12 col-md-4">
                    <img src="{{ asset('storage/' . $imgCat) }}"
                         alt="{{$nomCat}}"
                         class="img-fluid">
                </div>
            @endif
        </div>
</div>
