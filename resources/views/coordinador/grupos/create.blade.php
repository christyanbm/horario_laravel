@extends('layouts.app')

@section('content')
    @include('partials.menu')

    <div class="container">
        <h1 class="mb-4">Crear Grupo</h1>

        <form action="{{ route('coordinador.grupos.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Grupo</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>

            <div class="mb-3">
                <label for="cupo_max" class="form-label">Cupo Máximo</label>
                <input type="number" name="cupo_max" class="form-control" value="{{ old('cupo_max') }}" required>
            </div>

           
            <div class="mb-3">
                <label for="materia_id" class="form-label">Materia</label>
                <select name="materia_id" class="form-select" required>
                    <option value="">-- Seleccionar materia --</option>
                    @foreach($materias as $materia)
                        <option value="{{ $materia->id }}" {{ old('materia_id') == $materia->id ? 'selected' : '' }}>
                            {{ $materia->nombre }} — Semestre {{ $materia->semestre }} ({{ $materia->creditos }} créditos)
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="hora_inicio" class="form-label">Hora Inicio</label>
                <input type="time" name="hora_inicio" class="form-control" value="{{ old('hora_inicio') }}" required>
            </div>

            <div class="mb-3">
                <label for="hora_fin" class="form-label">Hora Fin</label>
                <input type="time" name="hora_fin" class="form-control" value="{{ old('hora_fin') }}" required>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('coordinador.grupos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
