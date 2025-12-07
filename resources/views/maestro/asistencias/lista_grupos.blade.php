@extends('layouts.app')
@include('partials.menu')
@section('title', 'Calificaciones Finales')

<div class="container mt-4">

    <h3 class="mb-3">Selecciona un grupo</h3>

    <ul class="list-group">
        @foreach($grupos as $grupo)
            <li class="list-group-item">
                <a href="{{ route('maestro.asistencias.grupo', $grupo->id) }}">
                    {{ $grupo->nombre }} • {{ $grupo->materia->nombre ?? 'Sin materia' }}
                </a>
            </li>
        @endforeach
    </ul>

</div>
@endsection
