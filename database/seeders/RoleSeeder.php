<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Roles::insert([
            ['name' => 'Admin'],
            ['name' => 'User'],
            ['name' => 'Editor'],
            ['name' => 'Viewer']
        ]);
    }
}
