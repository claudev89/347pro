<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    public $timestamps = false;

    protected $fillable = ['nombre', 'imagen', 'slug'];
    protected $hidden = ['id'];

    use HasFactory;

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
