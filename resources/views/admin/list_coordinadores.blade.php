@extends('layouts.app')

@section('title', 'Lista de Coordinadores')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Lista de Coordinadores</h2>

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
            @forelse($coordinadores as $coordinador)
            <tr>
                <td>{{ $coordinador->id }}</td>
                <td>{{ $coordinador->name }}</td>
                <td>{{ $coordinador->email }}</td>
                <td>
                    <a href="{{ route('admin.usuarios.edit', $coordinador->id) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form action="{{ route('admin.usuarios.destroy', $coordinador->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este coordinador?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No hay coordinadores registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
