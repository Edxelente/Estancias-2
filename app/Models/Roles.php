<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    // Especificamos qué campos son asignables
    protected $fillable = ['name'];

    // Relación con el modelo de usuario (un rol tiene muchos usuarios)
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function roles()
{
    return $this->belongsToMany(Roles::class, 'roles_user');
}
}
