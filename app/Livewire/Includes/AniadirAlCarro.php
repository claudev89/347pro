<?php

namespace App\Livewire\Includes;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AniadirAlCarro extends Component
{
    public $producto;

    #[Validate()]
    public $cantidad = 1;

    public function mount(Producto $producto)
    {
        $this->producto = $producto;
    }

    protected function rules()
    {
        return [
            'cantidad' => 'numeric|min:1|max:' . $this->producto->cantidad,
        ];
    }

    protected function messages()
    {
        return [
            'cantidad.numeric' => 'Ingrese sólo números en la cantidad.',
            'cantidad.min' => 'La cantidad no puede ser 0.',
            'cantidad.max' => 'La cantidad excede el stock.'
        ];
    }

    public function aniadirAlCarro()
    {
        $this->validate();

        // Obtener el carrito actual, ya sea de la sesión o de la base de datos
        $carrito = $this->obtenerCarrito();

        $productoId = $this->producto->id;
        $cantidadSolicitada = $this->cantidad;
        $stockDisponible = $this->producto->cantidad;

        // Verificar si el producto ya está en el carrito
        $index = array_search($productoId, array_column($carrito, 'producto_id'));

        if ($index !== false) {
            // Producto ya está en el carrito, actualizamos la cantidad
            $carrito[$index]->cantidad += $cantidadSolicitada;

            // Validar que no exceda el stock
            if ($carrito[$index]->cantidad > $stockDisponible) {
                $this->addError('cantidad', 'La cantidad total excede el stock disponible.');
                return;
            }
        } else {
            // Producto no está en el carrito, lo añadimos
            $carrito[] = (object) ['producto_id' => $productoId, 'cantidad' => $cantidadSolicitada];
        }

        // Guardar el carrito actualizado en sesión o base de datos
        $this->guardarCarrito($carrito);

        // Disparar un evento para actualizar la vista del carrito
        $this->dispatch('carro-actualizado', productoID: $productoId, cantidad: $cantidadSolicitada);
    }

    private function obtenerCarrito()
    {
        if (auth()->check()) {
            // Si el usuario está autenticado, obtenemos el carrito de la base de datos
            return auth()->user()->getCarrito() ?? [];
        }

        // Si el usuario no está autenticado, usamos el carrito de la sesión
        return session('carrito', []);
    }

    private function guardarCarrito($carrito)
    {
        if (auth()->check()) {
            // Obtener la orden pendiente o crear una nueva
            $orden = DB::table('ordens')
                ->where('user_id', auth()->id())
                ->where('estado', 'pe')
                ->orderBy('created_at', 'desc')
                ->first();

            if (!$orden) {
                $ordenId = DB::table('ordens')->insertGetId([
                    'user_id' => auth()->id(),
                    'estado' => 'pe',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $ordenId = $orden->id;
            }

            // Actualizar productos en la tabla 'orden_productos'
            DB::table('orden_productos')->where('orden_id', $ordenId)->delete();
            foreach ($carrito as $item) {
                DB::table('orden_productos')->insert([
                    'orden_id' => $ordenId,
                    'producto_id' => $item->producto_id,
                    'cantidad' => $item->cantidad,
                ]);
            }

        } else {
            // Guardar el carrito en la sesión
            session(['carrito' => $carrito]);
        }
    }


    public function render()
    {
        return view('livewire.includes.aniadir-al-carro', ['producto' => $this->producto]);
    }
}
