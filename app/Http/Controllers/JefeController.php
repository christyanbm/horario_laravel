<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grupo;
use App\Models\Materia;
use Illuminate\Support\Facades\Hash;

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
        // Datos simulados
        $alumnos = [
            (object)[ 'name' => 'Juan Pérez', 'carrera' => 'Ingeniería', 'inasistencias' => 3, 'promedio' => 8.5 ],
            (object)[ 'name' => 'Ana Gómez', 'carrera' => 'Ingeniería', 'inasistencias' => 6, 'promedio' => 7.8 ],
            (object)[ 'name' => 'Luis Torres', 'carrera' => 'Medicina', 'inasistencias' => 2, 'promedio' => 9.2 ],
            (object)[ 'name' => 'María López', 'carrera' => 'Derecho', 'inasistencias' => 4, 'promedio' => 8.0 ],
        ];

        $carreras = collect($alumnos)->pluck('carrera')->unique();

        $inasistenciasPorCarrera = $carreras->map(fn($carrera) =>
            collect($alumnos)->where('carrera', $carrera)->sum('inasistencias')
        );

        $promedioPorCarrera = $carreras->map(fn($carrera) =>
            collect($alumnos)->where('carrera', $carrera)->avg('promedio')
        );

        return view('jefe.reportes', compact(
            'alumnos',
            'carreras',
            'inasistenciasPorCarrera',
            'promedioPorCarrera'
        ));
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
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $alumno = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $alumno->assignRole('alumno');

        return redirect()->route('jefe.alumnos.index')
                         ->with('success', 'Alumno creado correctamente.');
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
    // Trae todos los grupos con su materia y maestro asignado (si lo hay)
    $grupos = Grupo::with(['materia', 'maestro'])->get();

    // Trae todos los maestros
    $maestros = User::role('maestro')->get();

    return view('jefe.asignaciones', compact('grupos', 'maestros'));
}

public function asignarMaestroStore(Request $request)
{
    $request->validate([
        'maestro_id' => 'required|array', // debe ser un array de maestro_id por grupo
        'maestro_id.*' => 'nullable|exists:users,id',
    ]);

    foreach ($request->maestro_id as $grupoId => $maestroId) {
        $grupo = Grupo::find($grupoId);
        if ($grupo) {
            $grupo->maestro_id = $maestroId; // puede ser null para desasignar
            $grupo->save();
        }
    }

    return redirect()->route('jefe.asignaciones')
                     ->with('success', 'Asignaciones de maestros actualizadas correctamente.');
}

}
