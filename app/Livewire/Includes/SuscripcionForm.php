<?php

namespace App\Livewire\Includes;

use App\Mail\ContactoMailable;
use App\Mail\SuscripcionMail;
use App\Notifications\sendSubscriptionConfirmNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SuscripcionForm extends Component
{
    #[Validate('required|email|max:128|unique:suscripcions,correo')]
    public $correo;
    public $hash;

    public function mount()
    {
        if(auth()->user()) {
            $this->correo = auth()->user()->email;
        }
    }

    public function solicitarSuscripcion()
    {
        $this->correo = trim(strtolower($this->correo));
        $this->hash = hash('md5', $this->correo);

        try {
            $this->validate();

            DB::table('suscripcions')->insert([
                'correo' => $this->correo,
                'hash' => $this->hash,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            session()->flash('mensaje',
                [
                    'positivo' => true,
                    'mensaje' => 'Hemos enviado un correo a  <strong>'.
                        $this->correo .
                        '</strong> en el cual debes confirmar tu suscripción.'
                ]);
            Notification::route('mail', $this->correo)
                ->notify(new sendSubscriptionConfirmNotification($this->hash));
            return redirect(request()->header('Referer'));
        }
        catch (\Throwable $th) {
            session()->flash('mensaje',
                [
                    'positivo' => false,
                    'mensaje' => 'Ha ocurrido un error. Inténtelo de nuevo más tarde.'
                ]);
            return redirect(request()->header('Referer'));
        }
    }

    public function render()
    {
        return view('livewire.includes.suscripcion-form');
    }
}
