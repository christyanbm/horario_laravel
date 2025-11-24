@extends('layouts.app')

@section('title', 'Progreso Académico')

@section('content')
<div class="container mt-4">

    {{-- 1. Encabezado con información del perfil --}}
    <div class="row mb-4 align-items-end">
        <div class="col-md-8">
            <h2 class="fw-bold text-primary"><i class="bi bi-journal-medical"></i> Tu Progreso Académico</h2>
            <p class="text-muted mb-0">Ingeniería en Sistemas Computacionales</p>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-outline-primary">
                <i class="bi bi-file-earmark-pdf"></i> Descargar Kárdex
            </button>
        </div>
    </div>

    {{-- 2. Tarjetas de Resumen (Dashboard) --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-start border-primary border-4 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted small">Promedio General</h6>
                    <h2 class="display-6 fw-bold">9.4</h2>
                    <small class="text-success"><i class="bi bi-arrow-up"></i> Subió 0.2 este ciclo</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-start border-success border-4 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted small">Créditos Acumulados</h6>
                    <h2 class="display-6 fw-bold">180 / 260</h2>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-muted">70% de avance reticular</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-start border-danger border-4 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted small">Materias Pendientes</h6>
                    <h2 class="display-6 fw-bold text-danger">1</h2>
                    <small class="text-muted">Tienes materias en recurso</small>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Tabla de Calificaciones del Semestre Actual --}}
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Calificaciones: Semestre Ene-Jun 2025</h5>
            <span class="badge bg-info text-dark">Ciclo Activo</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Materia</th>
                            <th class="text-center">P1</th>
                            <th class="text-center">P2</th>
                            <th class="text-center">P3</th>
                            <th class="text-center fw-bold">Final</th>
                            <th class="text-center">Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- EJEMPLO: Aquí iría tu @foreach($calificaciones as $calif) --}}
                        <tr>
                            <td>
                                <span class="fw-bold">Base de Datos II</span><br>
                                <small class="text-muted">Docente: Dra. Ruiz</small>
                            </td>
                            <td class="text-center">90</td>
                            <td class="text-center">85</td>
                            <td class="text-center text-muted">-</td> {{-- Aún no calificado --}}
                            <td class="text-center fw-bold text-primary">87.5</td> {{-- Promedio actual --}}
                            <td class="text-center">
                                <span class="badge bg-primary">Cursando</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold">Estructura de Datos</span><br>
                                <small class="text-muted">Docente: Ing. Mota</small>
                            </td>
                            <td class="text-center">100</td>
                            <td class="text-center">95</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center fw-bold text-primary">97.5</td>
                            <td class="text-center">
                                <span class="badge bg-success">Aprobando</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-bold">Cálculo Vectorial</span><br>
                                <small class="text-muted">Docente: Lic. Estrada</small>
                            </td>
                            <td class="text-center text-danger fw-bold">60</td>
                            <td class="text-center text-danger fw-bold">50</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center fw-bold text-danger">55.0</td>
                            <td class="text-center">
                                <span class="badge bg-warning text-dark">En Riesgo</span>
                            </td>
                        </tr>
                        {{-- Fin del ejemplo --}}
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white text-muted small">
            * P1, P2, P3 corresponden a las evaluaciones parciales. La calificación mínima aprobatoria es 70.
        </div>
    </div>
</div>
@endsection