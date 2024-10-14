<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function show(Categoria $categoria, ?Categoria $subcategoria, Producto $producto)
    {
        return view('producto.show', compact('producto'));
    }
}
