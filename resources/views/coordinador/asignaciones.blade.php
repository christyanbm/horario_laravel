@extends('layouts.app')
@extends('partials.menu')

@section('title', 'Asignar Maestro a Grupo')

@section('content')
<div class="container mt-4">

    <h2 class="fw-bold mb-4">Asignación de Maestros a Grupos</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- Mensajes --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($grupos->isEmpty())
                <div class="alert alert-info text-center">
                    No hay grupos creados por el coordinador.
                </div>
            @else

            <form action="{{ route('coordinador.asignar.guardar') }}" method="POST">
                @csrf

                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Grupo</th>
                            <th>Materia</th>
                            <th>Asignar Maestro</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grupos as $grupo)
                        <tr>
                            <td>{{ $grupo->nombre }}</td>

                            <td>
                                {{ $grupo->materia->nombre ?? 'Sin materia' }}
                            </td>

                            <td>
                                <select name="maestro_id[{{ $grupo->id }}]" class="form-select">
                                    <option value="">-- Seleccionar maestro --</option>
                                    @foreach($maestros as $maestro)
                                        <option 
                                            value="{{ $maestro->id }}"
                                            @if($grupo->maestro_id == $maestro->id) selected @endif
                                        >
                                            {{ $maestro->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <button class="btn btn-primary mt-3">Guardar Asignaciones</button>

            </form>
            @endif

        </div>
    </div>

</div>
@endsection
