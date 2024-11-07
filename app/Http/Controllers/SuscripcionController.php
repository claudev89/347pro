<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuscripcionController extends Controller
{
    public function activarSuscripcion($hash)
    {
        $registro = DB::table('suscripcions')->where('hash', $hash)->exists();

        if($registro) {
            DB::table('suscripcions')->where('hash', $hash)->update(['hash' => null, 'updated_at' => now()]);
            session()->flash('mensaje',
                [
                    'positivo' => true,
                    'mensaje' => 'Suscripción activada correctamente.'
                ]);
            return view('welcome');
        } else {
            session()->flash('mensaje',
                [
                    'positivo' => false,
                    'mensaje' => 'Link de suscripción no válido.'
                ]);
            return view('welcome');
        }
    }
}
