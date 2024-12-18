<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $hidden = ['id'];

    protected $fillable = [
        'nombre',
        'slug',
        'precio',
        'cantidad',
        'marca_id',
        'descripcion_corta',
        'descripcion_larga',
        'categoria_id',
        'visitas',
        'imagenes',
        ];

    protected $casts = [
        'imagenes' => 'array',
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class);
    }

    public function ordenes()
    {
        return $this->belongsToMany(Orden::class);
    }

    public function usuariosGuardaron()
    {
        return $this->belongsToMany(
            User::class, 'productos_guardados', 'producto_id', 'user_id'
        );
    }

    public function imagenes()
    {
        return $this->hasMany(ImagenProducto::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getUrl() : string
    {
        if ( $this->categoria->categoriaPadre )
        {
            return url($this->categoria->categoriaPadre->slug . '/' . $this->categoria->slug . '/' . $this->slug);
        }
        else {
            return url($this->categoria->slug . '/' . $this->slug);
        }
    }

    public function getPortada()
    {
        foreach ($this->imagenes as $imagen)
        {
            if(pathinfo(asset('storage/' . $imagen), PATHINFO_EXTENSION) != 'mp4'
                && pathinfo(asset('storage/' . $imagen), PATHINFO_EXTENSION) != 'mpeg4') {
                $portada = asset('storage/' . $imagen);
                break;
            }
        }
        return $portada;
    }

    public function scopeSearch($query, $value)
    {
        $query->where('nombre', 'LIKE', '%' . $value . '%')
            ->orWhereHas('categoria', function ($q) use ($value) {
                $q->where('nombre', 'LIKE', '%' . $value . '%');
            });

    }
}
