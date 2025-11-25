@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Inscripción de Horario')

@section('content')
<div class="container mt-4">

    {{-- 1. Encabezado con información del Alumno --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary">Selección de Horario</h2>
            <p class="text-muted">Bienvenido. Selecciona las materias para tu próximo ciclo.</p>
        </div>
        {{-- Botón opcional para ver el horario ya guardado --}}
        <a href="#" class="btn btn-outline-secondary">
            <i class="bi bi-calendar-check"></i> Ver Mi Horario Actual
        </a>
    </div>

    {{-- 2. Mensajes de Feedback (Éxito o Error) --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        {{-- 3. Columna Principal: Lista de Materias Disponibles --}}
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Materias Disponibles</h5>
                </div>
                <div class="card-body">
                    {{-- Filtro simple (opcional) --}}
                    <form action="" method="GET" class="row g-3 mb-3">
                        <div class="col-auto">
                            <select class="form-select" aria-label="Filtrar por semestre">
                                <option selected>Todos los semestres</option>
                                <option value="1">1er Semestre</option>
                                <option value="2">2do Semestre</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Filtrar</button>
                        </div>
                    </form>

                    {{-- Tabla de Materias --}}
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Materia</th>
                                    <th>Docente</th>
                                    <th>Horario</th>
                                    <th>Cupo</th>
                                    <th class="text-end">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- EJEMPLO: Aquí iterarías tus datos reales con @foreach($materias as $materia) --}}
                                <tr>
                                    <td>
                                        <span class="fw-bold">Matemáticas Discretas</span><br>
                                        <small class="text-muted">Grupo A</small>
                                    </td>
                                    <td>Ing. Juan Pérez</td>
                                    <td>Lun/Mie 08:00 - 10:00</td>
                                    <td><span class="badge bg-success">5 Disp.</span></td>
                                    <td class="text-end">
                                        <form action="#" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                + Agregar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold">Programación I</span><br>
                                        <small class="text-muted">Grupo B</small>
                                    </td>
                                    <td>Lic. Ana López</td>
                                    <td>Mar/Jue 10:00 - 12:00</td>
                                    <td><span class="badge bg-danger">Lleno</span></td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-secondary" disabled>
                                            No disponible
                                        </button>
                                    </td>
                                </tr>
                                {{-- Fin del ejemplo --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. Columna Lateral: Resumen de Carga --}}
        <div class="col-md-4">
            <div class="card shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tu Carga Académica</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Créditos Seleccionados
                            <span class="badge bg-primary rounded-pill">15</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Materias
                            <span class="badge bg-primary rounded-pill">3</span>
                        </li>
                    </ul>
                    <div class="d-grid">
                        <button class="btn btn-success btn-lg">Confirmar Horario</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
