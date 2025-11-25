@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Usuarios del Sistema')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">
        @if(request('role'))
            Usuarios: {{ ucfirst(request('role')) }}
        @else
            Todos los Usuarios
        @endif
    </h2>

    <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary mb-3">Crear Nuevo Usuario</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles->pluck('name')->first() }}</td>
                    <td>
                        <a href="{{ route('admin.usuarios.edit', $user->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('admin.usuarios.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
