<?php

namespace App\Models;

use App\Models\Reserva;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'password',
        'telefono',
        'imagenusuario',
        'rol',
        'insta_user',
    ];

    /**
     * Los atributos que deben ocultarse en arrays o JSON.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Definición de casts.
     *
     * Nota: Laravel 12 usa ahora un método en lugar de la propiedad $casts.
     *
     * @return array<string,string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * Relación: un usuario tiene muchas reservas.
     */
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'idCliente');
    }

    /**
     * Scope para filtrar por apellidos.
     */
    public function scopeApellidos($query, $apellidos)
    {
        if ($apellidos) {
            return $query->where('apellidos', 'like', "%{$apellidos}%");
        }
    }

    /**
     * Scope para filtrar por email.
     */
    public function scopeEmail($query, $email)
    {
        if ($email) {
            return $query->where('email', 'like', "%{$email}%");
        }
    }

    /**
     * Scope para filtrar por rol.
     */
    public function scopeRol($query, $rol)
    {
        if ($rol) {
            return $query->where('rol', 'like', "%{$rol}%");
        }
    }
}
