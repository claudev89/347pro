<?php

namespace App\Livewire\Includes;

use App\Models\Producto;
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

        session([$this->producto->id, $this->cantidad]);

        $this->dispatch('carro-actualizado', ['productoID' => $this->producto->id, 'cantidad' => $this->cantidad]);
    }

    public function render()
    {
        return view('livewire.includes.aniadir-al-carro', ['producto' => $this->producto]);
    }
}
