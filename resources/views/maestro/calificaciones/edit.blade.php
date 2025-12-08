@extends('layouts.app')
@include('partials.menu')

@section('title', 'Calificaciones')

@section('content')
<div class="container mt-4">

    <h2 class="fw-bold">
        Editar Calificaciones – {{ $grupo->nombre }} ({{ $grupo->materia->nombre }})
    </h2>

    <p class="text-muted mb-4">
        Maestro: {{ Auth::user()->name }}
    </p>

    <form action="{{ route('maestro.calificaciones.update', $grupo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Matrícula</th>
                    <th>Calificación</th>
                </tr>
            </thead>

            <tbody>
                @foreach($calificaciones as $c)
                <tr>
                    <td>{{ $c->alumno->nombre }}</td>
                    <td>{{ $c->alumno->matricula }}</td>

                    <td>
                        <input 
                            type="number" 
                            class="form-control"
                            name="calificaciones[{{ $c->alumno_id }}]"
                            value="{{ $c->calificacion }}"
                            min="0" max="100" required>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button class="btn btn-success mt-3">Actualizar</button>
    </form>
</div>
@endsection
