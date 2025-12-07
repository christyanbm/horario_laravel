@extends('layouts.app')
@include('partials.menu')
@section('title', 'Alumnos del Grupo')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">Alumnos del Grupo: {{ $grupo->nombre }} ({{ $grupo->materia->nombre }})</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grupo->alumnos as $alumno)
            <tr>
                <td>{{ $alumno->name }}</td>
                <td>{{ $alumno->email }}</td>
                <td>
                    <form action="{{ route('coordinador.grupos.alumnos.eliminar', [$grupo->id, $alumno->id]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h5 class="mt-4">Agregar Alumno</h5>
    <form action="{{ route('coordinador.grupos.alumnos.agregar', $grupo->id) }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <select name="alumno_id" class="form-select" required>
                <option value="">Selecciona un alumno</option>
                @foreach(\App\Models\User::role('alumno')->get() as $alumno)
                    @if(!$grupo->alumnos->contains($alumno->id))
                        <option value="{{ $alumno->id }}">{{ $alumno->name }}</option>
                    @endif
                @endforeach
            </select>
            <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
    </form>
</div>
@endsection
