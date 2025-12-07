<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grupo;
use App\Models\Materia;
use Illuminate\Support\Facades\Hash;
use App\Models\Asistencia;
use App\Models\HistorialAcademico;
class JefeController extends Controller
{
    // ========================
    //      DASHBOARD
    // ========================

    public function index()
    {
        return view('jefe.index');
    }

    public function grupos()
    {
        $grupos = Grupo::with(['materia', 'maestro'])
                       ->orderBy('materia_id')
                       ->get();

        return view('jefe.grupos', compact('grupos'));
    }

public function reportes()
{
    // Traer todos los alumnos con sus grupos, asistencias y calificaciones
    $alumnos = User::role('alumno')
                   ->with(['grupos', 'asistencias', 'calificaciones'])
                   ->get();

    // Mapear cada alumno para generar los datos del reporte
    $alumnosReporte = $alumnos->map(function($alumno) {

        $totalAsistencias = $alumno->asistencias->where('estado', 'presente')->count();
        $totalInasistencias = $alumno->asistencias->where('estado', 'ausente')->count();
        $totalJustificados = $alumno->asistencias->where('estado', 'justificado')->count();

        $promedio = $alumno->calificaciones->avg('calificacion') ?? 0;

        return (object)[
            'id' => $alumno->id,
            'name' => $alumno->name,
            'carrera' => $alumno->grupos->first()->carrera ?? 'Ingenieria en Sistemas Computacionales',
            'inasistencias' => $totalInasistencias,
            'asistencias' => $totalAsistencias,
            'justificados' => $totalJustificados,
            'promedio' => round($promedio, 2)
        ];
    });

    // Resumen por carrera
    $carreras = $alumnosReporte->pluck('carrera')->unique();

    $inasistenciasPorCarrera = $carreras->map(fn($carrera) =>
        $alumnosReporte->where('carrera', $carrera)->sum('inasistencias')
    );

    $promedioPorCarrera = $carreras->map(fn($carrera) =>
        $alumnosReporte->where('carrera', $carrera)->avg('promedio')
    );

    // Retornar la vista con los datos listos
    return view('jefe.reportes', [
        'alumnos' => $alumnosReporte,
        'carreras' => $carreras,
        'inasistenciasPorCarrera' => $inasistenciasPorCarrera,
        'promedioPorCarrera' => $promedioPorCarrera
    ]);
}


    // ========================
    //      CRUD DE ALUMNOS
    // ========================

    public function alumnosIndex()
    {
        $alumnos = User::role('alumno')->get();
        return view('jefe.alumnos.index', compact('alumnos'));
    }

    public function alumnosCreate()
    {
        return view('jefe.alumnos.create');
    }

public function alumnosStore(Request $request)
{
    $request->validate([
        'matricula' => 'required|string|unique:users,matricula',
        'name'      => 'required|string|max:255',
        'email'     => 'required|email|unique:users,email',
        'password'  => 'required|confirmed|min:6',
    ]);

    $alumno = User::create([
        'matricula' => $request->matricula,
        'name'      => $request->name,
        'email'     => $request->email,
        'password'  => Hash::make($request->password),
        'creditos'  => 30, // Se asignan 30 créditos al crear
    ]);

    $alumno->assignRole('alumno');

    return redirect()->route('jefe.alumnos.index')
                     ->with('success', 'Alumno creado correctamente con 30 créditos.');
}


    public function alumnosEdit($id)
    {
        $alumno = User::role('alumno')->findOrFail($id);
        return view('jefe.alumnos.edit', compact('alumno'));
    }

