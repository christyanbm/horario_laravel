<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CoordinadorController extends Controller
{
    public function index()
    {
        return view('coordinador.index'); 
    }

    public function horarios()
    {
        return view('coordinador.horarios');
    }

  public function asignaciones()
{
    $grupos = \App\Models\Grupo::with('materia', 'maestro')->get();
    $maestros = User::role('maestro')->get();
    $materias = \App\Models\Materia::all();

    return view('coordinador.asignaciones', compact('grupos', 'maestros', 'materias'));
}


    // =========================================
    //   ALUMNOS
    // =========================================

    /** Mostrar lista de alumnos */
    public function alumnosIndex()
    {
        $alumnos = User::role('alumno')->get(); // ✔ CORRECTO
        return view('coordinador.alumnos.index', compact('alumnos'));
    }

    /** Mostrar formulario para crear */
    public function alumnosCreate()
    {
        return view('coordinador.alumnos.create');
    }

    /** Guardar un nuevo alumno */
    public function alumnosStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $alumno = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 👉 ASIGNAR ROL CON SPATIE
        $alumno->assignRole('alumno');

        return redirect()
            ->route('coordinador.alumnos.index')
            ->with('success', 'Alumno creado correctamente.');
    }

    /** Formulario de edición */
    public function alumnosEdit($id)
    {
        $alumno = User::role('alumno')->findOrFail($id); // ✔
        return view('coordinador.alumnos.edit', compact('alumno'));
    }

    /** Guardar cambios */
    public function alumnosUpdate(Request $request, $id)
    {
        $alumno = User::role('alumno')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$alumno->id}",
        ]);

        $alumno->name = $request->name;
        $alumno->email = $request->email;

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'confirmed|min:6',
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
        $alumno = User::role('alumno')->findOrFail($id);
        $alumno->delete();

        return redirect()
            ->route('coordinador.alumnos.index')
            ->with('success', 'Alumno eliminado correctamente.');
    }
  public function asignacionesGuardar(Request $request)
{
    $data = $request->maestro_id; // array: [grupo_id => maestro_id]

    foreach ($data as $grupoId => $maestroId) {
        if (!empty($maestroId)) {
            \App\Models\Grupo::where('id', $grupoId)->update([
                'maestro_id' => $maestroId
            ]);
        }
    }

    return redirect()
        ->route('coordinador.asignaciones')
        ->with('success', 'Asignaciones guardadas correctamente.');
}

}
