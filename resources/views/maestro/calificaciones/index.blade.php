@extends('layouts.app')
@include('partials.menu')

@section('title', 'Calificaciones Finales')

@section('content')
<div class="container mt-4">

    <div class="text-center mb-4">
        <h2 class="fw-bold">📘 Calificaciones Finales</h2>
        <p class="text-muted">Selecciona un grupo para registrar o editar sus calificaciones</p>
    </div>

    @if($grupos->isEmpty())
        <div class="alert alert-warning shadow-sm text-center py-3">
            No tienes grupos asignados.
        </div>
    @else

        <div class="row g-4">
            @foreach($grupos as $grupo)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('maestro.calificaciones.create', $grupo->id) }}" class="text-decoration-none">
                        <div class="card shadow-sm border-0 rounded-3 group-card-hover">
                            <div class="card-body">

                                <h5 class="fw-bold mb-1 text-dark">
                                    {{ $grupo->nombre }}
                                </h5>

                                <p class="mb-2 text-primary fw-semibold">
                                    {{ $grupo->materia->nombre }}
                                </p>

                                <div class="d-flex justify-content-between mt-3">
                                    <small class="text-muted">
                                        ⏰ {{ $grupo->hora_inicio }} — {{ $grupo->hora_fin }}
                                    </small>
                                    <span class="badge bg-primary px-3 py-2 shadow-sm">Calificar</span>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    @endif
</div>

<style>
    .group-card-hover {
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .group-card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
</style>
@endsection
