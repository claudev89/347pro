<?php

namespace App\Livewire;

use App\Models\Orden;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Carrito extends Component
{
    public function render()
    {
        if (auth()->check()) {
            $carrito = collect(auth()->user()->getCarrito());
        } else {
            $carrito = collect(session()->get('carrito', []))
                ->map(function ($item) {
                    return is_array($item) ? (object) $item : $item;
                });
        }


        $orden = null;

        $productos = null;

        if(auth()->check() && Orden::where('user_id', auth()->id())->where('estado', 'pe')->exists()) {
            $orden = Orden::where('user_id', auth()->id())->where('estado', 'pe')->orderBy('created_at', 'desc')->first();
        }

        return view('livewire.carrito', ['carrito' => $carrito, 'orden' => $orden]);
    }
}
