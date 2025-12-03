<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumnoGrupoSeeder extends Seeder
{
    public function run()
    {
        // Ejemplo: asignar alumnos a grupos
        DB::table('alumno_grupo')->insert([
            [
                'alumno_id' => 1,  // ID del alumno
                'grupo_id' => 1,   // ID del grupo
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'alumno_id' => 1,
                'grupo_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'alumno_id' => 2,
                'grupo_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
