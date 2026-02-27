<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\HistorialAcademico;
class CoordinadorController extends Controller
{
    public function index()
    {
        return view('coordinador.index'); 
    }
public function horarios()
{
   
    $grupos = Grupo::with(['materia', 'maestro', 'alumnos'])->get();

    
    $alumnoIds = $grupos->pluck('alumnos.*.id')->flatten()->unique();
    $materiaIds = $grupos->pluck('materia_id')->unique();

   
    $calificaciones = HistorialAcademico::whereIn('alumno_id', $alumnoIds)
                        ->whereIn('materia_id', $materiaIds)
                        ->get()
                        ->keyBy(function($item) {
                            return $item->alumno_id . '_' . $item->materia_id;
                        });

    // Asignar calificación a cada alumno de cada grupo
    foreach ($grupos as $grupo) {
        foreach ($grupo->alumnos as $alumno) {
            $key = $alumno->id . '_' . $grupo->materia_id;
            $alumno->calificacion = $calificaciones[$key]->calificacion ?? null;
        }
    }

   
    $materias = Materia::all();

    return view('coordinador.horarios', compact('grupos', 'materias'));
}


   

   // =========================================
//   ALUMNOS (COORDINADOR)
// =========================================


public function alumnosIndex()
{
    $alumnos = User::role('Alumno')->get(); 
    return view('coordinador.alumnos.index', compact('alumnos'));
}

/** Mostrar formulario para crear alumno */
public function alumnosCreate()
{
    return view('coordinador.alumnos.create');
}

/** Guardar un nuevo alumno */
public function alumnosStore(Request $request)
{
    $request->validate([
        'name'      => 'required|string|max:255',
        'email'     => 'required|email|unique:users,email',
        'password'  => 'required|confirmed|min:8',
        'matricula' => 'required|string|unique:users,matricula',
    ]);

    // Datos base del alumno
    $data = [
        'name'      => $request->name,
        'email'     => $request->email,
        'password'  => Hash::make($request->password),
        'matricula' => $request->matricula,
        'creditos'  => 30, // igual que el admin
    ];

    $alumno = User::create($data);

    // Asignar el rol de Alumno
    $alumno->assignRole('Alumno');
if ($request->role === 'Alumno') {
    $userData['matricula'] = $request->matricula;
    $userData['creditos'] = 30;
}
    return redirect()
        ->route('coordinador.alumnos.index')
        ->with('success', 'Alumno creado correctamente.');
}

/** Formulario de edición */
public function alumnosEdit($id)
{
    $alumno = User::role('Alumno')->findOrFail($id);
    return view('coordinador.alumnos.edit', compact('alumno'));
}

/** Guardar cambios */
public function alumnosUpdate(Request $request, $id)
{
    $alumno = User::role('Alumno')->findOrFail($id);

    $request->validate([
        'name'      => 'required|string|max:255',
        'email'     => "required|email|unique:users,email,{$alumno->id}",
        'matricula' => "required|string|unique:users,matricula,{$alumno->id}",
    ]);

    $alumno->name = $request->name;
    $alumno->email = $request->email;
    $alumno->matricula = $request->matricula;

    if ($request->filled('password')) {
        $request->validate([
            'password' => 'confirmed|min:8',
        ]);
        $alumno->password = Hash::make($request->password);
    }

    $alumno->save();

    return redirect()
        ->route('coordinador.alumnos.index')
        ->with('success', 'Alumno actualizado correctamente.');
}

/** Eliminar alumno */
public function alumnosDestroy($id)
{
    $alumno = User::role('Alumno')->findOrFail($id);
    $alumno->delete();

    return redirect()
        ->route('coordinador.alumnos.index')
        ->with('success', 'Alumno eliminado correctamente.');
}

