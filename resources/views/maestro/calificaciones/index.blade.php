@extends('layouts.app')
@include('partials.menu')

@section('title', 'Calificaciones Finales')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">Calificaciones Finales</h2>

    @if($grupos->isEmpty())
        <div class="alert alert-warning">No tienes grupos asignados.</div>
    @else
        <div class="list-group shadow-sm">
            @foreach($grupos as $grupo)
                <a href="{{ route('maestro.calificaciones.create', $grupo->id) }}" 
                   class="list-group-item list-group-item-action py-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="fw-bold mb-1">{{ $grupo->nombre }}</h5>
                            <small class="text-muted">{{ $grupo->materia->nombre }}</small>
                            <small class="text-muted">{{ $grupo->materia->hora_inicio }}</small>
                            <small class="text-muted">{{ $grupo->materia->hora_fin }}</small>
                        </div>
                        <span class="badge bg-primary">Calificar</span>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
