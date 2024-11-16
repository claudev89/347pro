<?php

namespace App\Livewire\Includes;

use App\Models\Producto;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class CarritoLabel extends Component
{
    public $producto;
    public $cantidad = 1;

    #[On('carro-actualizado')]
    public function getProduct($productoID, $cantidad)
    {
        $this->producto = Producto::find($productoID);
        $this->cantidad = $cantidad;
    }

    public function render()
    {
        if(auth()->check() && auth()->user()->getCarrito()) {
            // Convertimos el array de la base de datos a una colección
            $carrito = collect(auth()->user()->getCarrito());
        } elseif (session('carrito')) {
            // Convertimos el carrito de la sesión en una colección de objetos
            $carrito = collect(session()->get('carrito', []))
                ->map(function ($item) {
                    return is_array($item) ? (object) $item : $item;
                });
        } else {
            $carrito = collect();  // Usamos una colección vacía en lugar de null para simplificar
        }

        $totalProductos = $carrito->sum('cantidad');

        return view('livewire.includes.carrito-label', [
            'totalProductos' => $totalProductos,
            'carrito' => $carrito
        ]);
    }

}
