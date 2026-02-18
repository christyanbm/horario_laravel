@extends('layouts.app')
@include('partials.menu')

@section('title', 'Mis Calificaciones')

@section('content')
    <div class="container mt-4">


        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-primary">Mis Calificaciones</h2>
                <p class="text-muted">Aquí puedes consultar las calificaciones finales de tus materias cursadas.</p>
            </div>
            <a href="{{ route('alumno.dashboard') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Regresar
            </a>
        </div>


        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif


        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Materias Cursadas</h5>
            </div>
            <div class="card-body">

                @if ($calificaciones->isEmpty())
                    <p class="text-center text-muted fst-italic">
                        Aún no tienes calificaciones registradas.
                    </p>
                @else
                    <div class="table-responsive ">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>alumno</th>
                                    <th>Docente</th>
                                    <th>Calificación Final</th>
                                    <th>ciclo</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($calificaciones as $cal)
                                    <tr>
                                        <td class="fw-bold">{{ $cal->materia->nombre }}</td>
                                        <td>{{ $cal->materia->maestro->nombre ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge bg-primary fs-6">
                                                {{ $cal->calificacion_final ?? 'Sin registrar' }}
                                            </span>
                                        </td>
                                        <td>{{ $cal->materia->creditos }}</td>
                                        <td>
                                            @if ($cal->calificacion_final >= 70)
                                                <span class="badge bg-success">Aprobado</span>
                                            @elseif($cal->calificacion_final)
                                                <span class="badge bg-danger">Reprobado</span>
                                            @else
                                                <span class="badge bg-secondary">Pendiente</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <style>
        .table-hover tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.05);
        }
    </style>
@endsection
