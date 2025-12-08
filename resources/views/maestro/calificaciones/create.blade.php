@extends('layouts.app')
@include('partials.menu')

@section('title', 'Calificaciones')

@section('content')
<div class="container mt-4">

    <h2 class="fw-bold">
        Calificaciones – {{ $grupo->nombre }} ({{ $grupo->materia->nombre }})
    </h2>

    <p class="text-muted mb-4">
        Maestro: {{ Auth::user()->name }}
    </p>

    <form action="{{ route('maestro.calificaciones.store') }}" method="POST">
        @csrf

        <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">

        <table class="table table-bordered table-striped mt-3">
            <thead class="table-light">
                <tr>
                    <th>Alumno</th>
                    <th>Matrícula</th>
                    <th>Calificación</th>
                </tr>
            </thead>

            <tbody>
             @foreach($grupo->alumnos as $alumno)
<tr>
    <td>{{ $alumno->name }}</td>
    <td>{{ $alumno->matricula }}</td>

    <td>
        @if(isset($calificacionesExistentes[$alumno->id]))
            <span class="text-success fw-bold">
                Ya calificado: {{ $calificacionesExistentes[$alumno->id] }}
            </span>
        @else
            <input 
                type="number" 
                class="form-control"
                name="calificaciones[{{ $alumno->id }}]"
                min="0" max="100" required>
        @endif
    </td>
</tr>
@endforeach

            </tbody>
        </table>

        <button class="btn btn-primary mt-3">Guardar Calificaciones</button>
    </form>
@if($calificaciones->isNotEmpty())
    <h3 class="mt-5 fw-bold">Alumnos ya calificados</h3>

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-light">
            <tr>
                <th>Alumno</th>
                <th>Matrícula</th>
                <th>Calificación</th>
                <th>Créditos</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($calificaciones as $cal)
                <tr>
                    <td>{{ $cal->alumno->name }}</td>
                    <td>{{ $cal->alumno->matricula }}</td>
                    <td class="fw-bold text-success">{{ $cal->calificacion }}</td>
                    <td>{{ $cal->creditos_otorgados }}</td>
                    <td>{{ $cal->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

</div>

@endsection
