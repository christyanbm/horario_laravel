@extends('layouts.app')
@extends('partials.menu')

@section('title', 'Horarios de Grupos')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Grupos y Alumnos Inscritos</h2>

    @forelse($grupos as $grupo)
        <div class="card mb-3 shadow-sm">
            <div class="card-header bg-primary text-white">
                <strong>Grupo:</strong> {{ $grupo->nombre }} |
                <strong>Materia:</strong> {{ $grupo->materia->nombre ?? 'Sin Materia' }} |
                <strong>Maestro:</strong> {{ $grupo->maestro->name ?? 'Sin Maestro' }} |
                    <strong>Horario:</strong>  
                {{ \Carbon\Carbon::parse($grupo->hora_inicio)->format('H:i') }} - 
                {{ \Carbon\Carbon::parse($grupo->hora_fin)->format('H:i') }}
            </div>
            <div class="card-body">
                <h5>Alumnos inscritos:</h5>
                <ul>
                    @forelse($grupo->alumnos as $alumno)
                        <li>{{ $alumno->name }} ({{ $alumno->email }})</li>
                    @empty
                        <li>No hay alumnos inscritos en este grupo.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    @empty
        <div class="alert alert-warning">
            No hay grupos registrados todavía.
        </div>
    @endforelse
</div>
@endsection
