@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Lista de Jefes de Carrera')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Lista de Jefes de Carrera</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary mb-3">Crear Nuevo Usuario</a>
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
            @forelse($jefes as $jefe)
            <tr>
                <td>{{ $jefe->id }}</td>
                <td>{{ $jefe->name }}</td>
                <td>{{ $jefe->email }}</td>
                <td>
                    <a href="{{ route('admin.usuarios.edit', $jefe->id) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form action="{{ route('admin.usuarios.destroy', $jefe->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este jefe?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No hay jefes registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
