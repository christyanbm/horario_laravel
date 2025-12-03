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
        ]);
        $admin->assignRole('admin');

        // Usuario jefe
        $jefe = User::factory()->create([
            'name' => 'Jefe de Área',
            'email' => 'jefe@example.com',
        ]);
        $jefe->assignRole('jefe');

        // Usuario coordinador
        $coordinador = User::factory()->create([
            'name' => 'Coordinador General',
            'email' => 'coordinador@example.com',
        ]);
        $coordinador->assignRole('coordinador');

        // Usuario maestro
        $maestro = User::factory()->create([
            'name' => 'Maestro Ejemplo',
            'email' => 'maestro@example.com',
        ]);
        $maestro->assignRole('maestro');

        // Usuario alumno
        $alumno = User::factory()->create([
            'name' => 'Alumno Ejemplo',
            'email' => 'alumno@example.com',
        ]);
        $alumno->assignRole('alumno');

        // Crear 20 usuarios aleatorios y asignarles roles al azar
        User::factory(20)->create()->each(function ($user) {
            $roles = ['admin', 'alumno', 'jefe', 'maestro', 'coordinador'];
            $user->assignRole(fake()->randomElement($roles));
        });
    }
}
