<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Jefe', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Coordinador', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Maestro', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Alumno', 'guard_name' => 'web']);
    }
}
