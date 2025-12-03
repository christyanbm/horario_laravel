@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Grupo</h1>

    <form action="{{ route('grupos.update', $grupo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre del Grupo</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $grupo->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Cupo Máximo</label>
            <input type="number" name="cupo_max" class="form-control" value="{{ old('cupo_max', $grupo->cupo_max) }}" required>
        </div>



        {{-- Materia --}}
        <div class="mb-3">
            <label class="form-label">Materia</label>
            <select name="materia_id" class="form-select" required>
                @foreach($materias as $materia)
                    <option value="{{ $materia->id }}" {{ $grupo->materia_id == $materia->id ? 'selected' : '' }}>
                        {{ $materia->nombre }} — Semestre {{ $materia->semestre }} ({{ $materia->creditos }} créditos)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Hora Inicio</label>
            <input type="time" name="hora_inicio" class="form-control"
                   value="{{ old('hora_inicio', $grupo->hora_inicio) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Hora Fin</label>
            <input type="time" name="hora_fin" class="form-control"
                   value="{{ old('hora_fin', $grupo->hora_fin) }}" required>
        </div>

        {{-- Maestro --}}
        <div class="mb-3">
            <label class="form-label">Maestro</label>
            <select name="maestro_id" class="form-select">
                <option value="">-- Sin maestro --</option>

                @foreach($maestros as $maestro)
                    <option value="{{ $maestro->id }}" {{ $grupo->maestro_id == $maestro->id ? 'selected' : '' }}>
                        {{ $maestro->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('grupos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
