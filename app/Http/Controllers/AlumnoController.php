<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Materia;
use App\Models\Grupo;
use App\Models\HistorialAcademico;
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
    // Mostrar la selección de horario
    public function seleccionarHorario()
    {
        $alumno = Auth::user();

        // Obtener todos los grupos con su materia y maestro
        $grupos = Grupo::with(['materia', 'maestro'])->get();

        // IDs de grupos que el alumno ya tiene inscritos
        $seleccionadosIds = $alumno->grupos->pluck('id')->toArray();

        // Créditos disponibles del alumno
        $creditosDisponibles = $alumno->creditos;

        return view('alumno.horario', compact('grupos', 'seleccionadosIds', 'creditosDisponibles'));
    }



    /**
     * Progreso del alumno
     */
  public function progreso()
{
    $alumnoId = auth()->id();

    // Historial de materias cursadas
    $historial = \App\Models\HistorialAcademico::with(['materia','maestro'])
                    ->where('alumno_id', $alumnoId)
                    ->get();

    // Materias pendientes
    $materiasPendientes = \App\Models\Materia::whereNotIn('id', $historial->pluck('materia_id'))->get();

    // Promedio
    $promedio = $historial->avg('calificacion');

    // Créditos cursados
    $creditosCursados = $historial->sum('creditos_otorgados');

    // Créditos aprobados
    $creditosAprobados = $historial->where('calificacion','>=',70)->sum('creditos_otorgados');

    // Total de créditos (cursados + pendientes)
    $totalCreditos = $creditosCursados + $materiasPendientes->sum('creditos');

    // Agrupar materias por semestre
    $materiasPorSemestre = $historial->groupBy(function($item){
        return $item->materia->semestre; // suponiendo que la materia tiene campo 'semestre'
    });

    return view('alumno.progreso', compact(
        'historial',
        'materiasPendientes',
        'promedio',
        'creditosCursados',
        'creditosAprobados',
        'totalCreditos',
        'materiasPorSemestre'
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
  // Confirmar inscripción de materias
 public function inscribirse(Request $request)
{
    $alumno = Auth::user();
    $materiasSeleccionadas = json_decode($request->materias_seleccionadas);

    if (empty($materiasSeleccionadas)) {
        return redirect()->back()->with('error', 'No seleccionaste ninguna materia.');
    }

    // Grupos actuales
    $gruposActuales = $alumno->grupos()->with('materia')->get();

    // Grupos que seleccionó
    $gruposSeleccionados = Grupo::with('materia')->whereIn('id', $materiasSeleccionadas)->get();

    // 🔥 VALIDACIÓN NUEVA: evitar reinscribirse si ya aprobó la materia
    $historial = \App\Models\HistorialAcademico::where('alumno_id', $alumno->id)->get();
    $materiasAprobadas = $historial->where('calificacion', '>=', 70)->pluck('materia_id')->toArray();

    foreach ($gruposSeleccionados as $grupo) {
        if (in_array($grupo->materia_id, $materiasAprobadas)) {
            return redirect()->back()->with('error',
                'No puedes inscribirte en "' . $grupo->materia->nombre . '" porque ya la acreditaste.'
            );
        }
    }

    // Validar conflictos de horario
    foreach ($gruposSeleccionados as $nuevoGrupo) {
        $nuevoInicio = strtotime($nuevoGrupo->hora_inicio);
        $nuevoFin    = strtotime($nuevoGrupo->hora_fin);

        foreach ($gruposActuales as $existente) {
            $existInicio = strtotime($existente->hora_inicio);
            $existFin    = strtotime($existente->hora_fin);

            if (!($nuevoFin <= $existInicio || $nuevoInicio >= $existFin)) {
                return redirect()->back()->with('error',
                    'No puedes inscribirte en "' . $nuevoGrupo->materia->nombre .
                    '" porque tiene conflicto con "' . $existente->materia->nombre . '".'
                );
            }
        }
    }

    // Validar créditos
    $totalSeleccion = $gruposSeleccionados->sum(function($g) {
        return $g->materia->creditos ?? 0;
    });

    if ($totalSeleccion > $alumno->creditos) {
        return redirect()->back()->with('error', 'Excedes los créditos disponibles.');
    }

    // Guardar selección
    $alumno->grupos()->syncWithoutDetaching($materiasSeleccionadas);

    // Restar créditos
    $alumno->creditos -= $totalSeleccion;
    $alumno->save();

    return redirect()->back()->with('success', 'Inscripción realizada correctamente.');
}

}
