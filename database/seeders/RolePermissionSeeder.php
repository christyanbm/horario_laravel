<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole=Role::create(['name'=>'admin']);
        $alumnoRole=Role::create(['name'=>'alumno']);
        $jefeRole=Role::create(['name'=>'jefe']);
        $maestroRole=Role::create(['name'=>'maestro']);
        $coordinadorRole=Role::create(['name'=>'coordinador']);
    }
}
