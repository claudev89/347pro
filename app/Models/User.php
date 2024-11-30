<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telefono',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function ordenes()
    {
        return $this->hasMany(Orden::class);
    }

    public function productosGuardados()
    {
        return $this->belongsToMany(
            Producto::class, 'productos_guardados', 'producto_id', 'user_id'
        );
    }

    public function direcciones()
    {
        return $this->hasMany(Direccion::class);
    }

    public function boletas()
    {
        return $this->hasOneThrough(Boleta::class, Orden::class, 'user_id', 'orden_id', 'id', 'id');
    }

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class);
    }

    public function getCarrito()
    {
        if (
            auth()->check() &&
            DB::table('ordens')
                ->where('user_id', auth()->id())
                ->where('estado', 'pe')
                ->exists()
        ) {
            // Recuperar la orden pendiente más reciente
            $orden = DB::table('ordens')
                ->where('user_id', auth()->id())
                ->where('estado', 'pe')
                ->orderBy('created_at', 'desc')
                ->first();

            // Transformar los productos relacionados en una colección de objetos
            $productos = DB::table('orden_productos')
                ->where('orden_id', $orden->id)
                ->get()
                ->map(fn($item) => (object) [
                    'producto_id' => $item->producto_id,
                    'cantidad' => $item->cantidad,
                ])
                ->toArray();

            return $productos;
        } else {
            return [];
        }
    }


}