    public function alumnosUpdate(Request $request, $id)
    {
        $alumno = User::role('alumno')->findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$alumno->id}",
        ]);

        $alumno->name = $request->name;
        $alumno->email = $request->email;

        if ($request->filled('password')) {
            $request->validate([ 'password' => 'confirmed|min:6' ]);
            $alumno->password = Hash::make($request->password);
        }

        $alumno->save();

        return redirect()->route('jefe.alumnos.index')
                         ->with('success', 'Alumno actualizado correctamente.');
    }

    public function alumnosDestroy($id)
    {
        $alumno = User::role('alumno')->findOrFail($id);
        $alumno->delete();

        return redirect()->route('jefe.alumnos.index')
                         ->with('success', 'Alumno eliminado correctamente.');
    }

    // ========================
    //      CRUD DE MAESTROS
    // ========================

    public function maestrosIndex()
    {
        $maestros = User::role('maestro')->get();
        return view('jefe.maestros.index', compact('maestros'));
    }

    public function maestrosCreate()
    {
        return view('jefe.maestros.create');
    }

    public function maestrosStore(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $maestro = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $maestro->assignRole('maestro');

        return redirect()->route('jefe.maestros.index')
                         ->with('success', 'Maestro creado correctamente.');
    }

    public function maestrosEdit($id)
    {
        $maestro = User::role('maestro')->findOrFail($id);
        return view('jefe.maestros.edit', compact('maestro'));
    }

    public function maestrosUpdate(Request $request, $id)
    {
        $maestro = User::role('maestro')->findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$maestro->id}",
        ]);

        $maestro->name  = $request->name;
        $maestro->email = $request->email;

        if ($request->filled('password')) {
            $request->validate(['password' => 'confirmed|min:6']);
            $maestro->password = Hash::make($request->password);
        }

        $maestro->save();

        return redirect()->route('jefe.maestros.index')
                         ->with('success', 'Maestro actualizado correctamente.');
    }

    public function maestrosDestroy($id)
    {
        $maestro = User::role('maestro')->findOrFail($id);
        $maestro->delete();

        return redirect()->route('jefe.maestros.index')
                         ->with('success', 'Maestro eliminado correctamente.');
    }

    // ========================
    //   ASIGNAR MAESTRO A GRUPO
    // ========================

public function asignarMaestroForm()
{
    $grupos = Grupo::with(['materia', 'maestro'])->get();
    $maestros = User::role('maestro')->get();

    $conflictos = [];

    foreach ($grupos as $grupo) {
        if (!$grupo->maestro_id) continue;

        foreach ($grupos as $otro) {
            if ($grupo->id == $otro->id || !$otro->maestro_id) continue;
            if ($grupo->maestro_id != $otro->maestro_id) continue;

            // Detecta solapamiento
            if ($grupo->hora_inicio < $otro->hora_fin && $grupo->hora_fin > $otro->hora_inicio) {
                $conflictos[$grupo->id][] = $otro->id;
            }
        }
    }

    return view('jefe.asignaciones', compact('grupos', 'maestros', 'conflictos'));
}



public function asignarMaestroStore(Request $request)
{
    $request->validate([
        'maestro_id' => 'required|array',
        'maestro_id.*' => 'nullable|exists:users,id',
    ]);

    $conflictos = [];

    foreach ($request->maestro_id as $grupoId => $maestroId) {
        $grupo = Grupo::find($grupoId);
        if ($grupo && $maestroId) {
            // Revisar conflicto de horario
            $conflicto = Grupo::where('maestro_id', $maestroId)
                ->where('id', '<>', $grupo->id)
                ->where(function($q) use ($grupo) {
                    $q->whereBetween('hora_inicio', [$grupo->hora_inicio, $grupo->hora_fin])
                      ->orWhereBetween('hora_fin', [$grupo->hora_inicio, $grupo->hora_fin])
                      ->orWhere(function($q2) use ($grupo) {
                          $q2->where('hora_inicio', '<=', $grupo->hora_inicio)
                             ->where('hora_fin', '>=', $grupo->hora_fin);
                      });
                })
                ->exists();

            if ($conflicto) {
                $conflictos[] = "El maestro asignado al grupo {$grupo->nombre} ya tiene otra clase en ese horario.";
            } else {
                $grupo->maestro_id = $maestroId;
                $grupo->save();
            }
        }
    }

    if (!empty($conflictos)) {
        return redirect()->back()->with('error', implode('<br>', $conflictos));
    }

    return redirect()->route('jefe.asignaciones')
                     ->with('success', 'Asignaciones de maestros actualizadas correctamente.');
}

}
