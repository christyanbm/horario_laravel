@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Editar Grupo</h2>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('jefe.grupos.update', $grupo->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nombre del grupo --}}
                <div class="mb-3">
                    <label class="form-label">Nombre del Grupo</label>
                    <input type="text" name="nombre" class="form-control" 
                        value="{{ old('nombre', $grupo->nombre) }}" required>
                </div>

                {{-- Materia --}}
                <div class="mb-3">
                    <label class="form-label">Materia</label>
                    <select name="materia_id" class="form-control" required>
                        <option value="">Seleccione una materia</option>
                        @foreach ($materias as $materia)
                            <option value="{{ $materia->id }}"
                                {{ $grupo->materia_id == $materia->id ? 'selected' : '' }}>
                                {{ $materia->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Maestro asignado (opcional) --}}
                <div class="mb-3">
                    <label class="form-label">Maestro Asignado</label>
                    <select name="maestro_id" class="form-control">
                        <option value="">Sin asignar</option>
                        @foreach ($maestros as $maestro)
                            <option value="{{ $maestro->id }}"
                                {{ $grupo->maestro_id == $maestro->id ? 'selected' : '' }}>
                                {{ $maestro->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Botones --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('jefe.grupos.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
