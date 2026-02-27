@extends('layouts.app')
@extends('partials.menu')

@section('title', 'Asignar Maestro a Grupo')

@section('content')
    <div class="container mt-4">

        <h2 class="fw-bold mb-4">Asignación de Maestros a Grupos</h2>

        <div class="card shadow-sm">
            <div class="card-body">

              
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-x-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif


                @if ($grupos->isEmpty())
                    <div class="alert alert-info text-center">
                        No hay grupos creados.
                    </div>
                @else
                    <form action="{{ route('jefe.asignaciones.guardar') }}" method="POST">
                        @csrf

                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Grupo</th>
                                    <th>Materia</th>
                                    <th>Horario</th>
                                    <th>Asignar Maestro</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grupos as $grupo)
                                    <tr>
                                      
                                        <td>{{ $grupo->nombre }}</td>

                                   
                                        <td>{{ $grupo->materia->nombre ?? 'Sin materia' }}</td>

                                        <td>{{ $grupo->hora_inicio->format('H:i') }} - {{ $grupo->hora_fin->format('H:i') }}
                                        </td>

                           
                                        <td>
                                            <select name="maestro_id[{{ $grupo->id }}]"
                                                class="form-select @if (isset($conflictos[$grupo->id])) is-invalid @endif">
                                                <option value="">-- Seleccionar maestro --</option>
                                                @foreach ($maestros as $maestro)
                                                    <option value="{{ $maestro->id }}"
                                                        @if ($grupo->maestro_id == $maestro->id) selected @endif>
                                                        {{ $maestro->name }}
                                                    </option>
                                                @endforeach
                                            </select>


                                            @if (isset($conflictos[$grupo->id]))
                                                <small class="text-danger">
                                                    Conflicto de horario con los grupos:
                                                    {{ implode(', ', $conflictos[$grupo->id]) }}
                                                </small>
                                            @else
                                                @if ($grupo->maestro_id)
                                                    <small class="text-success d-block mt-1">
                                                        Maestro asignado correctamente
                                                    </small>
                                                @endif
                                            @endif

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