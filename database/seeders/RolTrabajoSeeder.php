<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RolTrabajo;

class RolTrabajoSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['nombre' => 'Encargado de cocina', 'descripcion' => 'Supervisa la preparación de los alimentos.'],
            ['nombre' => 'Cajero', 'descripcion' => 'Encargado de los pagos y el registro de ventas.'],
            ['nombre' => 'Meseros', 'descripcion' => 'Proveen atención directa a los clientes.'],
            ['nombre' => 'Personal de limpieza', 'descripcion' => 'Mantienen el espacio en condiciones óptimas.'],
        ];

        foreach ($roles as $role) {
            RolTrabajo::create($role);
        }
    }
}
