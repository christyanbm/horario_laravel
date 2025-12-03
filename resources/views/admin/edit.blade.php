@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Editar Usuario')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Editar Usuario</h2>

    <form method="POST" action="{{ route('admin.usuarios.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Correo Electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Rol</label>
            <select name="role" class="form-select" required>
                <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Administrador</option>
                <option value="jefe" {{ $user->hasRole('jefe') ? 'selected' : '' }}>Jefe de carrera</option>
                <option value="alumno" {{ $user->hasRole('alumno') ? 'selected' : '' }}>Alumno</option>
                <option value="maestro" {{ $user->hasRole('maestro') ? 'selected' : '' }}>Maestro</option>
                <option value="coordinador" {{ $user->hasRole('coordinador') ? 'selected' : '' }}>Coordinador</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Usuario</button>
    </form>
</div>
@endsection
