<?php

namespace App\Livewire\Includes;

use App\Models\Producto;
use Livewire\Component;

class BuscarProducto extends Component
{
    public $buscar;

    public function render()
    {
        return view('livewire.includes.buscar-producto',
            [
                'productos' => strlen($this->buscar) >= 3 ? Producto::search($this->buscar)->get() : []
            ]);
    }
}
