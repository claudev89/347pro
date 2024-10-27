<?php

namespace App\Livewire\Includes;

use Illuminate\Support\Facades\Auth;
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

        if(Auth::attempt(['email' => $this->email, 'password' => $this->contrasenia], $this->remember)) {
            session()->regenerate();

            $this->dispatch('logeado');
            request()->session()->flash('mensaje',
                [
                    'positivo' => true,
                    'mensaje' => 'Bienvenid@ de nuevo <strong>'.
                        \auth()->user()->name .
                        '</strong> iniciaste sesión correctamente.'
                ]);
            $this->reset();
            return redirect(request()->header('Referer'));
        } else {
            $this->errorCredenciales = true;
            return ;
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
