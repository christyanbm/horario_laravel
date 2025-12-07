<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AsignarRolesSeeder extends Seeder
{
    public function run()
    {
        // Asignar roles principales
        User::find(1)?->assignRole('Administrador');
        User::find(2)?->assignRole('Jefe');
        User::find(3)?->assignRole('Coordinador');
        User::find(4)?->assignRole('Maestro');
        User::find(5)?->assignRole('Alumno');

        // Asignar ALUMNO a todos los usuarios que no tengan rol
        $usuariosSinRol = User::doesntHave('roles')->get();

        foreach ($usuariosSinRol as $usuario) {
            $usuario->assignRole('Alumno');
        }
    }
}
