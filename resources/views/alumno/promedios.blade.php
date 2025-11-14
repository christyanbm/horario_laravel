@extends('layouts.app')

@section('title', 'Promedios')

@section('nav')
<li class="nav-item">
    <a class="nav-link" href="/alumno" aria-label="Ir al Dashboard">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/alumno/elegir_materias" aria-label="Elegir Materias">
        <i class="fas fa-book-open"></i> Elegir Materias
    </a>
</li>
<li class="nav-item">
    <a class="nav-link active" href="/alumno/promedios" aria-label="Ver Promedios">
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
            <h2 class="display-4 text-primary font-weight-bold">
                <i class="fas fa-chart-bar"></i> Promedios de Semestres Anteriores
            </h2>
            <p class="lead text-muted">Revisa tus calificaciones y analiza tu rendimiento académico. Promedio General: <span id="promedio-general" class="badge bg-success fs-5">0.0</span></p>
        </div>

        <div class="card shadow-lg border-0 rounded-lg" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;">
            <div class="card-body">
                <h5 class="card-title font-weight-bold mb-4">
                    <i class="fas fa-list"></i> Detalle de Calificaciones
                </h5>
                <div class="table-responsive">
                    <table class="table table-hover table-borderless" role="table" aria-labelledby="table-title">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Materia</th>
                                <th scope="col">Calificación</th>
                                <th scope="col">Visual</th>
                            </tr>
                        </thead>
                        <tbody id="calificaciones-body">
                            <tr data-calif="9.0">
                                <td>Cálculo Diferencial</td>
                                <td><span class="badge bg-success">9.0</span></td>
                                <td><div class="progress"><div class="progress-bar bg-success" style="width: 90%"></div></div></td>
                            </tr>
                            <tr data-calif="8.8">
                                <td>Cálculo Integral</td>
                                <td><span class="badge bg-success">8.8</span></td>
                                <td><div class="progress"><div class="progress-bar bg-success" style="width: 88%"></div></div></td>
                            </tr>
                            <tr data-calif="9.2">
                                <td>Programación Avanzada</td>
                                <td><span class="badge bg-success">9.2</span></td>
                                <td><div class="progress"><div class="progress-bar bg-success" style="width: 92%"></div></div></td>
                            </tr>
                            <tr data-calif="8.5">
                                <td>Estructura de Datos</td>
                                <td><span class="badge bg-warning">8.5</span></td>
                                <td><div class="progress"><div class="progress-bar bg-warning" style="width: 85%"></div></div></td>
                            </tr>
                            <tr data-calif="9.0">
                                <td>Fundamentos de Bases de Datos</td>
                                <td><span class="badge bg-success">9.0</span></td>
                                <td><div class="progress"><div class="progress-bar bg-success" style="width: 90%"></div></div></td>
                            </tr>
                            <tr data-calif="8.7">
                                <td>Lenguajes y Autómatas I</td>
                                <td><span class="badge bg-success">8.7</span></td>
                                <td><div class="progress"><div class="progress-bar bg-success" style="width: 87%"></div></div></td>
                            </tr>
                            <tr data-calif="9.5">
                                <td>Plataforma de Desarrollo en la Nube</td>
                                <td><span class="badge bg-success">9.5</span></td>
                                <td><div class="progress"><div class="progress-bar bg-success" style="width: 95%"></div></div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <button class="btn btn-primary btn-lg me-3" onclick="window.print()" aria-label="Imprimir reporte de promedios">
                <i class="fas fa-print"></i> Imprimir Reporte
            </button>
            <a href="/alumno" class="btn btn-outline-primary btn-lg" aria-label="Volver al Dashboard">
                <i class="fas fa-arrow-left"></i> Volver al Dashboard
            </a>
        </div>
    </div>
</div>

<script>
    // Calcular promedio general dinámicamente
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('#calificaciones-body tr');
        let total = 0;
        let count = 0;

        rows.forEach(row => {
            const calif = parseFloat(row.getAttribute('data-calif'));
            if (!isNaN(calif)) {
                total += calif;
                count++;
            }
        });

        const promedio = count > 0 ? (total / count).toFixed(1) : 0.0;
        document.getElementById('promedio-general').textContent = promedio;
    });
</script>

<style>
    .table-hover tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
    .progress-bar {
        transition: width 0.5s ease;
    }
    @media print {
        body * { visibility: hidden; }
        .container, .container * { visibility: visible; }
        .btn { display: none; }
    }
</style>
@endsection
