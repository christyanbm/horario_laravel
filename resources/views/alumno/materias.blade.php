@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Inscripción de Horario')

@section('content')
<div class="container mt-4" x-data="inscripcionApp()">
    {{-- Nota: x-data sugiere Alpine.js, pero usaré JS nativo abajo para que funcione sin dependencias extra --}}

    {{-- 1. Encabezado --}}
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <h2 class="fw-bold text-primary mb-0">Inscripción de Materias</h2>
            <small class="text-muted">Ciclo Escolar: Ene-Jun 2025</small>
        </div>
        <div>
            <span class="badge bg-light text-dark border p-2 me-2">
                <i class="bi bi-person-badge"></i> Matrícula: 1930256
            </span>
            <span class="badge bg-warning text-dark p-2">
                <i class="bi bi-exclamation-triangle"></i> Cierre: 25 de Ago
            </span>
        </div>
    </div>

    {{-- Mensajes de Sesión --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        {{-- 2. Columna Principal --}}
        <div class="col-lg-8">

            {{-- Pestañas de Navegación --}}
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold" id="lista-tab" data-bs-toggle="tab" data-bs-target="#lista" type="button">
                        <i class="bi bi-list-task"></i> Lista de Materias
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold" id="grafico-tab" data-bs-toggle="tab" data-bs-target="#grafico" type="button">
                        <i class="bi bi-calendar-week"></i> Vista Gráfica
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">

                {{-- TAB 1: Lista de Materias --}}
                <div class="tab-pane fade show active" id="lista" role="tabpanel">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            {{-- Buscador y Filtros --}}
                            <div class="row g-2 mb-3">
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control border-start-0" placeholder="Buscar materia o docente..." id="searchInput">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select">
                                        <option selected>Todos los semestres</option>
                                        <option value="1">1er Semestre</option>
                                        <option value="2">2do Semestre</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Tabla --}}
                            <div class="table-responsive">
                                <table class="table table-hover align-middle" id="materiasTable">
                                    <thead class="table-light text-secondary small text-uppercase">
                                        <tr>
                                            <th>Materia</th>
                                            <th>Horario</th>
                                            <th class="text-center">Créditos</th>
                                            <th class="text-center">Cupo</th>
                                            <th class="text-end">Selección</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Fila 1 --}}
                                        <tr id="row-1">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar bg-primary text-white rounded-circle me-2 d-flex justify-content-center align-items-center" style="width:40px; height:40px;">MD</div>
                                                    <div>
                                                        <span class="fw-bold d-block">Matemáticas Discretas</span>
                                                        <small class="text-muted"><i class="bi bi-person"></i> Ing. Juan Pérez</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border">Lun/Mie 08:00 - 10:00</span>
                                            </td>
                                            <td class="text-center">5</td>
                                            <td class="text-center"><span class="badge bg-success bg-opacity-10 text-success">5 Disp.</span></td>
                                            <td class="text-end">
                                                <button class="btn btn-outline-primary btn-sm btn-select" onclick="toggleMateria(1, 5, 'Matemáticas Discretas')">
                                                    <i class="bi bi-plus-lg"></i> Agregar
                                                </button>
                                            </td>
                                        </tr>

                                        {{-- Fila 2 (Conflicto simulado) --}}
                                        <tr id="row-2">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar bg-secondary text-white rounded-circle me-2 d-flex justify-content-center align-items-center" style="width:40px; height:40px;">P1</div>
                                                    <div>
                                                        <span class="fw-bold d-block">Programación I</span>
                                                        <small class="text-muted"><i class="bi bi-person"></i> Lic. Ana López</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border">Mar/Jue 10:00 - 12:00</span>
                                            </td>
                                            <td class="text-center">6</td>
                                            <td class="text-center"><span class="badge bg-danger bg-opacity-10 text-danger">Lleno</span></td>
                                            <td class="text-end">
                                                <button class="btn btn-secondary btn-sm" disabled>
                                                    <i class="bi bi-lock-fill"></i> Lleno
                                                </button>
                                            </td>
                                        </tr>

                                        {{-- Fila 3 --}}
                                        <tr id="row-3">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar bg-info text-white rounded-circle me-2 d-flex justify-content-center align-items-center" style="width:40px; height:40px;">BD</div>
                                                    <div>
                                                        <span class="fw-bold d-block">Base de Datos</span>
                                                        <small class="text-muted"><i class="bi bi-person"></i> Dr. House</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border">Vie 08:00 - 12:00</span>
                                            </td>
                                            <td class="text-center">5</td>
                                            <td class="text-center"><span class="badge bg-warning bg-opacity-10 text-warning text-dark">2 Disp.</span></td>
                                            <td class="text-end">
                                                <button class="btn btn-outline-primary btn-sm btn-select" onclick="toggleMateria(3, 5, 'Base de Datos')">
                                                    <i class="bi bi-plus-lg"></i> Agregar
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 2: Vista Gráfica (Grid CSS simple) --}}
                <div class="tab-pane fade" id="grafico" role="tabpanel">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="alert alert-info py-2 small">
                                <i class="bi bi-info-circle"></i> Aquí puedes ver cómo quedan distribuidas tus horas.
                            </div>
                            <!-- Ejemplo de Grid de Horario -->
                            <div class="table-responsive">
                                <table class="table table-bordered text-center table-sm small">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width:10%">Hora</th>
                                            <th style="width:18%">Lunes</th>
                                            <th style="width:18%">Martes</th>
                                            <th style="width:18%">Miércoles</th>
                                            <th style="width:18%">Jueves</th>
                                            <th style="width:18%">Viernes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">08:00</td>
                                            <td class="bg-primary text-white rounded slot-ocupado" style="display:none">Matemáticas</td> <!-- Simulación JS -->
                                            <td></td>
                                            <td class="bg-primary text-white rounded slot-ocupado" style="display:none">Matemáticas</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">09:00</td>
                                            <td class="bg-primary text-white rounded slot-ocupado" style="display:none">Matemáticas</td>
                                            <td></td>
                                            <td class="bg-primary text-white rounded slot-ocupado" style="display:none">Matemáticas</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">10:00</td>
                                            <td></td>
                                            <td class="text-muted bg-light">Prog I (Lleno)</td>
                                            <td></td>
                                            <td class="text-muted bg-light">Prog I (Lleno)</td>
                                            <td></td>
                                        </tr>
                                        <!-- Más horas... -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. Barra Lateral (Sticky) --}}
        <div class="col-lg-4">
            <div class="card shadow border-0 sticky-top" style="top: 20px; z-index: 100;">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0"><i class="bi bi-cart3"></i> Resumen de Carga</h5>
                </div>
                <div class="card-body">

                    {{-- Barra de Créditos --}}
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small fw-bold">Créditos Seleccionados</span>
                            <span class="small" id="creditCounter">0 / 30 Máx</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" id="creditBar" role="progressbar" style="width: 0%"></div>
                        </div>
                    </div>

                    {{-- Lista de Materias Seleccionadas --}}
                    <h6 class="text-muted small text-uppercase fw-bold mb-3">Materias Agregadas</h6>
                    <ul class="list-group list-group-flush mb-4" id="listaSeleccionados">
                        <li class="list-group-item text-center text-muted small fst-italic" id="emptyState">
                            No has seleccionado materias aún.
                        </li>
                        {{-- Se llena con JS --}}
                    </ul>

                    {{-- Totales y Botón --}}
                    <div class="d-grid gap-2">
                        <form action="#" method="POST" id="formInscripcion">
                            @csrf
                            {{-- Input oculto para enviar los IDs seleccionados --}}
                            <input type="hidden" name="materias_seleccionadas" id="inputMaterias">

                            <button type="button" class="btn btn-primary btn-lg w-100 shadow-sm" id="btnConfirmar" disabled>
                                Confirmar Horario
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT PARA INTERACTIVIDAD SIMPLE (Sin Vue/React) --}}
<script>
    let seleccionadas = [];
    let creditosTotales = 0;
    const maxCreditos = 30;

    function toggleMateria(id, creditos, nombre) {
        const index = seleccionadas.findIndex(m => m.id === id);
        const btn = document.querySelector(`#row-${id} .btn-select`);

        if (index === -1) {
            // Agregar
            if (creditosTotales + creditos > maxCreditos) {
                alert("¡Excedes el límite de créditos!");
                return;
            }
            seleccionadas.push({id, creditos, nombre});
            creditosTotales += creditos;

            // Estilos botón
            btn.classList.remove('btn-outline-primary');
            btn.classList.add('btn-danger');
            btn.innerHTML = '<i class="bi bi-trash"></i> Quitar';
            document.getElementById(`row-${id}`).classList.add('table-primary');

            // Simular vista gráfica (Solo para ejemplo Matemáticas ID 1)
            if(id === 1) document.querySelectorAll('.slot-ocupado').forEach(el => el.style.display = 'table-cell');

        } else {
            // Remover
            seleccionadas.splice(index, 1);
            creditosTotales -= creditos;

            // Estilos botón
            btn.classList.remove('btn-danger');
            btn.classList.add('btn-outline-primary');
            btn.innerHTML = '<i class="bi bi-plus-lg"></i> Agregar';
            document.getElementById(`row-${id}`).classList.remove('table-primary');

             if(id === 1) document.querySelectorAll('.slot-ocupado').forEach(el => el.style.display = 'none');
        }

        updateSidebar();
    }

    function updateSidebar() {
        const list = document.getElementById('listaSeleccionados');
        const emptyState = document.getElementById('emptyState');
        const creditCounter = document.getElementById('creditCounter');
        const creditBar = document.getElementById('creditBar');
        const btnConfirmar = document.getElementById('btnConfirmar');

        // Actualizar barra de créditos
        creditCounter.innerText = `${creditosTotales} / ${maxCreditos} Máx`;
        const porcentaje = (creditosTotales / maxCreditos) * 100;
        creditBar.style.width = `${porcentaje}%`;

        // Renderizar lista
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
                li.className = 'list-group-item d-flex justify-content-between align-items-center small animate__animated animate__fadeIn';
                li.innerHTML = `
                    ${m.nombre}
                    <span class="badge bg-secondary rounded-pill">${m.creditos} Cr.</span>
                `;
                list.appendChild(li);
            });
            btnConfirmar.disabled = false;
        }
    }
</script>

<style>
    /* Pequeños retoques visuales */
    .avatar { font-weight: bold; font-size: 0.9rem; }
    .nav-tabs .nav-link.active { border-bottom: 3px solid #0d6efd; color: #0d6efd; }
    .nav-tabs .nav-link { color: #6c757d; border: none; }
    .nav-tabs .nav-link:hover { color: #0d6efd; }
    .table-hover tbody tr:hover { background-color: rgba(13, 110, 253, 0.05); }
</style>
@endsection
