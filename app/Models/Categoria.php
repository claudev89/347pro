<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $timestamps = false;

    use HasFactory;

    public function imagenes()
    {
        return $this->morphMany(Imagen::class, 'imageable');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
