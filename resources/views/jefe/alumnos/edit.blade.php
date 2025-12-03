@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Editar Alumno')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Editar Alumno</h2>

    <form action="{{ route('jefe.alumnos.update', $alumno->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control"
                   value="{{ $alumno->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Correo</label>
            <input type="email" name="email" class="form-control"
                   value="{{ $alumno->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nueva Contraseña (Opcional)</label>
            <input type="password" name="password" class="form-control">
            <small class="text-muted">Déjalo vacío si no quieres cambiarla</small>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>

        {{-- REGRESAR SOLO A LA VISTA JEFE --}}
        <a href="{{ route('jefe.alumnos.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </form>
</div>
@endsection
