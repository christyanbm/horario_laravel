<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Grupo;
use App\Models\User;

class AsistenciaController extends Controller
{
    public function tomar($grupo_id)
    {
        $grupo = Grupo::with('materia', 'maestro')->findOrFail($grupo_id);

        $alumnos = User::where('role', 'alumno')
                        ->where('grupo_id', $grupo_id)
                        ->get();

        return view('maestro.asistencias.tomar', compact('grupo', 'alumnos'));
    }

    public function registrar(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'materia_id' => 'required|exists:materias,id',
            'maestro_id' => 'required|exists:users,id',
            'alumnos' => 'required|array',
        ]);

        foreach ($request->alumnos as $alumno_id => $datos) {

            Asistencia::create([
                'alumno_id'  => $alumno_id,
                'grupo_id'   => $request->grupo_id,
                'materia_id' => $request->materia_id,
                'maestro_id' => $request->maestro_id,
                'fecha'      => now()->toDateString(),
                'hora'       => now()->toTimeString(),
                'estado'     => $datos['estado'],
                'observacion'=> $datos['observacion'] ?? null,
            ]);
        }

        return redirect()->back()->with('success', 'Asistencias registradas correctamente.');
    }
}
