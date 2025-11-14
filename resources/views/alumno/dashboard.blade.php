@extends('layouts.app')

@section('title', 'Alumno - Dashboard')

@section('nav')
<li class="nav-item">
    <a class="nav-link active" href="/alumno" aria-label="Ir al Dashboard">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/alumno/elegir_materias" aria-label="Elegir Materias">
        <i class="fas fa-book-open"></i> Elegir Materias
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/alumno/promedios" aria-label="Ver Promedios">
        <i class="fas fa-chart-line"></i> Promedios
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/alumno/materias_semestre" aria-label="Ver Materias del Semestre">
        <i class="fas fa-calendar-alt"></i> Materias del Semestre
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid py-5" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 80vh;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 text-primary font-weight-bold">Bienvenido, Alumno</h2>
            <p class="lead text-muted">Selecciona una opción del menú para gestionar tus materias y calificaciones. ¡Tu progreso académico te espera!</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card h-100 shadow-lg border-0 rounded-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <i class="fas fa-book-open fa-3x mb-3"></i>
                        <h5 class="card-title font-weight-bold">Elegir Materias</h5>
                        <p class="card-text">Selecciona las materias que deseas cursar este semestre y personaliza tu plan de estudios.</p>
                        <a href="/alumno/elegir_materias" class="btn btn-light btn-lg mt-auto" aria-label="Ir a Elegir Materias">Ir</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card h-100 shadow-lg border-0 rounded-lg" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <i class="fas fa-chart-line fa-3x mb-3"></i>
                        <h5 class="card-title font-weight-bold">Promedios</h5>
                        <p class="card-text">Consulta tus calificaciones de semestres anteriores y analiza tu rendimiento académico.</p>
                        <a href="/alumno/promedios" class="btn btn-light btn-lg mt-auto" aria-label="Ver Promedios">Ver</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card h-100 shadow-lg border-0 rounded-lg" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                        <h5 class="card-title font-weight-bold">Materias del Semestre</h5>
                        <p class="card-text">Revisa las materias que cursarás este semestre y manténte al día con tu horario.</p>
                        <a href="/alumno/materias_semestre" class="btn btn-light btn-lg mt-auto" aria-label="Ver Materias del Semestre">Ver</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <p class="text-muted">¿Necesitas ayuda? Contacta a tu asesor académico.</p>
        </div>
    </div>
</div>
@endsection