<?php

namespace App\Livewire;

use Livewire\Component;

class Perfil extends Component
{

    public function render()
    {
        $usuario = auth()->check() ? auth()->user() : null;

        return view('livewire.perfil', ['usuario' => $usuario]);
    }
}
