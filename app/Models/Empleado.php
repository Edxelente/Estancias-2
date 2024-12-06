<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'direccion',
        'rol_trabajo_id',
        'salario',
    ];

    // Relación con el rol de trabajo
    public function rolTrabajo()
    {
        return $this->belongsTo(RolTrabajo::class, 'rol_trabajo_id');
    }
}
