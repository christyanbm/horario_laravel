@extends('layouts.app')
@extends('components.layouts.base')

@section('title', 'Lista de Alumnos')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Lista de Alumnos</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alumnos as $alumno)
            <tr>
                <td>{{ $alumno->id }}</td>
                <td>{{ $alumno->name }}</td>
                <td>{{ $alumno->email }}</td>
                <td>
                    <a href="{{ route('admin.usuarios.edit', $alumno->id) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form action="{{ route('admin.usuarios.destroy', $alumno->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este usuario?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No hay alumnos registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
