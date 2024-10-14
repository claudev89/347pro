<?php

namespace App\Livewire\Includes;

use App\Models\Producto;
use Livewire\Component;

class ProductoThumb extends Component
{
    public $producto;
    public $productoId;

    public function render()
    {
        $this->producto = Producto::find($this->productoId);
        return view('livewire.includes.producto-thumb', ['producto' => $this->producto]);
    }
}
