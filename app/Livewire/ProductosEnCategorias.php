<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Marca;
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

    public $marca;

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
        'porPagina' => ['except' => 12],
        'marca' => ['except' => null],

    ];

    public function render()
    {
        if(isset($this->categoria)) {
            $productos = $this->categoria
                ->obtenerProductos()
                ->when($this->marca, function ($query) {
                    return $query->whereHas('marca', function ($query) {
                        $query->where('slug', $this->marca);
                    });
                })
                ->orderBy($this->columnaAOrdenar, $this->direccion)
                ->paginate($this->porPagina);
        } else {
            $productos = Producto::when($this->marca, function ($query) {
                return $query->whereHas('marca', function ($query) {
                    $query->where('slug', $this->marca);
                });
            })
                ->orderBy($this->columnaAOrdenar, $this->direccion)
                ->paginate($this->porPagina);
        }

        return view('livewire.productos-en-categorias', ['productos' => $productos]);
    }
}
