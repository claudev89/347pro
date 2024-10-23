<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class ProductosEnCategorias extends Component
{
    use WithPagination;

    public $categoria;
    public $columnaAOrdenar = 'created_at';
    public $direccion = 'desc';
    public $ordenSeleccionado = 'created_at_desc';
    public $porPagina = 12;

    public function mount($categoria)
    {
        $this->categoria = $categoria;
    }

    public function updatedOrdenSeleccionado($valor)
    {
        list($columna, $direccion) = explode('?', $valor);
        $this->columnaAOrdenar = $columna;
        $this->direccion = $direccion;
    }

    public function render()
    {
        $productos = $this->categoria
            ->obtenerProductos()
            ->toQuery()
            ->orderBy($this->columnaAOrdenar, $this->direccion)
            ->paginate($this->porPagina);

        return view('livewire.productos-en-categorias', ['productos' => $productos]);
    }
}
