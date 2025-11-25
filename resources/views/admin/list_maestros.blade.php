@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Lista de Maestros')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Lista de Maestros</h2>

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
            @forelse($maestros as $maestro)
            <tr>
                <td>{{ $maestro->id }}</td>
                <td>{{ $maestro->name }}</td>
                <td>{{ $maestro->email }}</td>
                <td>
                    <a href="{{ route('admin.usuarios.edit', $maestro->id) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form action="{{ route('admin.usuarios.destroy', $maestro->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este maestro?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No hay maestros registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
