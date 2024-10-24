<?php

namespace App\Livewire\Includes;

use App\Models\Valoracion;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Valoraciones extends Component
{
    #[Validate('required|integer|min:1')]
    public $valoracionSeleccionada = 0;

    public $producto;
    public $comentario;

    public function valorar()
    {
        $this->validate();

        Valoracion::create([
            'puntuacion' => $this->valoracionSeleccionada,
            'comentario' => $this->comentario,
            'producto_id' => $this->producto->id,
            'user_id' => auth()->id(),
        ]);
        $this->valoracionSeleccionada = 0;
        $this->comentario = '';
        $this->dispatch('valoracion-publicada');
    }

    public function mount($producto)
    {
        $this->producto = $producto;
    }

    public function render()
    {
        return view('livewire.includes.valoraciones');
    }
}
