<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Grupo;
use Illuminate\Support\Facades\DB;

class InscripcionController extends Controller
{
    /**
     * Inscribir materias seleccionadas por el alumno
     */
    public function inscribirse(Request $request)
    {
        $request->validate([
            'materias_seleccionadas' => 'required|json',
        ]);

        $alumno = auth()->user(); // Obtenemos el alumno logueado
        $materiasIds = json_decode($request->materias_seleccionadas, true);

        if (empty($materiasIds)) {
            return back()->with('error', 'No seleccionaste ninguna materia.');
        }

        // Calculamos créditos totales de las materias seleccionadas
        $totalCreditos = Grupo::whereIn('id', $materiasIds)->sum(function($grupo) {
            return $grupo->materia->creditos ?? 0;
        });

        // Verificar si el alumno tiene créditos suficientes
        if ($totalCreditos > $alumno->creditos) {
            return back()->with('error', 'No tienes créditos suficientes para inscribirte en estas materias.');
        }

        DB::transaction(function () use ($materiasIds, $alumno, $totalCreditos) {
            // Registrar las materias en la tabla pivot (ejemplo: alumno_grupo)
            foreach ($materiasIds as $grupoId) {
                $alumno->grupos()->attach($grupoId);
            }

            // Restar los créditos usados al alumno
            $alumno->decrement('creditos', $totalCreditos);
        });

        return back()->with('success', 'Materias inscritas correctamente. Créditos actualizados.');
    }
}
