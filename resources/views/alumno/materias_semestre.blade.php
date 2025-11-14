
@extends('layouts.app')

@section('title', 'Materias del Semestre')

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
    <a class="nav-link" href="/alumno/promedios" aria-label="Ver Promedios">
        <i class="fas fa-chart-line"></i> Promedios
    </a>
</li>
<li class="nav-item">
    <a class="nav-link active" href="/alumno/materias_semestre" aria-label="Ver Materias del Semestre">
        <i class="fas fa-calendar-alt"></i> Materias del Semestre
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid py-5" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 80vh;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 text-primary font-weight-bold">
                <i class="fas fa-calendar-check"></i> Materias del Semestre
            </h2>
            <p class="lead text-muted">Ingeniería en Sistemas Computacionales - Revisa las materias que cursarás este semestre. Total: <span id="total-materias" class="fw-bold text-primary">0</span> materias.</p>
        </div>

        <div class="row g-4">
            {{-- Tronco Común --}}
            <div class="col-md-6 col-sm-12">
                <div class="card shadow-lg border-0 rounded-lg h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold mb-4">
                            <i class="fas fa-university"></i> Tronco Común
                            <span class="badge bg-light text-dark ms-2" id="count-tronco">0</span>
                        </h5>
                        <ul class="list-group list-group-flush" role="list" aria-labelledby="tronco-title">
                            <li class="list-group-item bg-transparent border-0 text-white fw-bold">Cálculo Integral</li>
                            <li class="list-group-item bg-transparent border-0 text-white fw-bold">Física</li>
                            <li class="list-group-item bg-transparent border-0 text-white fw-bold">Química</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Materias de ISC --}}
            <div class="col-md-6 col-sm-12">
                <div class="card shadow-lg border-0 rounded-lg h-100" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold mb-4">
                            <i class="fas fa-cogs"></i> Ingeniería en Sistemas Computacionales
                            <span class="badge bg-light text-dark ms-2" id="count-isc">0</span>
                        </h5>
                        <ul class="list-group list-group-flush" role="list" aria-labelledby="isc-title">
                            <li class="list-group-item bg-transparent border-0 text-white fw-bold">Programación Avanzada</li>
                            <li class="list-group-item bg-transparent border-0 text-white fw-bold">Estructura de Datos</li>
                            <li class="list-group-item bg-transparent border-0 text-white fw-bold">Bases de Datos</li>
                            <li class="list-group-item bg-transparent border-0 text-white fw-bold">Lenguajes y Autómatas I</li>
                            <li class="list-group-item bg-transparent border-0 text-white fw-bold">Lenguajes y Autómatas II</li>
                            <li class="list-group-item bg-transparent border-0 text-white fw-bold">Inteligencia Artificial</li>
                            <li class="list-group-item bg-transparent border-0 text-white fw-bold">Programación Lógica y Funcional</li>
                            <li class="list-group-item bg-transparent border-0 text-white fw-bold">Redes de Computadoras</li>
                            <li class="list-group-item bg-transparent border-0 text-white fw-bold">Ingeniería de Software</li>
                            <li class="list-group-item bg-transparent border-0 text-white fw-bold">Sistemas Operativos</li>
                            <li class="list-group-item bg-transparent border-0 text-white fw-bold">Taller de Investigación I</li>
                            <li class="list-group-item bg-transparent border-0 text-white fw-bold">Taller de Investigación II</li>
                            <li class="list-group-item bg-transparent border-0 text-white fw-bold">Plataforma de Desarrollo en la Nube</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <button class="btn btn-primary btn-lg me-3" onclick="window.print()" aria-label="Imprimir lista de materias">
                <i class="fas fa-print"></i> Imprimir Lista
            </button>
            <a href="/alumno" class="btn btn-outline-primary btn-lg" aria-label="Volver al Dashboard">
                <i class="fas fa-arrow-left"></i> Volver al Dashboard
            </a>
        </div>
    </div>
</div>

<script>
    // Contar y actualizar totales dinámicamente
    document.addEventListener('DOMContentLoaded', function() {
        const troncoItems = document.querySelectorAll('#tronco-title + ul li');
        const iscItems = document.querySelectorAll('#isc-title + ul li');
        
        document.getElementById('count-tronco').textContent = troncoItems.length;
        document.getElementById('count-isc').textContent = iscItems.length;
        document.getElementById('total-materias').textContent = troncoItems.length + iscItems.length;
    });
</script>

<style>
    .list-group-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transition: background-color 0.3s ease;
    }
    @media print {
        body * { visibility: hidden; }
        .container, .container * { visibility: visible; }
        .btn { display: none; }
    }
</style>
@endsection
