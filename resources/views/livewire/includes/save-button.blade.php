<div class="col-auto">
        <button
            wire:target="toggleSaved()" wire:loading.attr="disabled"
            @auth()
                wire:click.prevent="toggleSaved()"
            @else
                wire:click.prevent
                data-bs-toggle="modal" data-bs-target="#loginModal"
            @endauth
            class="btn btn-light bg-white rounded-circle p-2 shadow"
            style="width: 48px; height: 48px"
        >
            <i wire:target="toggleSaved()" wire:loading.remove class="bi bi-heart{{ $saved ? '-fill text-danger' : '' }} fs-3"></i>
            <span wire:target="toggleSaved()" wire:loading class="spinner-border text-primary" aria-hidden="true"></span>
        </button>
</div>
