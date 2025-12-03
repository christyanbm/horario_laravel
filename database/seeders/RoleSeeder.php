<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        Role::create(['name' => 'jefe', 'guard_name' => 'web']);
        Role::create(['name' => 'alumno', 'guard_name' => 'web']);
        Role::create(['name' => 'maestro', 'guard_name' => 'web']);
        Role::create(['name' => 'coordinador', 'guard_name' => 'web']);
    }
}
