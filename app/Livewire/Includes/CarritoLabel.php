<?php

namespace App\Livewire\Includes;

use App\Models\Producto;
use Livewire\Attributes\On;
use Livewire\Component;

class CarritoLabel extends Component
{
    public $producto;
    public $cantidad = 1;

    #[On('carro-actualizado')]
    public function getProduct($datos)
    {
        $this->producto = Producto::findOrFail($datos['productoID'])->first();
        $this->cantidad = $datos['cantidad'];
    }

    public function render()
    {
        return view('livewire.includes.carrito-label');
    }
}
