@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Materias Inscritas')

@section('content')
<div class="container mt-4">

   
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <h2 class="fw-bold text-primary mb-0">Materias Inscritas</h2>
            <small class="text-muted">Alumno: {{ auth()->user()->name }}</small>
        </div>
        <div>
            <span class="badge bg-light text-dark border p-2 me-2">
                <i class="bi bi-person-badge"></i> Matrícula: {{ auth()->user()->matricula }}
            </span>
        </div>
    </div>

    
    <div class="card shadow-sm border-0">
        <div class="card-body">
            @if($gruposInscritos->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> Aún no tienes materias registradas.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-secondary small text-uppercase">
                            <tr>
                                <th>Materia</th>
                                <th>Créditos</th>
                                <th>Maestro</th>
                                <th>Horario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gruposInscritos as $grupo)
                                <tr>
                                    <td>{{ $grupo->materia->nombre }}</td>
                                    <td class="text-center">{{ $grupo->materia->creditos }}</td>
                                   <td>{{ $grupo->maestro->name ?? 'Sin asignar' }}</td>

                                   <td>{{ $grupo->horario }}</td>


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
.table-hover tbody tr:hover { background-color: rgba(13, 110, 253, 0.05); }
</style>
@endsection
