@extends('layouts.app')
@extends('partials.menu')

@section('title', 'Evaluaciones Docentes')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary m-0">
            <i class="bi bi-clipboard2-check"></i> Evaluaciones Docentes
        </h2>

        <span class="badge bg-primary p-2 px-3 shadow-sm">
            Total: {{ $evaluaciones->count() }}
        </span>
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">

            <p class="text-muted mb-4">
                Aquí puedes consultar todas las evaluaciones realizadas por los alumnos.<br>
                <strong class="text-dark">El nombre del alumno está oculto por privacidad.</strong>
            </p>

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center shadow-sm rounded-3 overflow-hidden">
                    <thead class="table-primary">
                        <tr>
                            <th>Maestro</th>
                            <th>Puntualidad</th>
                            <th>Claridad</th>
                            <th>Dominio</th>
                            <th>Conocimiento</th>
                            <th>Dinámica</th>
                            <th>Paciencia</th>
                            <th>Comentarios</th>
                        
                            <th>Fecha</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($evaluaciones as $eva)
                        <tr class="table-row-hover">

                            <td class="fw-semibold text-primary">
                                {{ $eva->maestro->name }}
                            </td>

                            <td><span class="badge bg-info">{{ $eva->puntualidad }}</span></td>
                            <td><span class="badge bg-info">{{ $eva->claridad }}</span></td>
                            <td><span class="badge bg-info">{{ $eva->dominio }}</span></td>
                            <td><span class="badge bg-info">{{ $eva->conocimiento }}</span></td>
                            <td><span class="badge bg-info">{{ $eva->dinamica }}</span></td>
                            <td><span class="badge bg-info">{{ $eva->paciencia }}</span></td>

                            <td class="text-secondary fst-italic">
                                @if ($eva->comentario)
                                    “{{ $eva->comentario }}”
                                @else
                                    <span class="text-muted">Sin comentario</span>
                                @endif
                            </td>

                           

                            <td class="text-muted">
                                {{ $eva->created_at->format('d/m/Y') }}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
@endsection
