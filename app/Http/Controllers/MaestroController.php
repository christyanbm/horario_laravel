<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Clase;
use App\Models\Asistencia;
use App\Models\Calificacion;
use App\Models\Materia;
use App\Models\Grupo;

class MaestroController extends Controller
{
    /**
     * Dashboard del maestro
     */
    public function index()
    {
        return view('maestro.index'); // Sin variables
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
     * Vista de asistencias del maestro (requiere grupo)
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
     * Registrar asistencias de un grupo
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
    public function listarGrupos()
{
    $maestro = auth()->user();

    $grupos = Grupo::where('maestro_id', $maestro->id)->get();

    return view('maestro.asistencias.lista_grupos', compact('grupos'));
}

}
