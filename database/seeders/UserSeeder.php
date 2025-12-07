<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario administrador
        $admin = User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'matricula' => null, // Se generará automáticamente
        ]);
        $admin->assignRole('admin');

        // Usuario jefe
        $jefe = User::factory()->create([
            'name' => 'Jefe de Área',
            'email' => 'jefe@example.com',
            'matricula' => null,
        ]);
        $jefe->assignRole('jefe');

        // Usuario coordinador
        $coordinador = User::factory()->create([
            'name' => 'Coordinador General',
            'email' => 'coordinador@example.com',
            'matricula' => null,
        ]);
        $coordinador->assignRole('coordinador');

        // Usuario maestro
        $maestro = User::factory()->create([
            'name' => 'Maestro Ejemplo',
            'email' => 'maestro@example.com',
            'matricula' => null,
        ]);
        $maestro->assignRole('maestro');

        // Usuario alumno
        $alumno = User::factory()->create([
            'name' => 'Alumno Ejemplo',
            'email' => 'alumno@example.com',
            'matricula' => null,
        ]);
        $alumno->assignRole('alumno');

        // Crear 20 usuarios aleatorios con matrícula automática
        User::factory(40)->create()->each(function ($user) {
            $roles = ['admin', 'alumno', 'jefe', 'maestro', 'coordinador'];
            $user->assignRole(fake()->randomElement($roles));
        });
    }
}
