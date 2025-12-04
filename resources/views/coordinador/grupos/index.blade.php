@extends('layouts.app')

@section('content')
    @include('partials.menu')

    <div class="container">
        <h1 class="mb-4">Lista de Grupos</h1>

        <a href="{{ route('coordinador.grupos.create') }}" class="btn btn-primary mb-3">
            Crear Nuevo Grupo
        </a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cupo</th>
                    <th>Materia</th>
                    <th>Horario</th>
                    <th>Maestro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grupos as $grupo)
                    <tr>
                        <td>{{ $grupo->nombre }}</td>
                        <td>{{ $grupo->cupo_max }}</td>

                        {{-- Materia --}}
                        <td>
                            {{ $grupo->materia->nombre ?? 'Sin asignar' }}
                            <br>
                            <small class="text-muted">
                                {{ $grupo->materia->clave ?? '' }} — {{ $grupo->materia->creditos ?? '' }} créditos
                            </small>
                        </td>

                        {{-- Horario solo hora --}}
                        <td>{{ $grupo->horario }}</td>

                        {{-- Maestro --}}
                        <td>{{ $grupo->maestro->name ?? 'No asignado' }}</td>

                        {{-- Acciones --}}
                        <td>
                            <a href="{{ route('coordinador.grupos.edit', $grupo->id) }}" class="btn btn-warning btn-sm">Editar</a>

                            <form action="{{ route('coordinador.grupos.destroy', $grupo->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este grupo?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
