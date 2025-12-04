<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Materia;
use App\Models\Grupo;

class AlumnoController extends Controller
{
    /**
     * Dashboard del alumno
     */
    public function index()
    {
        $alumno = Auth::user();

        $materiasAprobadas   = $alumno->materiasAprobadas;
        $materiasReprobadas  = $alumno->materiasReprobadas;
        $creditos            = $alumno->creditosAprobados();

        // Traemos todos los grupos disponibles
        $grupos = Grupo::with('materia')->get();

        return view('alumno.index', compact(
            'alumno',
            'materiasAprobadas',
            'materiasReprobadas',
            'creditos',
            'grupos'
        ));
    }

    /**
     * Selección de horario
     */
 public function seleccionarHorario()
{
    $alumno = Auth::user();

    $grupos = Grupo::with(['materia', 'maestro', 'alumnos'])->get();

    // IDs de los grupos ya seleccionados por el alumno
    $seleccionadosIds = $alumno->grupos->pluck('id')->toArray();

    return view('alumno.horario', compact('grupos', 'seleccionadosIds'));
}

    /**
     * Progreso del alumno
     */
    public function progreso()
    {
        $alumno = Auth::user();

        $materiasAprobadas  = $alumno->materiasAprobadas;
        $materiasReprobadas = $alumno->materiasReprobadas;
        $creditos           = $alumno->creditosAprobados();

        return view('alumno.progreso', compact(
            'materiasAprobadas',
            'materiasReprobadas',
            'creditos'
        ));
    }

    /**
     * Historial de materias del alumno
     */
public function materias()
{
    $alumno = Auth::user();

    // Traer los grupos donde el alumno está inscrito, incluyendo materia y maestro si quieres
    $gruposInscritos = $alumno->grupos()->with(['materia', 'maestro'])->get();

    return view('alumno.materias', compact('gruposInscritos'));
}

    /**
     * Inscribirse en uno o varios grupos
     */
    public function inscribirse(Request $request)
    {
        $alumno = Auth::user();

        // Validar que se envíe un array JSON de materias
        $request->validate([
            'materias_seleccionadas' => 'required|json',
        ]);

        $materias = json_decode($request->materias_seleccionadas, true);

        if (empty($materias)) {
            return back()->with('error', 'No seleccionaste materias.');
        }

        foreach ($materias as $grupo_id) {
            $grupo = Grupo::with('materia', 'alumnos')->find($grupo_id);
            if (!$grupo) continue;

            // 1️⃣ Verificar cupo disponible
            if ($grupo->alumnos()->count() >= $grupo->cupo_max) {
                return back()->with('error', "El grupo {$grupo->materia->nombre} está lleno.");
            }

            // 2️⃣ Evitar duplicados
            if ($alumno->grupos->contains($grupo->id)) {
                continue;
            }

            // 3️⃣ Verificar conflictos de horario
            $conflicto = $alumno->grupos->first(function ($g) use ($grupo) {
                return $grupo->hora_inicio < $g->hora_fin && $grupo->hora_fin > $g->hora_inicio;
            });

            if ($conflicto) {
                return back()->with('error', "El grupo {$grupo->materia->nombre} tiene conflicto de horario con {$conflicto->materia->nombre}.");
            }

            // 4️⃣ Inscribir alumno
            $alumno->grupos()->attach($grupo->id);
        }

        return back()->with('success', 'Te has inscrito correctamente en los grupos seleccionados.');
    }
    public function inscribirseMultiple(Request $request)
{
    return $this->inscribirse($request);
}

}
