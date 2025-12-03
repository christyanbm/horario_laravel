<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\User;
use App\Models\Materia;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        $grupos = Grupo::with(['maestro', 'materia'])->get();
        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
        $maestros = User::role('maestro')->get();
        $materias = Materia::all();
        return view('grupos.create', compact('maestros', 'materias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cupo_max' => 'required|integer',

            // ❌ ELIMINADO: 'carrera'
            
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'maestro_id' => 'nullable|exists:users,id',
            'materia_id' => 'required|exists:materias,id',
        ]);

        Grupo::create($request->all());

        return redirect()->route('jefe.grupos.index')
            ->with('success', 'Grupo creado correctamente');
    }

    public function edit(Grupo $grupo)
    {
        $maestros = User::role('maestro')->get();
        $materias = Materia::all();
        return view('grupos.edit', compact('grupo', 'maestros', 'materias'));
    }

    public function update(Request $request, Grupo $grupo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cupo_max' => 'required|integer',

            
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'maestro_id' => 'nullable|exists:users,id',
            'materia_id' => 'required|exists:materias,id',
        ]);

        $grupo->update($request->all());

        return redirect()->route('jefe.grupos.index')
            ->with('success', 'Grupo actualizado correctamente');
    }

    public function destroy(Grupo $grupo)
    {
        $grupo->delete();

        return redirect()->route('jefe.grupos.index')
            ->with('success', 'Grupo eliminado correctamente');
    }
}
