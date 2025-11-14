@extends('layouts.app')

@section('title', 'Materias a Impartir')

@section('nav')
<li class="nav-item">
    <a class="nav-link" href="/maestro" aria-label="Ir al Dashboard">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link active" href="/maestro/materias" aria-label="Materias a Impartir">
        <i class="fas fa-book"></i> Materias a Impartir
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/maestro/asistencias" aria-label="Registrar Asistencias">
        <i class="fas fa-clipboard-check"></i> Asistencias
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid py-5" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 80vh;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 text-primary font-weight-bold">
                <i class="fas fa-book-open"></i> Materias a Impartir
            </h2>
            <p class="lead text-muted">Estas son las materias que impartirás este semestre junto con sus horarios.</p>
        </div>

        <div class="row g-4">
            @php
                $materias = [
                    ['nombre' => 'Cálculo Integral', 'horario' => 'Lunes a Jueves 6:00 PM - 7:00 PM'],
                    ['nombre' => 'Programación Avanzada', 'horario' => 'Lunes a Jueves 7:00 PM - 8:00 PM'],
                    ['nombre' => 'Estructura de Datos', 'horario' => 'Martes y Jueves 5:00 PM - 6:00 PM'],
                    ['nombre' => 'Plataforma de Desarrollo en la Nube', 'horario' => 'Lunes y Miércoles 6:00 PM - 7:00 PM'],
                    ['nombre' => 'Bases de Datos', 'horario' => 'Martes y Jueves 6:00 PM - 7:00 PM'],
                ];
            @endphp

            @foreach($materias as $materia)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-lg border-0 rounded-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h5 class="card-title font-weight-bold">
                                <i class="fas fa-book"></i> {{ $materia['nombre'] }}
                            </h5>
                            <p class="card-text mt-2"><i class="fas fa-clock"></i> {{ $materia['horario'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="/maestro" class="btn btn-outline-primary btn-lg" aria-label="Volver al Dashboard">
                <i class="fas fa-arrow-left"></i> Volver al Dashboard
            </a>
        </div>
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }
    .card-title {
        font-size: 1.25rem;
    }
    .card-text {
        font-size: 1rem;
    }
</style>
@endsection