  // =========================================
//   GRUPOS (COORDINADOR)
// =========================================

/** LISTAR GRUPOS */
public function gruposIndex()
{
    $grupos = Grupo::with('materia', 'maestro')->get();
    return view('coordinador.grupos.index', compact('grupos'));
}

/** FORMULARIO CREAR GRUPO */
public function gruposCreate()
{
    $materias = Materia::all();
    $maestros = User::role('maestro')->get();
    return view('coordinador.grupos.create', compact('materias', 'maestros'));
}

/** GUARDAR GRUPO */
public function gruposStore(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'cupo_max' => 'required|integer|min:1',
        'materia_id' => 'required|exists:materias,id',
        'hora_inicio' => 'required',
        'hora_fin' => 'required',
        'maestro_id' => 'nullable|exists:users,id',
    ]);

    Grupo::create([
        'nombre' => $request->nombre,
        'cupo_max' => $request->cupo_max,
        'materia_id' => $request->materia_id,
        'hora_inicio' => $request->hora_inicio,
        'hora_fin' => $request->hora_fin,
        'maestro_id' => $request->maestro_id,
    ]);

    return redirect()
        ->route('coordinador.grupos.index')
        ->with('success', 'Grupo creado correctamente.');
}

/** FORMULARIO EDITAR GRUPO */
public function gruposEdit($id)
{
    $grupo = Grupo::findOrFail($id);
    $materias = Materia::all();
    $maestros = User::role('maestro')->get();

    return view('coordinador.grupos.edit', compact('grupo', 'materias', 'maestros'));
}

/** ACTUALIZAR GRUPO */
public function gruposUpdate(Request $request, $id)
{
    $grupo = Grupo::findOrFail($id);

    $request->validate([
        'nombre' => 'required|string|max:255',
        'cupo_max' => 'required|integer|min:1',
        'materia_id' => 'required|exists:materias,id',
        'hora_inicio' => 'required',
        'hora_fin' => 'required',
        'maestro_id' => 'nullable|exists:users,id',
    ]);

    $grupo->update([
        'nombre' => $request->nombre,
        'cupo_max' => $request->cupo_max,
        'materia_id' => $request->materia_id,
        'hora_inicio' => $request->hora_inicio,
        'hora_fin' => $request->hora_fin,
        'maestro_id' => $request->maestro_id,
    ]);

    return redirect()
        ->route('coordinador.grupos.index')
        ->with('success', 'Grupo actualizado correctamente.');
}

/** ELIMINAR GRUPO */
public function gruposDestroy($id)
{
    $grupo = Grupo::findOrFail($id);
    $grupo->delete();

    return redirect()
        ->route('coordinador.grupos.index')
        ->with('success', 'Grupo eliminado correctamente.');
}
/** Mostrar alumnos de un grupo */
public function alumnosGrupo($grupo_id)
{
    $grupo = Grupo::with('alumnos', 'materia')->findOrFail($grupo_id);
    return view('coordinador.grupos.alumnos', compact('grupo'));
}

public function agregarAlumno(Request $request, $grupo_id)
{
    $request->validate([
        'alumno_id' => 'required|exists:users,id',
    ]);

    $grupo = Grupo::findOrFail($grupo_id);

    // 1. Verificar si el alumno ya está en el grupo
    if ($grupo->alumnos->contains($request->alumno_id)) {
        return back()->with('warning', 'El alumno ya está en este grupo.');
    }

    // 2. Verificar si el alumno ya acreditó la materia
    $yaAcredito = HistorialAcademico::where('alumno_id', $request->alumno_id)
                    ->where('materia_id', $grupo->materia_id)
                    ->where('calificacion', '>=', 70) // regla de acreditación
                    ->exists();

    if ($yaAcredito) {
        return back()->with('warning', 'Este alumno no se puede agregar porque ya acreditó esta materia.');
    }

    // 3. Agregar alumno al grupo
    $grupo->alumnos()->attach($request->alumno_id);

    return back()->with('success', 'Alumno agregado correctamente.');
}


/** Eliminar alumno de un grupo */
public function eliminarAlumno($grupo_id, $alumno_id)
{
    $grupo = Grupo::findOrFail($grupo_id);
    $grupo->alumnos()->detach($alumno_id);

    return back()->with('success', 'Alumno eliminado correctamente.');
}
public function removeAlumno($grupo_id, $alumno_id)
{
    $grupo = Grupo::findOrFail($grupo_id);

    // Desvincular alumno del grupo (tabla pivot grupo_user)
    $grupo->alumnos()->detach($alumno_id);

    return back()->with('success', 'Alumno eliminado del grupo correctamente.');
}


}
