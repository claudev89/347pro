<div class="col-auto">
    @auth()
        <button
            wire:click.prevent="toggleSaved()"
            class="btn btn-light bg-white rounded-circle p-2 shadow"
            style="width: 48px; height: 48px"
        >
            <i class="bi bi-heart{{ $saved ? '-fill text-danger' : '' }} fs-3"></i>
        </button>
    @else
        <a
            href="{{ route('login') }}"
            class="btn btn-light bg-white rounded-circle p-2 shadow"
            style="width: 48px; height: 48px"
        >
            <i class="bi bi-heart{{ $saved ? '-fill text-danger' : '' }} fs-3"></i>
        </a>
    @endauth
</div>
