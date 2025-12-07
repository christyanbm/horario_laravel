<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Materia;

class GrupoSeeder extends Seeder
{
    public function run(): void
    {
        $materias = Materia::all();

        if ($materias->count() == 0) {
            $this->command->warn("No hay materias registradas. Ejecuta primero MateriasSeeder.");
            return;
        }

        $maestros = User::role('maestro')->get();

        foreach ($materias as $materia) {

            // Generar hora de inicio aleatoria entre 8:00 y 16:00
            $horaInicio = rand(8, 16) . ':00';
            // Hora de fin +2 horas
            $horaFin = (intval(explode(':', $horaInicio)[0]) + 2) . ':00';

            DB::table('grupos')->insert([
                'nombre' => 'Grupo ' . strtoupper(mb_substr($materia->nombre, 0, 1, 'UTF-8')) . rand(1, 9),
                'cupo_max' => rand(20, 40),
                'hora_inicio' => $horaInicio,
                'hora_fin'   => $horaFin,
                'materia_id' => $materia->id,
                'maestro_id' => $maestros->random()->id ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
