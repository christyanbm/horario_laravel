@extends('layouts.app')

@section('title', 'Coordinador - Dashboard')

@section('nav')
<li class="nav-item">
    <a class="nav-link active" href="/coordinador" aria-label="Ir al Dashboard">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/coordinador/asignar_materias" aria-label="Asignar Materias a Alumnos">
        <i class="fas fa-user-graduate"></i> Asignar Materias a Alumnos
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/coordinador/asignar_materias_maestros" aria-label="Asignar Materias a Maestros">
        <i class="fas fa-chalkboard-teacher"></i> Asignar Materias a Maestros
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid py-5" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 80vh;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 text-primary font-weight-bold">
                <i class="fas fa-user-tie"></i> Bienvenido, Coordinador
            </h2>
            <p class="lead text-muted">Administra asignaciones de materias y supervisa el progreso académico. ¡Tu rol es clave para el éxito estudiantil!</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card h-100 shadow-lg border-0 rounded-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <i class="fas fa-user-graduate fa-3x mb-3"></i>
                        <h5 class="card-title font-weight-bold">Asignar Materias a Alumnos</h5>
                        <p class="card-text">Asigna las materias correspondientes a cada alumno según su plan de estudios y elegibilidad.</p>
                        <a href="/coordinador/asignar_materias" class="btn btn-light btn-lg mt-auto" aria-label="Ir a Asignar Materias a Alumnos">Ir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-5">
                <div class="card h-100 shadow-lg border-0 rounded-lg" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <i class="fas fa-chalkboard-teacher fa-3x mb-3"></i>
                        <h5 class="card-title font-weight-bold">Asignar Materias a Maestros</h5>
                        <p class="card-text">Asigna materias a los maestros que las impartirán, asegurando una distribución equilibrada.</p>
                        <a href="/coordinador/asignar_materias_maestros" class="btn btn-light btn-lg mt-auto" aria-label="Ir a Asignar Materias a Maestros">Ir</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <p class="text-muted">¿Necesitas más herramientas? <a href="#" class="text-primary text-decoration-underline">Ver Reportes</a> para análisis detallados.</p>
        </div>
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }
</style>
@endsection