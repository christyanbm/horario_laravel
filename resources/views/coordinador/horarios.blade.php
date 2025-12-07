@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Gestión de Horarios y Calificaciones')

@section('content')
<div class="container mt-4">

    {{-- 1. Barra de Herramientas --}}
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 border-bottom pb-3">
        <div>
            <h2 class="fw-bold text-primary mb-1">Gestión de Horarios y Calificaciones</h2>
            <p class="text-muted mb-0">Visualiza los grupos, horarios y calificaciones de los alumnos.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary">
                <i class="bi bi-printer"></i> Imprimir
            </button>
            <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalHorario">
                <i class="bi bi-plus-lg"></i> Agregar Clase
            </button>
        </div>
    </div>

    {{-- Filtros --}}
    <div class="card shadow-sm border-0 mb-4 bg-light">
        <div class="card-body py-3">
            <div class="row g-2 align-items-center">
                <div class="col-auto fw-bold text-secondary">
                    <i class="bi bi-funnel-fill"></i> Filtrar por:
                </div>

                {{-- Filtrar por Carrera --}}
                <div class="col-md-3">
                    <select class="form-select form-select-sm">
                        @if(isset($carreras) && $carreras->count())
                            @foreach($carreras as $carrera)
                                <option>{{ $carrera }}</option>
                            @endforeach
                        @else
                            <option>Todos</option>
                        @endif
                    </select>
                </div>

                {{-- Filtrar por Semestre --}}
                <div class="col-md-2">
                    <select class="form-select form-select-sm">
                        @if(isset($semestres) && count($semestres))
                            @foreach($semestres as $semestre)
                                <option>{{ $semestre }}</option>
                            @endforeach
                        @else
                            <option>Todos</option>
                        @endif
                    </select>
                </div>

                {{-- Filtrar por Grupo --}}
                <div class="col-md-2">
                    <select class="form-select form-select-sm fw-bold text-dark">
                        @foreach($grupos as $grupo)
                            <option>{{ $grupo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLA DE GRUPOS Y ALUMNOS --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Grupo</th>
                        <th>Materia</th>
                        <th>Docente</th>
                        <th>Horario</th>
                        <th>Alumnos</th>
                        <th>Calificaciones</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($grupos as $grupo)
                        <tr>
                            <td>{{ $grupo->nombre }}</td>
                            <td>{{ $grupo->materia->nombre ?? 'Sin asignar' }}</td>
                            <td>{{ $grupo->maestro->name ?? 'Sin asignar' }}</td>
                            <td>{{ $grupo->horario ?? '-' }}</td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach($grupo->alumnos as $alumno)
                                        <li>{{ $alumno->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                       <td>
    <ul class="list-unstyled mb-0">
        @foreach($grupo->alumnos as $alumno)
            <li>
                {{ $alumno->calificacion ?? '-' }}
                @if(isset($alumno->calificacion) && $alumno->calificacion < 60)
                    <span class="badge bg-danger">Reprobado</span>
                @endif
            </li>
        @endforeach
    </ul>
</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
