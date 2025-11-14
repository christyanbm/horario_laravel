@extends('layouts.app')

@section('title', 'Registrar Asistencias')

@section('nav')
<li class="nav-item">
    <a class="nav-link" href="/maestro">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/maestro/materias">
        <i class="fas fa-book"></i> Materias a Impartir
    </a>
</li>
<li class="nav-item">
    <a class="nav-link active" href="/maestro/asistencias">
        <i class="fas fa-clipboard-check"></i> Asistencias
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid py-5" style="background: linear-gradient(135deg,#f5f7fa 0%,#c3cfe2 100%); min-height: 80vh;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 text-primary font-weight-bold">
                <i class="fas fa-clipboard-list"></i> Registrar Asistencias
            </h2>
            <p class="lead text-muted">Registra la asistencia de tus alumnos por materia. Asistencias marcadas: <span id="contador-asistencias" class="badge bg-success">0</span></p>
        </div>

        {{-- Filtro --}}
        <div class="mb-4 text-center">
            <label for="filtro-materia" class="form-label fw-bold">Filtrar por Materia</label>
            <select class="form-select w-50 d-inline-block" id="filtro-materia">
                <option value="all" selected>Todas las Materias</option>
                @foreach($materiasISC as $materia)
                    <option value="{{ $materia }}">{{ $materia }}</option>
                @endforeach
            </select>
        </div>

        {{-- Cards de asistencia --}}
        <form id="form-asistencias" action="/maestro/guardar-asistencias" method="POST">
            @csrf
            <div class="row g-4">
                @foreach($alumnos as $alumno)
                    @foreach($materiasISC as $materia)
                        <div class="col-md-6 col-lg-4 materia-card" data-materia="{{ $materia }}">
                            <div class="card shadow-lg border-0 rounded-lg h-100" style="background: linear-gradient(135deg,#667eea 0%,#764ba2 100%); color:white;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title">{{ $alumno }}</h5>
                                    <p class="card-text"><strong>Materia:</strong> {{ $materia }}</p>
                                    <div class="form-check form-switch mt-auto">
                                        <input class="form-check-input asistencia-checkbox" type="checkbox" name="asistencia[{{ $alumno }}][{{ $materia }}]" id="asistencia-{{ $alumno }}-{{ $materia }}">
                                        <label class="form-check-label" for="asistencia-{{ $alumno }}-{{ $materia }}">Asistió</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Guardar Asistencias
                </button>
            </div>
        </form>

        <div class="text-center mt-5">
            <a href="/maestro" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-arrow-left"></i> Volver al Dashboard
            </a>
        </div>

        <div id="alert-container" class="mt-4"></div>
    </div>
</div>

<script>
    const filtroMateria = document.getElementById('filtro-materia');
    const cards = document.querySelectorAll('.materia-card');
    const checkboxes = document.querySelectorAll('.asistencia-checkbox');
    const contador = document.getElementById('contador-asistencias');

    filtroMateria.addEventListener('change', function() {
        const selected = this.value;
        cards.forEach(card => {
            card.style.display = (selected === 'all' || card.dataset.materia === selected) ? 'block' : 'none';
        });
        actualizarContador();
    });

    function actualizarContador() {
        const checked = document.querySelectorAll('.asistencia-checkbox:checked').length;
        contador.textContent = checked;
    }

    checkboxes.forEach(cb => cb.addEventListener('change', actualizarContador));
</script>

<style>
    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }
    .asistencia-checkbox {
        cursor: pointer;
    }
</style>
@endsection
