@extends('layouts.app')

@include('partials.menu')

@section('title', 'Calificaciones Finales')

<div class="container mt-4">

    <h2 class="fw-bold mb-3">
        Asistencias – {{ $grupo->nombre }} ({{ $grupo->materia->nombre }})
    </h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('maestro.asistencias.registrar') }}" method="POST">
        @csrf

        <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Matrícula</th>
                    <th>Asistencia</th>
                </tr>
            </thead>

            <tbody>
                @foreach($grupo->alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->nombre }}</td>
                    <td>{{ $alumno->matricula }}</td>

                    <td>
                        <select class="form-select" name="alumnos[{{ $alumno->id }}]">
                            <option value="asistió">Asistió</option>
                            <option value="falta">Faltó</option>
                            <option value="retardo">Retardo</option>
                            <option value="justificado">Justificado</option>
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button class="btn btn-primary">Guardar Asistencias</button>
    </form>

</div>
@endsection
