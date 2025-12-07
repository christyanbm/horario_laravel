@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Crear Alumno')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Registrar Alumno</h2>

    <form action="{{ route('jefe.alumnos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Matrícula</label>
            <input type="text" name="matricula" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Correo</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>
<div class="mb-3">
    <label class="form-label">Confirmar Contraseña</label>
    <input type="password" name="password_confirmation" class="form-control" required>
</div>

        <input type="hidden" name="role" value="alumno">

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('jefe.alumnos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
