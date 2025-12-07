<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Grupo;
use App\Models\HistorialAcademico;

class MaestroController extends Controller
{
    /* ============================================================
     |  DASHBOARD
     ============================================================ */
    public function index()
    {
        return view('maestro.index');
    }

    /* ============================================================
     |  HORARIO DEL MAESTRO
     ============================================================ */
    public function horario()
    {
        $maestro = auth()->user();

        $grupos = Grupo::with('materia')
            ->where('maestro_id', $maestro->id)
            ->orderBy('hora_inicio')
            ->get();

        return view('maestro.horario', compact('grupos'));
    }

    /* ============================================================
     |  LISTA DE GRUPOS PARA ASISTENCIAS
     ============================================================ */
    public function listarGrupos()
    {
        $maestro = auth()->user();

        $grupos = Grupo::where('maestro_id', $maestro->id)->get();

        return view('maestro.asistencias.lista_grupos', compact('grupos'));
    }

    /* ============================================================
     |  TOMAR ASISTENCIAS
     ============================================================ */
  public function asistencias($grupo_id)
{
    $grupo = Grupo::with(['materia', 'alumnos'])
        ->where('id', $grupo_id)
        ->where('maestro_id', auth()->id())
        ->firstOrFail();

    // Traer asistencias ya registradas para este grupo
    $asistenciasRegistradas = Asistencia::with('alumno')
        ->where('grupo_id', $grupo->id)
        ->orderBy('fecha', 'desc')
        ->get();

    return view('maestro.asistencias.tomar', [
        'grupo' => $grupo,
        'alumnos' => $grupo->alumnos,
        'asistenciasRegistradas' => $asistenciasRegistradas
    ]);
}


    public function registrarAsistencias(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'alumnos'  => 'required|array'
        ]);

        $grupo = Grupo::findOrFail($request->grupo_id);

        foreach ($request->alumnos as $alumno_id => $datos) {
            Asistencia::create([
                'grupo_id'    => $grupo->id,
                'materia_id'  => $grupo->materia_id,
                'maestro_id'  => auth()->id(),
                'alumno_id'   => $alumno_id,
                'estado'      => $datos['estado'] ?? 'presente',
                'observacion' => $datos['observacion'] ?? null,
                'fecha'       => now()->format('Y-m-d'),
                'hora'        => now()->format('H:i:s'),
            ]);
        }

        return back()->with('success', 'Asistencias registradas correctamente.');
    }

    /* ============================================================
     |  CALIFICACIONES – LISTA DE GRUPOS
     ============================================================ */
    public function indexCalificaciones()
    {
        $maestro = auth()->user();

        $grupos = Grupo::with('materia')
            ->where('maestro_id', $maestro->id)
            ->get();

        return view('maestro.calificaciones.index', compact('grupos'));
    }

    /* ============================================================
     |  CREAR CALIFICACIONES
     ============================================================ */
public function createCalificaciones($grupo_id)
{
    $grupo = Grupo::with(['materia', 'alumnos'])->where('id', $grupo_id)
        ->where('maestro_id', auth()->id())
        ->firstOrFail();

    // Traer las calificaciones existentes del grupo/materia
    $calificacionesExistentes = HistorialAcademico::where('materia_id', $grupo->materia_id)
        ->whereIn('alumno_id', $grupo->alumnos->pluck('id'))
        ->pluck('calificacion', 'alumno_id'); // clave = alumno_id, valor = calificación

    return view('maestro.calificaciones.create', compact('grupo', 'calificacionesExistentes'));
}

   public function storeCalificaciones(Request $request)
{
    $request->validate([
        'grupo_id'       => 'required|exists:grupos,id',
        'calificaciones' => 'required|array',
    ]);

    $grupo = Grupo::with('materia')->findOrFail($request->grupo_id);

    foreach ($request->calificaciones as $alumno_id => $nota) {
        $creditos = $grupo->materia->creditos;

        HistorialAcademico::create([
            'alumno_id'          => $alumno_id,
            'maestro_id'         => auth()->id(),
            'materia_id'         => $grupo->materia_id,
            'calificacion'       => $nota,
            'creditos_otorgados' => $creditos,
        ]);

        // Incrementar créditos del alumno, no del maestro
        $alumno = \App\Models\User::find($alumno_id);
        if ($alumno) {
            $alumno->increment('creditos', $creditos);
        }
    }

    return redirect()
        ->route('maestro.calificaciones.index')
        ->with('success', 'Calificaciones registradas correctamente.');
}


    /* ============================================================
     |  EDITAR CALIFICACIÓN
     ============================================================ */
    public function editCalificacion($id)
    {
        $calificacion = HistorialAcademico::with(['alumno', 'materia'])
            ->findOrFail($id);

        return view('maestro.calificaciones.edit', compact('calificacion'));
    }

    public function updateCalificacion(Request $request, $id)
    {
        $request->validate([
            'calificacion' => 'required|numeric|min:0|max:100'
        ]);

        $calificacion = HistorialAcademico::findOrFail($id);

        $creditos = $request->calificacion >= 60 ? 2 : 1;

        $calificacion->update([
            'calificacion'        => $request->calificacion,
            'creditos_otorgados'  => $creditos
        ]);

        return redirect()
            ->route('maestro.calificaciones.index')
            ->with('success', 'Calificación actualizada correctamente.');
    }

    /* ============================================================
     |  CALIFICACIONES FINALES (VISTA GENERAL)
     ============================================================ */
    public function calificacionesFinales()
    {
        $maestro = auth()->user();

        $grupos = Grupo::with('materia')
            ->where('maestro_id', $maestro->id)
            ->get();

        return view('maestro.calificaciones_finales', compact('grupos'));
    }
}
