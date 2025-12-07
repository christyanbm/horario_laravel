<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Grupo;
use App\Models\HistorialAcademico;

class MaestroController extends Controller
{
    /**
     * Dashboard del maestro
     */
    public function index()
    {
        return view('maestro.index');
    }

    /**
     * Vista del horario del maestro
     */
    public function horario()
    {
        $maestro = auth()->user();

        $grupos = Grupo::with('materia')
            ->where('maestro_id', $maestro->id)
            ->orderBy('hora_inicio')
            ->get();

        return view('maestro.horario', compact('grupos'));
    }

    /**
     * MOSTRAR LISTA DE GRUPOS PARA CALIFICACIONES
     * (Método que te faltaba)
     */
    public function indexCalificaciones()
    {
        $grupos = Grupo::with('materia')
            ->where('maestro_id', auth()->id())
            ->get();

        return view('maestro.calificaciones.index', compact('grupos'));
    }

    /**
     * Vista para tomar asistencias
     */
    public function asistencias($grupo_id)
    {
        $grupo = Grupo::with(['materia', 'alumnos'])
            ->where('id', $grupo_id)
            ->where('maestro_id', auth()->id())
            ->firstOrFail();

        $alumnos = $grupo->alumnos;

        return view('maestro.asistencias.tomar', compact('grupo', 'alumnos'));
    }

    /**
     * Registrar asistencias
     */
    public function registrarAsistencias(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'alumnos'  => 'required|array'
        ]);

        $grupo = Grupo::findOrFail($request->grupo_id);

        foreach ($request->alumnos as $alumno_id => $datos) {

            Asistencia::create([
                'grupo_id'   => $grupo->id,
                'materia_id' => $grupo->materia_id,
                'maestro_id' => auth()->id(),
                'alumno_id'  => $alumno_id,
                'estado'     => $datos['estado'] ?? 'presente',
                'observacion'=> $datos['observacion'] ?? null,
                'fecha'      => now()->format('Y-m-d'),
                'hora'       => now()->format('H:i:s'),
            ]);
        }

        return back()->with('success', 'Asistencias registradas correctamente');
    }

    /**
     * Vista de calificaciones finales
     */
    public function calificacionesFinales()
    {
        $maestro = auth()->user();

        $grupos = Grupo::with('materia')
            ->where('maestro_id', $maestro->id)
            ->get();

        return view('maestro.calificaciones_finales', compact('grupos'));
    }

    /**
     * Mostrar alumnos del grupo a calificar
     */
    public function calificarGrupo($grupo_id)
    {
        $grupo = Grupo::with(['materia', 'alumnos'])
            ->where('id', $grupo_id)
            ->where('maestro_id', auth()->id())
            ->firstOrFail();

        return view('maestro.calificaciones.calificar', compact('grupo'));
    }

    /**
     * Guardar calificaciones + créditos al maestro
     */
    public function guardarCalificaciones(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'calificaciones' => 'required|array'
        ]);

        $grupo = Grupo::with('materia')->findOrFail($request->grupo_id);
        $maestro = auth()->user();

        foreach ($request->calificaciones as $alumno_id => $nota) {

            $creditos = $nota >= 60 ? 2 : 1;

            HistorialAcademico::create([
                'alumno_id'         => $alumno_id,
                'maestro_id'        => $maestro->id,
                'materia_id'        => $grupo->materia_id,
                'calificacion'      => $nota,
                'creditos_otorgados'=> $creditos,
            ]);

            $maestro->increment('creditos', $creditos);
        }

        return back()->with('success', 'Calificaciones registradas y créditos asignados.');
    }

    /**
     * Lista de grupos para asistencias
     */
    public function listarGrupos()
    {
        $grupos = Grupo::where('maestro_id', auth()->id())->get();

        return view('maestro.asistencias.lista_grupos', compact('grupos'));
    }
}
