@extends('layouts.app')

@section('title', 'Maestro - Dashboard')

@section('nav')
<li class="nav-item">
    <a class="nav-link active" href="/maestro" aria-label="Ir al Dashboard">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/maestro/materias" aria-label="Ver Materias a Impartir">
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
                <i class="fas fa-chalkboard-teacher"></i> Bienvenido, Maestro
            </h2>
            <p class="lead text-muted">Accede rápidamente a tus materias y registra asistencias de manera sencilla.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card h-100 shadow-lg border-0 rounded-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <i class="fas fa-book fa-3x mb-3"></i>
                        <h5 class="card-title font-weight-bold">Materias a Impartir</h5>
                        <p class="card-text">Consulta las materias que impartirás este semestre y revisa detalles de tus grupos.</p>
                        <a href="/maestro/materias" class="btn btn-light btn-lg mt-auto" aria-label="Ir a Materias a Impartir">Ir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5">
                <div class="card h-100 shadow-lg border-0 rounded-lg" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <i class="fas fa-clipboard-check fa-3x mb-3"></i>
                        <h5 class="card-title font-weight-bold">Registrar Asistencias</h5>
                        <p class="card-text">Marca las asistencias de tus alumnos y lleva un control actualizado del grupo.</p>
                        <a href="/maestro/asistencias" class="btn btn-light btn-lg mt-auto" aria-label="Ir a Registrar Asistencias">Ir</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <p class="text-muted">¿Necesitas más herramientas? <a href="#" class="text-primary text-decoration-underline">Ver Reportes</a> para análisis detallados de tus grupos.</p>
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
