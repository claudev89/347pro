<?php

namespace App\Livewire\Includes;

use Livewire\Attributes\On;
use Livewire\Component;

class CountSaved extends Component
{
    public $producto;

    public function mount($producto)
    {
        $this->producto = $producto;
    }

    #[On('saved-cambiado')]
    public function render()
    {
        $vecesGuardado = $this->producto->usuariosGuardaron->count();
        return view('livewire.includes.count-saved', ['vecesGuardado' => $vecesGuardado]);
    }
}
