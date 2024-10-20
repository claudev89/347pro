<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class UrlsController extends Controller
{
    public function show($slug1, $slug2 = null, $slug3 = null)
    {
        $categoria = Categoria::where('slug', $slug1)->first();
        if($slug3) {
            $producto = Producto::where('slug', $slug3)->first();
            $subcategoria = $producto->categoria;
            return view('producto.show', compact('producto', 'subcategoria', 'categoria'));
        } elseif ($slug2) {
            if(Producto::where('slug', $slug2)->firstOrFail()) {
                $producto = Producto::where('slug', $slug2)->first();
                return view('producto.show', compact('producto', 'categoria'));
            } else {
                $subcategoria = Categoria::where('slug', $slug2)->first();
                return  view('categoria.show', compact('subcategoria', 'categoria'));
            }
        }
        else {
            $categoria = Categoria::where('slug', $slug1)->first();
            return view('categoria.show', compact('categoria'));
        }
    }
}
