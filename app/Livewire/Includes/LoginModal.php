<?php

namespace App\Livewire\Includes;

use App\Models\Orden;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LoginModal extends Component
{
    #[Validate('required|email')]
    public $email;
    #[Validate('required')]
    public $contrasenia;
    public $remember = false;
    #[Computed()]
    public $errorCredenciales = false;

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->contrasenia], $this->remember)) {
            session()->regenerate();

            $this->dispatch('logeado');
            request()->session()->flash('mensaje', [
                'positivo' => true,
                'mensaje' => 'Bienvenid@ de nuevo <strong>' . auth()->user()->name . '</strong> iniciaste sesión correctamente.'
            ]);
            $this->reset();

            if (session('carrito')) {
                // Obtener la orden pendiente o crear una nueva
                $orden = DB::table('ordens')
                    ->where('user_id', auth()->id())
                    ->where('estado', 'pe')
                    ->orderBy('created_at', 'desc')
                    ->first();

                if (!$orden) {
                    $orden = Orden::create([
                        'user_id' => auth()->id(),
                        'estado' => 'pe',
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }

                foreach (session()->get('carrito') as $item) {
                    $productoId = $item->producto_id;
                    $cantidadSesion = $item->cantidad;

                    // Verificar si el producto ya está en la orden
                    $productoEnOrden = DB::table('orden_productos')
                        ->where('orden_id', $orden->id)
                        ->where('producto_id', $productoId)
                        ->first();

                    if ($productoEnOrden) {
                        // Producto ya existe en la orden, actualizamos la cantidad
                        $cantidadTotal = $productoEnOrden->cantidad + $cantidadSesion;

                        // Verificar el stock máximo del producto
                        $stockDisponible = DB::table('productos')->where('id', $productoId)->value('cantidad');
                        $nuevaCantidad = min($cantidadTotal, $stockDisponible);

                        DB::table('orden_productos')
                            ->where('orden_id', $orden->id)
                            ->where('producto_id', $productoId)
                            ->update([
                                'cantidad' => $nuevaCantidad,
                                'updated_at' => now()
                            ]);
                    } else {
                        // Producto no existe en la orden, insertar un nuevo registro
                        DB::table('orden_productos')->insert([
                            'producto_id' => $productoId,
                            'cantidad' => min($cantidadSesion, DB::table('productos')->where('id', $productoId)->value('cantidad')),
                            'orden_id' => $orden->id,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                }

                // Limpiar el carrito de la sesión
                session()->forget('carrito');
            }

            return redirect(request()->header('Referer'));
        } else {
            $this->errorCredenciales = true;
            return;
        }
    }


    public function updated()
    {
        $this->errorCredenciales = false;
    }

    public function render()
    {
        return view('livewire.includes.login-modal');
    }
}
