<?php

namespace App\Livewire;

use App\Models\Orden;
use App\Models\Producto;
use Livewire\Attributes\On;
use Livewire\Component;

class Carrito extends Component
{
    public function deleteItem($itemId)
    {
        if (session('carrito')) {
            $carrito = session()->get('carrito');

            $carrito = array_filter($carrito, function ($producto) use ($itemId) {
                return isset($producto->producto_id) && $producto->producto_id != $itemId;
            });
            $carrito = array_values($carrito);
            session()->put('carrito', $carrito);
        } elseif (auth()->check() && auth()->user()->getCarrito()) {
            $carrito = auth()->user()->getCarrito();
            $carrito2 = Orden::where('user_id', auth()->id())->where('estado', 'pe')->orderBy('created_at', 'desc')->first();
            $carrito2->productos()->detach($itemId);
        }
        $this->dispatch('cantidad-carrito-actualizada', carrito: $carrito);
    }

    public function actualizarCantidad($productoId, $nuevaCantidad)
    {
        $producto = Producto::findOrFail($productoId);
        if ($nuevaCantidad < 1) {
            $nuevaCantidad = 1;
        } elseif ($nuevaCantidad > $producto->cantidad) {
            $nuevaCantidad = $producto->cantidad;
        }

        if (session('carrito')) {
            $carrito = session()->get('carrito', []);
            foreach ($carrito as &$item) {
                if ($item->producto_id == $productoId) {
                    $item->cantidad = $nuevaCantidad;
                    break;
                }
            }

            session()->put('carrito', $carrito);
        } elseif (auth()->check() && auth()->user()->getCarrito()) {
            $carrito = auth()->user()->getCarrito();
            $carrito2 = Orden::where('user_id', auth()->id())->where('estado', 'pe')->orderBy('created_at', 'desc')->first();
            $carrito2->productos()->updateExistingPivot($productoId, [
                'cantidad' => $nuevaCantidad,
            ]);
        }
        $this->dispatch('cantidad-carrito-actualizada', carrito: $carrito);
    }

    public function finalizarCompra()
    {
        $carrito2 = Orden::where('user_id', auth()->id())->where('estado', 'pe')->orderBy('created_at', 'desc')->first();
        $carrito2->estado = 'pa';
        $carrito2->save();
    }


    #[On('cantidad-carrito-actualizada')]
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

        if(auth()->check() && Orden::where('user_id', auth()->id())->where('estado', 'pe')->exists()) {
            $orden = Orden::where('user_id', auth()->id())->where('estado', 'pe')->orderBy('created_at', 'desc')->first();
        }

        return view('livewire.carrito', ['carrito' => $carrito, 'orden' => $orden]);
    }
}
