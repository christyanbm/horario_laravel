<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\User;
use App\Models\Materia;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    // =====================
    // COORDINADOR
    // =====================

    public function index()
    {
        // Coordinador ve todos los grupos
        $grupos = Grupo::with(['maestro', 'materia'])->get();
        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
      
        $materias = Materia::all();
        return view('grupos.create', compact('materias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cupo_max' => 'required|integer',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'materia_id' => 'required|exists:materias,id',
        ]);

        
        Grupo::create([
            'nombre' => $request->nombre,
            'cupo_max' => $request->cupo_max,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'materia_id' => $request->materia_id,
            'maestro_id' => null
        ]);

        return redirect()->route('grupos.index')
            ->with('success', 'Grupo creado correctamente por el coordinador.');
    }

    public function edit(Grupo $grupo)
    {
      
        $materias = Materia::all();
        return view('grupos.edit', compact('grupo', 'materias'));
    }

    public function update(Request $request, Grupo $grupo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cupo_max' => 'required|integer',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'materia_id' => 'required|exists:materias,id',
        ]);

        $grupo->update($request->only(
            'nombre', 'cupo_max', 'hora_inicio', 'hora_fin', 'materia_id'
        ));

        return redirect()->route('grupos.index')
            ->with('success', 'Grupo actualizado correctamente.');
    }

    public function destroy(Grupo $grupo)
    {
        $grupo->delete();

        return redirect()->route('grupos.index')
            ->with('success', 'Grupo eliminado correctamente.');
    }


    // =====================
    // JEFE DE CARRERA
    // =====================

    public function asignarMaestroForm($id)
    {
        $grupo = Grupo::findOrFail($id);
        $maestros = User::role('maestro')->get();

        return view('jefe.grupos.asignar', compact('grupo', 'maestros'));
    }

    public function asignarMaestro(Request $request, $id)
    {
        $request->validate([
            'maestro_id' => 'required|exists:users,id'
        ]);

        $grupo = Grupo::findOrFail($id);
        $grupo->maestro_id = $request->maestro_id;
        $grupo->save();

        return redirect()->route('jefe.grupos.index')
            ->with('success', 'Maestro asignado correctamente.');
    }
}
