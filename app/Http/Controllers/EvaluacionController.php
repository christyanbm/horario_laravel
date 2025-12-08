<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;       // Para los maestros
use App\Models\Evaluacion; // Modelo de evaluaciones
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EvaluacionController extends Controller
{
    // Mostrar maestros disponibles para evaluar
 public function index()
{
    $alumno = auth()->user();

    // Obtener maestros de los grupos donde el alumno está inscrito
   $maestros = User::role('maestro')
    ->whereHas('gruposMaestro', function($query) use ($alumno) {
        $query->whereHas('alumnos', function($q) use ($alumno) {
            $q->where('users.id', $alumno->id);
        });
    })
    ->with(['evaluaciones' => function($q) use ($alumno) {
        $q->where('alumno_id', $alumno->id);
    }])
    ->get();


    return view('alumno.evaluaciones.index', compact('maestros'));
}

    // Formulario para evaluar un maestro
    public function create(User $maestro)
    {
        $alumno = auth()->user();

        // Verificar si ya evaluó a este maestro
        $yaEvaluado = Evaluacion::where('alumno_id', $alumno->id)
                                 ->where('maestro_id', $maestro->id)
                                 ->exists();

        if ($yaEvaluado) {
            return redirect()->route('alumno.evaluaciones.index')
                             ->with('warning', 'Este maestro ya ha sido evaluado');
        }

        return view('alumno.evaluaciones.create', compact('maestro'));
    }

    // Guardar evaluación
    public function store(Request $request, User $maestro)
    {
        $request->validate([
            'puntualidad'   => 'required|integer|min:1|max:5',
            'claridad'      => 'required|integer|min:1|max:5',
            'paciencia'     => 'required|integer|min:1|max:5',
            'dominio'       => 'required|integer|min:1|max:5',
            'conocimiento'  => 'required|integer|min:1|max:5',
            'dinamica'      => 'required|integer|min:1|max:5',
            'comentario'    => 'nullable|string',
        ]);

        $alumno = auth()->user();

        // Evitar evaluaciones duplicadas
        $yaEvaluado = Evaluacion::where('alumno_id', $alumno->id)
                                 ->where('maestro_id', $maestro->id)
                                 ->exists();

        if ($yaEvaluado) {
            return redirect()->route('alumno.evaluaciones.index')
                             ->with('warning', 'Este maestro ya ha sido evaluado');
        }

        Evaluacion::create([
            'alumno_id'     => $alumno->id,
            'maestro_id'    => $maestro->id,
            'puntualidad'   => $request->puntualidad,
            'claridad'      => $request->claridad,
            'paciencia'     => $request->paciencia,
            'dominio'       => $request->dominio,
            'conocimiento'  => $request->conocimiento,
            'dinamica'      => $request->dinamica,
            'comentario'    => $request->comentario,
        ]);

        return redirect()->route('alumno.evaluaciones.index')
                         ->with('success', 'Evaluación enviada correctamente');
    }

    // Mostrar todas las evaluaciones que el alumno ha hecho
    public function misEvaluaciones()
    {
        $alumno = auth()->user();

        $evaluaciones = Evaluacion::where('alumno_id', $alumno->id)
                                   ->with('maestro')
                                   ->get();

        return view('alumno.evaluaciones.mis_evaluaciones', compact('evaluaciones'));
    }
}
