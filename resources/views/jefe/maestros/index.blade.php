@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Crear Maestro')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Maestros</h2>

    <a href="{{ route('jefe.maestros.create') }}" class="btn btn-primary mb-3">Agregar Maestro</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($maestros as $maestro)
                <tr>
                    <td>{{ $maestro->name }}</td>
                    <td>{{ $maestro->email }}</td>
                    <td>
                        <a href="{{ route('jefe.maestros.edit', $maestro->id) }}" class="btn btn-sm btn-warning">Editar</a>

                        <form action="{{ route('jefe.maestros.destroy', $maestro->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('¿Está seguro de eliminar este maestro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
