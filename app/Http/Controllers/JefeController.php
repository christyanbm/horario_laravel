<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JefeController extends Controller
{
    public function index()
    {
        return view('jefe.index'); // Dashboard
    }

    public function grupos()
    {
        return view('jefe.grupos'); // Tabla de grupos
    }

    public function reportes()
    {
        // Datos simulados para prototipo
        $alumnos = [
            (object)[
                'name' => 'Juan Pérez',
                'carrera' => 'Ingeniería',
                'inasistencias' => 3,
                'promedio' => 8.5
            ],
            (object)[
                'name' => 'Ana Gómez',
                'carrera' => 'Ingeniería',
                'inasistencias' => 6,
                'promedio' => 7.8
            ],
            (object)[
                'name' => 'Luis Torres',
                'carrera' => 'Medicina',
                'inasistencias' => 2,
                'promedio' => 9.2
            ],
            (object)[
                'name' => 'María López',
                'carrera' => 'Derecho',
                'inasistencias' => 4,
                'promedio' => 8.0
            ],
        ];

        // Preparar datos agregados por carrera
        $carreras = collect($alumnos)->pluck('carrera')->unique();
        $inasistenciasPorCarrera = $carreras->map(function($carrera) use ($alumnos) {
            return collect($alumnos)->where('carrera', $carrera)->sum('inasistencias');
        });
        $promedioPorCarrera = $carreras->map(function($carrera) use ($alumnos) {
            return collect($alumnos)->where('carrera', $carrera)->avg('promedio');
        });

        return view('jefe.reportes', compact(
            'alumnos',
            'carreras',
            'inasistenciasPorCarrera',
            'promedioPorCarrera'
        ));
    }
}
