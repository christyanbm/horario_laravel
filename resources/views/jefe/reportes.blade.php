@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Reportes Académicos')

@section('content')
<div class="container mt-4">

    {{-- 1. Encabezado Visual --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold text-dark mb-0">
                <i class="bi bi-file-earmark-bar-graph text-primary me-2"></i>Reportes Académicos
            </h2>
            <p class="text-muted small mt-1 mb-0">Vista de Jefe de Carrera</p>
        </div>
        <div>
            
        </div>
    </div>

    <div class="row g-4">

        {{-- 2. Resumen por Carrera --}}
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-secondary">
                        <i class="bi bi-pie-chart-fill me-2"></i>Resumen General por Carrera
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-uppercase small">
                                <tr>
                                    <th class="ps-4">Carrera</th>
                                    <th class="text-center">Total Inasistencias</th>
                                    <th class="text-center">Promedio General</th>
                                    <th style="width: 30%;">Indicador Visual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carreras as $index => $carrera)
                                    <tr>
                                        <td class="ps-4 fw-bold">{{ $carrera }}</td>
                                        <td class="text-center text-muted">{{ $inasistenciasPorCarrera[$index] }}</td>
                                        <td class="text-center fw-bold text-dark">
                                            {{ number_format($promedioPorCarrera[$index], 2) }}
                                        </td>
                                        <td class="pe-4">
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar {{ $promedioPorCarrera[$index] >= 80 ? 'bg-success' : 'bg-warning' }}"
                                                     role="progressbar"
                                                     style="width: {{ $promedioPorCarrera[$index] }}%">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. Tabla Detallada de Alumnos --}}
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-secondary">
                        <i class="bi bi-people-fill me-2"></i>Detalle de Alumnos
                    </h5>
                    <span class="badge bg-light text-dark border">Total: {{ count($alumnos) }}</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-primary text-white">
                                <tr>
                                    <th class="ps-4">Nombre del Alumno</th>
                                    <th>Carrera</th>
                                    <th class="text-center">Asistencias</th>
                                    <th class="text-center">Inasistencias</th>
                                    <th class="text-center">Justificados</th>
                                    <th class="text-center">Promedio</th>
                                    <th class="text-center">Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alumnos as $alumno)
                                    @php
                                        $esRiesgoProm = $alumno->promedio < 70;
                                        $esRiesgoAsist = $alumno->inasistencias > 10;
                                    @endphp
                                    <tr>
                                        <td class="ps-4 fw-bold">{{ $alumno->name }}</td>
                                        <td class="small text-muted">{{ $alumno->carrera }}</td>

                                        {{-- Asistencias --}}
                                        <td class="text-center">
                                            <span class="badge bg-success">{{ $alumno->asistencias }}</span>
                                        </td>

                                        {{-- Inasistencias --}}
                                        <td class="text-center">
                                            <span class="badge bg-danger">{{ $alumno->inasistencias }}</span>
                                        </td>

                                        {{-- Justificados --}}
                                        <td class="text-center">
                                            <span class="badge bg-warning text-dark">{{ $alumno->justificados }}</span>
                                        </td>

                                        {{-- Promedio --}}
                                        <td class="text-center fw-bold {{ $esRiesgoProm ? 'text-danger' : 'text-success' }}">
                                            {{ number_format($alumno->promedio, 2) }}
                                        </td>

                                        {{-- Estatus --}}
                                        <td class="text-center">
                                            @if($esRiesgoProm)
                                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger">Reprobando</span>
                                            @elseif($esRiesgoAsist)
                                                <span class="badge bg-warning text-dark border border-warning">Riesgo Faltas</span>
                                            @else
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success">Regular</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white py-3 text-center">
                    <small class="text-muted">Fin del reporte académico</small>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
