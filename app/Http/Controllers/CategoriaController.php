<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function show($categoriaSlug, $subcategoriaOProductoSlug = null, $productoSlug = null)
    {
        // Buscar la categoría principal por slug
        $categoria = Categoria::where('slug', $categoriaSlug)->firstOrFail();

        // Caso 1: Tres segmentos (/categoria/subcategoria/producto)
        if ($productoSlug) {
            // Intentar buscar la subcategoría dentro de la categoría
            $subcategoria = Categoria::where('slug', $subcategoriaOProductoSlug)
                ->where('categoria_padre_id', $categoria->id)
                ->firstOrFail();

            // Buscar el producto dentro de la subcategoría
            $producto = Producto::where('slug', $productoSlug)
                ->where('categoria_id', $subcategoria->id)
                ->firstOrFail();
            $producto->visitas ++;
            $producto->save();

            // Mostrar el producto en la subcategoría
            return view('producto.show', compact('producto'));
        }

        // Caso 2: Dos segmentos (/categoria/producto o /categoria/subcategoria)
        if ($subcategoriaOProductoSlug) {
            // Primero intentamos ver si el segundo segmento es una subcategoría
            $subcategoria = Categoria::where('slug', $subcategoriaOProductoSlug)
                ->where('categoria_padre_id', $categoria->id)
                ->first();

            if ($subcategoria) {
                // Mostrar la vista de la subcategoría si se encuentra
                return view('categoria.show', compact('subcategoria'));
            }

            // Si no es subcategoría, intentamos buscar el producto dentro de la categoría principal
            $producto = Producto::where('slug', $subcategoriaOProductoSlug)
                ->where('categoria_id', $categoria->id)
                ->first();

            if ($producto) {
                // Mostrar el producto en la categoría principal
                $producto->visitas ++;
                $producto->save();
                return view('producto.show', compact('producto'));
            }

            // Si no es ni una subcategoría ni un producto, lanzar 404
            abort(404);
        }

        // Caso 3: Un solo segmento (/categoria) -> Mostrar la categoría
        return view('categoria.show', compact('categoria'));
    }
}
