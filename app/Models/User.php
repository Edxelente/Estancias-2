<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Deshabilitar los timestamps automáticos.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username', // Cambié 'name' a 'username'
        'password',
    ];

    /**
     * Los atributos que deberían ser ocultados durante la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deberían ser convertidos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed', // Asegura que la contraseña sea cifrada
        ];
    }

    /**
     * Relación de un usuario con un rol (un usuario tiene un rol).
     */
    public function roles()
{
    return $this->belongsToMany(Roles::class);
}
}
