<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Asegúrate de tener tus modelos
use App\Models\Alumno;
use App\Models\Clase;
use App\Models\Asistencia;
use App\Models\Calificacion;
use App\Models\Materia;

class MaestroController extends Controller
{
    // Dashboard del maestro
  public function index() {
    return view('maestro.index'); // Dashboard
}

}