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
@if($asistenciasRegistradas->count() > 0)
<div class="card shadow-sm mt-5">
    <div class="card-header">Historial de Asistencias</div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Alumno</th>
                    <th>Estado</th>
                    <th>Observación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($asistenciasRegistradas as $asistencia)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
                    <td>{{ $asistencia->alumno->name }}</td>
                    <td>
                        @if($asistencia->estado === 'presente')
                            <span class="badge bg-success">Presente</span>
                        @elseif($asistencia->estado === 'ausente')
                            <span class="badge bg-danger">Ausente</span>
                        @elseif($asistencia->estado === 'justificado')
                            <span class="badge bg-warning text-dark">Justificado</span>
                        @endif
                    </td>
                    <td>{{ $asistencia->observacion ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif


        <button class="btn btn-primary mt-3">Guardar Asistencias</button>
    </form>
</div>
@endsection
