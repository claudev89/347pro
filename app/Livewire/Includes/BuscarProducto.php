<?php

namespace App\Livewire\Includes;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class BuscarProducto extends Component
{
    public $buscar;

    public function registrarBusqueda($productoId)
    {
        if(auth()->user()) {
            $busquedasCount = DB::table('busquedas')->where('user_id', auth()->id())->count();

            if ($busquedasCount >= 10) {
                DB::table('busquedas')
                    ->where('user_id', auth()->id())
                    ->orderBy('created_at', 'asc')
                    ->limit(1)
                    ->delete();
            }

            DB::table('busquedas')->upsert(
                [
                    'user_id' => auth()->id(),
                    'producto_id' => $productoId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                ['user_id' => auth()->id(), 'producto_id' => $productoId],
                ['created_at', 'updated_at']
            );
        }

        return redirect(Producto::findOrFail($productoId)->getUrl());
    }

    public function borrarDelHistorial($productoId)
    {
        DB::table('busquedas')
            ->where('user_id', auth()->id())
            ->where('producto_id', $productoId)
            ->delete();
    }
    public function render()
    {
        return view('livewire.includes.buscar-producto',
            [
                'productos' => strlen($this->buscar) >= 3 ? Producto::search($this->buscar)->get() : [],
                'historial' => DB::table('busquedas')
                    ->where('user_id', auth()->id())
                    ->limit(10)
                    ->orderByDesc('created_at')
                    ->get()
            ]);
    }
}
