@extends('layouts.app')
@include('partials.menu')

@section('title', 'Evaluar Maestro')

@section('content')
<div class="container mt-4">
    <h2>Evaluar al maestro: {{ $maestro->name }}</h2>

    
    @if(session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
        <a href="{{ route('alumno.evaluaciones.index') }}" class="btn btn-secondary mt-2">Volver</a>
    @else
        <form action="{{ route('alumno.evaluaciones.store', $maestro->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Puntualidad (1-5)</label>
                <input type="number" name="puntualidad" min="1" max="5" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Claridad (1-5)</label>
                <input type="number" name="claridad" min="1" max="5" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Paciencia (1-5)</label>
                <input type="number" name="paciencia" min="1" max="5" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Dominio del tema (1-5)</label>
                <input type="number" name="dominio" min="1" max="5" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Conocimiento (1-5)</label>
                <input type="number" name="conocimiento" min="1" max="5" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Dinamica (1-5)</label>
                <input type="number" name="dinamica" min="1" max="5" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Comentario (opcional)</label>
                <textarea name="comentario" class="form-control" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Enviar Evaluación</button>
            <a href="{{ route('alumno.evaluaciones.index') }}" class="btn btn-secondary">Volver</a>
        </form>
    @endif
</div>
@endsection
