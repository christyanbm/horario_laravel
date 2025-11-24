<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    // Dashboard
    public function index()
    {
        return view('alumno.index');
    }

    // Selección de horario
    public function seleccionarHorario()
    {
        return view('alumno.horario');
    }

    // Progreso del alumno
    public function progreso()
    {
        return view('alumno.progreso');
    }

    // Materias del alumno (ejemplo)
    public function materias()
    {
        return view('alumno.materias');
    }
}
