<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categoria extends Model
{
    public $timestamps = false;

    public $hidden = ['id'];

    public $fillable = ['nombre', 'slug', 'descripcion', 'categoriaPadre', 'posicion', 'imagen'];


    use HasFactory;

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($model) {
            $maxPosition = static::max('posicion');
            $model->posicion = $maxPosition ? $maxPosition + 1 : 1;
        });
    }

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function subcategorias()
    {
        return $this->hasMany(Categoria::class, 'categoria_padre_id');
    }

    public function categoriaPadre()
    {
        return $this->belongsTo(Categoria::class, 'categoria_padre_id');
    }

    public static function categoriaMasVista()
    {
        $categoriamasVista = Producto::with('categoria')
            ->groupBy('categoria_id')
            ->selectRaw('categoria_id, sum(visitas) as total_visitas')
            ->orderBy('total_visitas', 'desc')
            ->first();

        return $categoriamasVista ? $categoriamasVista->categoria->nombre : "Ninguna";
    }

    public static function productosPorCategoria()
    {
        $promedios = Producto::select('categoria_id', DB::raw('count(*) as total_productos'))
            ->groupBy('categoria_id')
            ->get();

        $promedio = $promedios->avg('total_productos') ? $promedios->avg('total_productos') : 'Aún no hay productos';

        return $promedio;
    }

    public function defaultImage()
    {
        if($this->imagen) {
            return $this->imagen;
        } elseif ($this->subcategorias->count() > 0 && $this->subcategorias->whereNotNull('imagen')->count() > 0) {
            return $this->subcategorias->whereNotNull('imagen')->first()->imagen;
        } elseif ($this->productos->count() > 0) {
            return $this->productos->first()->imagenes[0];
        } elseif ($this->subcategorias->count() > 0 && $this->subcategorias->filter(function ($subcategoria) {
            return $subcategoria->productos->count() > 0;
            })) {
            return $this->subcategorias
                ->filter(fn($subcategoria) => $subcategoria->productos->count() > 0)
                ->first()->productos->first()->imagenes[0];
        } else {
            return null;
        }
    }

    public function obtenerProductos()
    {
        return Producto::where('categoria_id', $this->id)
            ->orWhereIn('categoria_id', $this->subcategorias->pluck('id'));
    }


    public function obtenerMarcas()
    {
        $marcas = Marca::whereHas('productos', function ($query) {
            $query->whereIn('id', self::obtenerProductos()->pluck('id'));
        })->get();

        return $marcas;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
