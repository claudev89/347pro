<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Producto;
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

    public function mount($categoria = null)
    {
        $this->categoria = $categoria;
    }

    public function updatedOrdenSeleccionado($valor)
    {
        list($columna, $direccion) = explode('?', $valor);
        $this->columnaAOrdenar = $columna;
        $this->direccion = $direccion;
    }

    protected $queryString = [
        'columnaAOrdenar' => ['except' => 'nombre'], // valor predeterminado
        'direccion' => ['except' => 'asc'],
        'porPagina' => ['except' => 10],
    ];

    public function render()
    {
        if(isset($this->categoria)) {
            $productos = $this->categoria
                ->obtenerProductos()
                ->toQuery()
                ->orderBy($this->columnaAOrdenar, $this->direccion)
                ->paginate($this->porPagina);
        } else {
            $productos = Producto::all()->toQuery()->orderBy($this->columnaAOrdenar, $this->direccion)
                ->paginate($this->porPagina);
        }

        return view('livewire.productos-en-categorias', ['productos' => $productos]);
    }
}
