@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Control de Asistencia')

@section('content')
<div class="container mt-4" x-data="asistenciaApp()">
    {{-- x-data sugiere AlpineJS, pero usaré JS Vanilla abajo para compatibilidad --}}

    {{-- 1. Encabezado de la Clase --}}
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <h2 class="fw-bold text-primary mb-0">Control de Asistencia</h2>
            <p class="text-muted mb-0">
                <i class="bi bi-book"></i> Matemáticas Discretas • Grupo A
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <label class="fw-bold text-secondary small me-2">Fecha:</label>
            <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
        </div>
    </div>

    <form action="#" method="POST">
        @csrf

        <div class="row">
            {{-- 2. Panel Principal --}}
            <div class="col-lg-9">
                <div class="card shadow-sm border-0">

                    {{-- Barra de Herramientas --}}
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-secondary">Lista de Estudiantes</h5>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="marcarTodosPresentes()">
                            <i class="bi bi-check-all"></i> Marcar Todos Presentes
                        </button>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-secondary text-uppercase small">
                                    <tr>
                                        <th class="ps-4">Estudiante</th>
                                        <th class="text-center" style="width: 350px;">Estado</th>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Simulación de datos --}}
                                    @php
                                        $alumnos = [
                                            ['id' => 1, 'nombre' => 'Alvarez, Luis', 'foto' => 'LA'],
                                            ['id' => 2, 'nombre' => 'Benitez, Carla', 'foto' => 'CB'],
                                            ['id' => 3, 'nombre' => 'Castro, Mario', 'foto' => 'MC'],
                                        ];
                                    @endphp

                                    @foreach($alumnos as $alumno)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar bg-light text-primary border rounded-circle me-3 fw-bold d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                                                    {{ $alumno['foto'] }}
                                                </div>
                                                <div>
                                                    <span class="fw-bold text-dark">{{ $alumno['nombre'] }}</span>
                                                    <div class="small text-muted">Mat: 1930{{ $alumno['id'] }}00</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            {{-- Grupo de Botones (Radio Buttons estilizados) --}}
                                            <div class="btn-group" role="group" aria-label="Asistencia {{ $alumno['id'] }}">

                                                {{-- Opción: Presente --}}
                                                <input type="radio" class="btn-check radio-asistencia" name="asistencia[{{ $alumno['id'] }}]" id="btn-p-{{ $alumno['id'] }}" value="P" checked onclick="actualizarContadores()">
                                                <label class="btn btn-outline-success" for="btn-p-{{ $alumno['id'] }}">
                                                    <i class="bi bi-check-lg"></i> Presente
                                                </label>

                                                {{-- Opción: Retardo --}}
                                                <input type="radio" class="btn-check radio-asistencia" name="asistencia[{{ $alumno['id'] }}]" id="btn-r-{{ $alumno['id'] }}" value="R" onclick="actualizarContadores()">
                                                <label class="btn btn-outline-warning" for="btn-r-{{ $alumno['id'] }}">
                                                    <i class="bi bi-clock"></i> Retardo
                                                </label>

                                                {{-- Opción: Falta --}}
                                                <input type="radio" class="btn-check radio-asistencia" name="asistencia[{{ $alumno['id'] }}]" id="btn-f-{{ $alumno['id'] }}" value="F" onclick="actualizarContadores()">
                                                <label class="btn btn-outline-danger" for="btn-f-{{ $alumno['id'] }}">
                                                    <i class="bi bi-x-lg"></i> Falta
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm border-0 bg-light" placeholder="Nota opcional...">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white py-3 text-end sticky-bottom">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="bi bi-save me-2"></i> Guardar Lista
                        </button>
                    </div>
                </div>
            </div>

            {{-- 3. Panel Lateral: Resumen en Vivo --}}
            <div class="col-lg-3">
                <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                    <div class="card-header bg-dark text-white py-3">
                        <h6 class="mb-0">Resumen de Hoy</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Total Alumnos</span>
                            <span class="fw-bold" id="total-alumnos">3</span>
                        </div>
                        <hr>
                        <div class="row text-center g-2">
                            <div class="col-4">
                                <div class="p-2 rounded bg-success bg-opacity-10 text-success">
                                    <h4 class="fw-bold mb-0" id="count-presentes">3</h4>
                                    <small style="font-size: 10px;">PRESENTES</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 rounded bg-warning bg-opacity-10 text-warning text-dark">
                                    <h4 class="fw-bold mb-0" id="count-retardos">0</h4>
                                    <small style="font-size: 10px;">RETARDOS</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                                    <h4 class="fw-bold mb-0" id="count-faltas">0</h4>
                                    <small style="font-size: 10px;">FALTAS</small>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info mt-3 mb-0 small">
                            <i class="bi bi-info-circle"></i> Recuerda guardar los cambios antes de salir.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function marcarTodosPresentes() {
        // Selecciona todos los radio buttons con valor "P" y los marca
        document.querySelectorAll('input[value="P"]').forEach(radio => {
            radio.checked = true;
        });
        actualizarContadores();
    }

    function actualizarContadores() {
        let presentes = 0;
        let retardos = 0;
        let faltas = 0;

        // Cuenta según lo que esté seleccionado (checked)
        document.querySelectorAll('.radio-asistencia:checked').forEach(radio => {
            if(radio.value === 'P') presentes++;
            if(radio.value === 'R') retardos++;
            if(radio.value === 'F') faltas++;
        });

        // Actualiza el DOM
        document.getElementById('count-presentes').innerText = presentes;
        document.getElementById('count-retardos').innerText = retardos;
        document.getElementById('count-faltas').innerText = faltas;
    }

    // Ejecutar al inicio para cuadrar números
    document.addEventListener("DOMContentLoaded", actualizarContadores);
</script>

<style>
    /* Estilo para que el footer se pegue abajo si la lista es larga */
    .sticky-bottom {
        position: sticky;
        bottom: 0;
        z-index: 10;
        box-shadow: 0 -4px 10px rgba(0,0,0,0.05);
    }
</style>
@endsection
