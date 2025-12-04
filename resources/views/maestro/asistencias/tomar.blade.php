@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Asistencias del Grupo: {{ $grupo->nombre }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('maestro.asistencias.registrar') }}" method="POST">
        @csrf

        <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
        <input type="hidden" name="materia_id" value="{{ $grupo->materia_id }}">
        <input type="hidden" name="maestro_id" value="{{ auth()->id() }}">

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th style="width: 30%">Alumno</th>
                    <th style="width: 20%">Estado</th>
                    <th style="width: 50%">Observación</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->name }}</td>

                        <td>
                            <select name="alumnos[{{ $alumno->id }}][estado]" class="form-control">
                                <option value="presente">Presente</option>
                                <option value="ausente">Ausente</option>
                                <option value="justificado">Justificado</option>
                            </select>
                        </td>

                        <td>
                            <input 
                                type="text" 
                                name="alumnos[{{ $alumno->id }}][observacion]" 
                                class="form-control"
                                placeholder="Agregar observación (opcional)">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button class="btn btn-primary mt-3">Guardar Asistencias</button>
    </form>
</div>
@endsection
