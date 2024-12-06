<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolTrabajo extends Model
{
    use HasFactory;

    protected $table = 'rol_trabajo';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'rol_trabajo_id');
    }
}
