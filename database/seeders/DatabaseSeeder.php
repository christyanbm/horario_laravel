<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Primero roles
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            MateriasSeeder::class, // ← Aquí llamamos a tu seeder correctamente
             GrupoSeeder::class,
        ]);

        // Usuario extra de prueba
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
