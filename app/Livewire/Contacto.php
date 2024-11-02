<?php

namespace App\Livewire;

use App\Mail\ContactoMailable;
use Exception;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Contacto extends Component
{
    #[Validate('required|min:3|max:50')]
    public $nombre;
   #[Validate('email|required|max:128')]
    public $correo;

   #[Validate('required|min:30|:max:1000')]
   public $mensaje;

   public function mount()
   {
       if (auth()->user()) {
           $this->nombre = auth()->user()->name;
           $this->correo = auth()->user()->email;
       }
   }

   public function enviarCorreo()
   {
       $this->validate();
       $datosValidados = $this->validate();
       try {
           Mail::to('admin@347pro.cl')->send(new ContactoMailable($datosValidados));
           session()->flash('mensaje',
               [
                   'positivo' => true,
                   'mensaje' => 'Mensaje enviado correctamente. Te responderemos a la brevedad.'
               ]);
           $this->redirect(request()->header('Referer'));
       } catch (\Throwable $th) {
           session()->flash('mensaje',
               [
                   'positivo' => false,
                   'mensaje' => 'Su mensaje no pudo ser enviado. Inténtelo más tarde.'
               ]);
       }
   }

    public function render()
    {
        return view('livewire.contacto');
    }
}
