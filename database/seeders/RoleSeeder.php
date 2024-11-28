<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Roles::create(['name' => 'Admin']);
        Roles::create(['name' => 'User']);
    }
}
