<div>
    @if(session('mensaje'))<div
        class="toast align-items-center {{ session('mensaje')['positivo'] ? 'bg-primary' : 'bg-danger' }} border-0 show position-fixed z-3 bottom-0 end-0 me-3 mb-3 text-white"
        role="alert" aria-live="assertive" aria-atomic="true"
    >
        <div class="d-flex">
            <div class="toast-body">
                {!! session('mensaje')['mensaje'] !!}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    @endif
</div>



