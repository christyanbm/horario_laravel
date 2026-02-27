<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Grupo;
use Illuminate\Support\Facades\DB;

class InscripcionController extends Controller
{
 
    public function inscribirse(Request $request)
    {
        $request->validate([
            'materias_seleccionadas' => 'required|json',
        ]);

        $alumno = auth()->user(); 
        $materiasIds = json_decode($request->materias_seleccionadas, true);

        if (empty($materiasIds)) {
            return back()->with('error', 'No seleccionaste ninguna materia.');
        }

        
        $totalCreditos = Grupo::whereIn('id', $materiasIds)->sum(function($grupo) {
            return $grupo->materia->creditos ?? 0;
        });

       
        if ($totalCreditos > $alumno->creditos) {
            return back()->with('error', 'No tienes créditos suficientes para inscribirte en estas materias.');
        }

        DB::transaction(function () use ($materiasIds, $alumno, $totalCreditos) {
            
            foreach ($materiasIds as $grupoId) {
                $alumno->grupos()->attach($grupoId);
            }

          
            $alumno->decrement('creditos', $totalCreditos);
        });

        return back()->with('success', 'Materias inscritas correctamente. Créditos actualizados.');
    }
}
