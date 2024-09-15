<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function imagenes()
    {
        return $this->morphMany(Imagen::class, 'imageable');
    }

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
}
