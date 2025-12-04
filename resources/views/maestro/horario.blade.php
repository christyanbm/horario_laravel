@extends('layouts.app')

@section('title', 'Mi Horario')

@section('content')
<div class="container mt-4">

    <h2 class="fw-bold text-primary mb-4">
        <i class="bi bi-calendar-week"></i> Mi Horario de Clases
    </h2>

    {{-- Si no hay grupos asignados --}}
    @if ($grupos->isEmpty())
        <div class="alert alert-warning">
            <i class="bi bi-info-circle"></i> No tienes grupos asignados actualmente.
        </div>
    @else

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Materia</th>
                        <th>Grupo</th>
                        <th>Día</th>
                        <th>Hora</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($grupos as $grupo)
                    <tr>
                        <td class="fw-bold">{{ $grupo->materia->nombre }}</td>
                        <td>{{ $grupo->nombre }}</td>

                        <td>
                            <span class="badge bg-primary">
                                {{ $grupo->dia }}
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-secondary">
                                {{ \Carbon\Carbon::parse($grupo->hora_inicio)->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($grupo->hora_fin)->format('H:i') }}
                            </span>
                        </td>

                        <td>
                            {{-- Botón Asistencias --}}
                            <a href="{{ route('maestro.asistencias', $grupo->id) }}"
                                class="btn btn-sm btn-success me-2">
                                <i class="bi bi-clipboard-check"></i> Asistencias
                            </a>

                            {{-- Botón Calificación Final --}}
                            <a href="{{ route('maestro.calificaciones.finales', ['grupo' => $grupo->id]) }}"
                                class="btn btn-sm btn-primary">
                                <i class="bi bi-journal-check"></i> Calificaciones
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    @endif

</div>
@endsection
