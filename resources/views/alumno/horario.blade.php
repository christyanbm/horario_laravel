@extends('layouts.app')
@include('partials.menu')

@section('title', 'Inscripción de Horario')

@section('content')
<div class="container mt-4">


    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary">Selección de Horario</h2>
            <p class="text-muted">Bienvenido. Selecciona las materias para tu próximo ciclo.</p>
        </div>
        <a href="{{ route('alumno.materias') }}">
            <i class="bi bi-calendar-check"></i> Ver Mi Horario Actual
        </a>
    </div>


    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Materias Disponibles</h5>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle" id="materiasTable">
                        <thead class="table-light">
                            <tr>
                                <th>Materia</th>
                                <th>Docente</th>
                                <th>Horario</th>
                                <th>Cupo</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grupos as $grupo)
                            @if($grupo->materia)
                            <tr id="row-{{ $grupo->id }}" data-selected="{{ in_array($grupo->id, $seleccionadosIds) ? '1' : '0' }}">
                                <td>
                                    <span class="fw-bold">{{ $grupo->materia->nombre }}</span><br>
                                    <small class="text-muted">{{ $grupo->nombre }}</small>
                                </td>
                                <td>{{ $grupo->maestro->name ?? 'Sin asignar' }}</td>
                                <td>{{ $grupo->hora_inicio->format('H:i') }} - {{ $grupo->hora_fin->format('H:i') }}</td>
                                <td>
                                    @if($grupo->cupoDisponible > 0)
                                    <span class="badge bg-success">{{ $grupo->cupoDisponible }} Disp.</span>
                                    @else
                                    <span class="badge bg-danger">Lleno</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if(in_array($grupo->id, $seleccionadosIds))
                                    <button class="btn btn-secondary btn-sm" disabled>Ya inscrito</button>
                                    @elseif($grupo->cupoDisponible > 0)
                                    <button class="btn btn-outline-primary btn-sm btn-select" onclick="toggleMateria(
                                                    {{ $grupo->id }},
                                                    {{ $grupo->materia->creditos }},
                                                    '{{ $grupo->materia->nombre }}',
                                                    '{{ $grupo->hora_inicio->format('H:i') }}',
                                                    '{{ $grupo->hora_fin->format('H:i') }}'
                                                )">
                                        <i class="bi bi-plus-lg"></i> Agregar
                                    </button>
                                    @else
                                    <button class="btn btn-secondary btn-sm" disabled>No disponible</button>
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tu Carga Académica</h5>
                </div>
                <div class="card-body">

                    <div id="conflictMessage" class="alert alert-danger d-none mb-2" role="alert"></div>


                    <ul class="list-group list-group-flush mb-3" id="listaSeleccionados">
                        <li class="list-group-item text-center text-muted small fst-italic" id="emptyState">
                            No has seleccionado materias aún.
                        </li>
                    </ul>

                    {{-- Créditos --}}
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small fw-bold">Créditos Seleccionados</span>
                            <span class="small" id="creditCounter">0 / {{ $creditosDisponibles }} Máx</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" id="creditBar" role="progressbar" style="width: 0%">
                            </div>
                        </div>
                    </div>

                    {{-- Botón Confirmar --}}
                    <form action="{{ route('alumno.inscribirse') }}" method="POST" id="formInscripcion">
                        @csrf
                        <input type="hidden" name="materias_seleccionadas" id="inputMaterias">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg" id="btnConfirmar" disabled>
                                Confirmar Horario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    let seleccionadas = [];
    let creditosTotales = 0;
    const maxCreditos = {
        {
            $creditosDisponibles
        }
    };

    function toggleMateria(id, creditos, nombre, horaInicio, horaFin) {
        const btn = document.querySelector(`#row-${id} .btn-select`);
        const conflictDiv = document.getElementById('conflictMessage');

        // Limpiar mensajes
        conflictDiv.classList.add('d-none');
        conflictDiv.innerText = '';

        const parseTime = t => {
            const [h, m] = t.split(':').map(Number);
            return h * 60 + m; // Convertir a minutos
        }

        const nuevoInicio = parseTime(horaInicio);
        const nuevoFin = parseTime(horaFin);

        const index = seleccionadas.findIndex(m => m.id === id);

        if (index === -1) {
            // Revisar conflictos con materias seleccionadas
            for (let m of seleccionadas) {
                const selInicio = parseTime(m.horaInicio);
                const selFin = parseTime(m.horaFin);

                // Verificar si hay solapamiento
                if (!(nuevoFin <= selInicio || nuevoInicio >= selFin)) {
                    conflictDiv.innerText = `⚠️ Conflicto de horario: "${nombre}" coincide con "${m.nombre}"`;
                    conflictDiv.classList.remove('d-none');
                    return; // Bloquear inscripción
                }
            }

            // Verificar límite de créditos
            if (creditosTotales + creditos > maxCreditos) {
                conflictDiv.innerText =
                    `⚠️ No puedes agregar "${nombre}", excedes el límite de créditos (${maxCreditos})`;
                conflictDiv.classList.remove('d-none');
                return;
            }

            // Agregar materia
            seleccionadas.push({
                id
                , creditos
                , nombre
                , horaInicio
                , horaFin
            });
            creditosTotales += creditos;

            btn.classList.remove('btn-outline-primary');
            btn.classList.add('btn-danger');
            btn.innerHTML = '<i class="bi bi-trash"></i> Quitar';
            document.getElementById(`row-${id}`).classList.add('table-primary');

        } else {
            // Quitar materia
            const materia = seleccionadas[index];
            seleccionadas.splice(index, 1);
            creditosTotales -= materia.creditos;

            btn.classList.remove('btn-danger');
            btn.classList.add('btn-outline-primary');
            btn.innerHTML = '<i class="bi bi-plus-lg"></i> Agregar';
            document.getElementById(`row-${id}`).classList.remove('table-primary');
        }

        updateSidebar();
    }


    function updateSidebar() {
        const list = document.getElementById('listaSeleccionados');
        const emptyState = document.getElementById('emptyState');
        const creditCounter = document.getElementById('creditCounter');
        const creditBar = document.getElementById('creditBar');
        const btnConfirmar = document.getElementById('btnConfirmar');

        creditCounter.innerText = `${creditosTotales} / ${maxCreditos} Máx`;
        creditBar.style.width = `${(creditosTotales / maxCreditos) * 100}%`;

        if (seleccionadas.length === 0) {
            list.innerHTML = '';
            list.appendChild(emptyState);
            emptyState.style.display = 'block';
            btnConfirmar.disabled = true;
        } else {
            emptyState.style.display = 'none';
            list.innerHTML = '';
            seleccionadas.forEach(m => {
                const li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between align-items-center small';
                li.innerHTML =
                    `${m.nombre}<span class="badge bg-secondary rounded-pill">${m.creditos} Cr.</span>`;
                list.appendChild(li);
            });
            btnConfirmar.disabled = false;
        }
    }

    document.getElementById('formInscripcion').addEventListener('submit', function(e) {
        const ids = seleccionadas.map(m => m.id);
        document.getElementById('inputMaterias').value = JSON.stringify(ids);
    });

</script>

<style>
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }

    .table-primary {
        background-color: rgba(13, 110, 253, 0.15) !important;
    }

    tr[data-selected="1"] {
        background-color: rgba(220, 53, 69, 0.1);
    }

</style>
@endsection
