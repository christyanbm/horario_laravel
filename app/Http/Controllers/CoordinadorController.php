<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordinadorController extends Controller
{
    public function index()
    {
        return view('coordinador.index'); // Dashboard
    }

    public function horarios()
    {
        return view('coordinador.horarios'); // Gestión de horarios
    }

    public function asignaciones()
    {
        return view('coordinador.asignaciones'); // Asignación de materias/docentes
    }
}
