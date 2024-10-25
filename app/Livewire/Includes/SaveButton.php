<?php

namespace App\Livewire\Includes;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class SaveButton extends Component
{
    public $producto;
    public bool $saved = false;

    public function mount($producto)
    {
        $this->producto = $producto;
        $this->saved = $this->producto->usuariosGuardaron->where('id', auth()->id())->first() ? true : false;
    }

    public function toggleSaved()
    {
        if ($this->saved) {
            DB::table('productos_guardados')
                ->where('user_id', auth()->id())
                ->where('producto_id', $this->producto->id)
                ->delete();
            $this->saved = false;
        } else {
            DB::table('productos_guardados')->insert([
                'producto_id' => $this->producto->id,
                'user_id' => auth()->id(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $this->saved = true;
        }
        $this->dispatch('saved-cambiado', $this->producto->id);
    }

    #[On('saved-cambiado')]
    public function updatedSaved($productoId)
    {
        if($this->producto->id == $productoId) {
            $this->saved = $this->producto->usuariosGuardaron->where('id', auth()->id())->first() ? true : false;
        }
    }

    public function render()
    {
        return view('livewire.includes.save-button');
    }
}
