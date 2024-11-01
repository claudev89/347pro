<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function show(Categoria $categoria, ?Categoria $subcategoria, Producto $producto)
    {
        $producto-> visitas += 1;
        $producto->save();

        return view('producto.show', compact('producto'));
    }

    public function index()
    {
        return view('producto.index');
    }
}
