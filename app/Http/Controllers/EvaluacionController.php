<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;       // Para los maestros
use App\Models\Evaluacion; // Modelo que debes tener
use Illuminate\Support\Facades\Auth;

class EvaluacionController extends Controller
{
    // Listar maestros para evaluar
   public function index()
{
    $maestros = User::role('maestro')->get(); // solo los maestros
    return view('alumno.evaluaciones.index', compact('maestros'));
}

public function create(User $maestro)
{
    return view('alumno.evaluaciones.create', compact('maestro'));
}

public function store(Request $request, User $maestro)
{
    $request->validate([
        'puntualidad' => 'required|integer|min:1|max:5',
        'claridad' => 'required|integer|min:1|max:5',
        'paciencia' => 'required|integer|min:1|max:5',
        'dominio' => 'required|integer|min:1|max:5',
        'conocimiento' => 'required|integer|min:1|max:5',
        'dinamica' => 'required|integer|min:1|max:5',
        'comentario' => 'nullable|string',
    ]);

    Evaluacion::create([
        'alumno_id' => auth()->id(),
        'maestro_id' => $maestro->id,
        'puntualidad' => $request->puntualidad,
        'claridad' => $request->claridad,
        'paciencia' => $request->paciencia,
        'dominio' => $request->dominio,
        'conocimiento' => $request->conocimiento,
        'dinamica' => $request->dinamica,
        'comentario' => $request->comentario,
    ]);

    return redirect()->route('alumno.evaluaciones.index')->with('success', 'Evaluación enviada correctamente');
}
}