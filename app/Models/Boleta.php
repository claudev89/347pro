<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    use HasFactory;

    public function orden()
    {
        return $this->hasOne(Orden::class);
    }

    public function cliente()
    {
        return $this->hasOneThrough(User::class, Orden::class, 'id', 'id', 'orden_id', 'user_id');
    }
}
