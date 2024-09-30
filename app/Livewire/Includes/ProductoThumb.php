<?php

namespace App\Livewire\Includes;

use Livewire\Component;

class ProductoThumb extends Component
{
    public $props = [
        'imagen' => '',
        'titulo' => '',
        'precio' => 0,

    ];

    public function mount($props = [])
    {
        $this->props = array_merge($this->props, $props);
    }
    public function render()
    {
        return view('livewire.includes.producto-thumb');
    }
}
