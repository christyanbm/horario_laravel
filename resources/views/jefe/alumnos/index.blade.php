@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Alumnos')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Lista de Alumnos</h2>

        <a href="{{ route('jefe.alumnos.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Crear Alumno
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
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

                                <a href="{{ route('jefe.alumnos.edit', $alumno->id) }}"
                                   class="btn btn-warning btn-sm">Editar</a>

                                <form action="{{ route('jefe.alumnos.destroy', $alumno->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar este alumno?')">
                                        Eliminar
                                    </button>
                                </form>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="text-center p-3">
                                No hay alumnos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
