<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenProducto extends Model
{
    use HasFactory;

    protected $fillable = ['ruta', 'posision', 'producto_id'];
    protected $hidden = ['id'];
    public $timestamps = false;

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
