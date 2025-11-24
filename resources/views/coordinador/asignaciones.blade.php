@extends('layouts.app')

@section('title', 'Gestión de Carga Académica')

@section('content')
<div class="container mt-4">

    {{-- 1. Encabezado y Herramientas --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-0">Asignación de Docentes</h2>
            <p class="text-muted mb-0">Gestión de carga académica • Periodo 2025-1</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAsignacion" onclick="prepararModal('nuevo')">
            <i class="bi bi-plus-lg"></i> Nueva Asignación
        </button>
    </div>

    {{-- 2. Filtros de Búsqueda --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body bg-light">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control border-start-0" placeholder="Buscar materia o maestro...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">Todos los Semestres</option>
                        <option value="1">1er Semestre</option>
                        <option value="3">3er Semestre</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">Estado: Todos</option>
                        <option value="asignado">Asignados</option>
                        <option value="pendiente">Pendientes (Vacantes)</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Tabla de Asignaciones --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary text-uppercase small">
                        <tr>
                            <th class="ps-4">Materia / Clave</th>
                            <th>Grupo & Horario</th>
                            <th>Docente Asignado</th>
                            <th class="text-center">Estado</th>
                            <th class="text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        {{-- CASO 1: Asignación Correcta --}}
                        <tr>
                            <td class="ps-4">
                                <span class="fw-bold d-block text-dark">Física I</span>
                                <small class="text-muted">FIS-101 • 4 Créditos</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border mb-1">Grupo A</span><br>
                                <small class="text-muted"><i class="bi bi-clock"></i> Lun-Mie 08:00-10:00</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-primary text-white rounded-circle me-2 d-flex justify-content-center align-items-center" style="width:35px; height:35px;">ML</div>
                                    <div>
                                        <span class="fw-bold d-block">María López</span>
                                        <small class="text-muted">Plaza Titular A</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill">Confirmado</span>
                            </td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-light border" title="Editar" onclick="prepararModal('editar', 'María López', 'Física I')">
                                    <i class="bi bi-pencil-fill text-muted"></i>
                                </button>
                                <button class="btn btn-sm btn-light border text-danger" title="Desasignar">
                                    <i class="bi bi-person-x-fill"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- CASO 2: Vacante (Sin maestro) --}}
                        <tr class="table-warning bg-opacity-10">
                            <td class="ps-4">
                                <span class="fw-bold d-block text-dark">Matemáticas Discretas</span>
                                <small class="text-muted">MAT-204 • 5 Créditos</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border mb-1">Grupo B</span><br>
                                <small class="text-muted"><i class="bi bi-clock"></i> Mar-Jue 10:00-12:00</small>
                            </td>
                            <td>
                                <span class="text-muted fst-italic">-- Sin Asignar --</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-warning text-dark rounded-pill">Vacante</span>
                            </td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-primary" onclick="prepararModal('asignar', null, 'Matemáticas Discretas')">
                                    <i class="bi bi-person-plus-fill"></i> Asignar
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3">
            <nav>
                <ul class="pagination justify-content-center mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

{{-- MODAL DE ASIGNACIÓN (Simulado) --}}
<div class="modal fade" id="modalAsignacion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalTitle">Asignar Docente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAsignacion">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Materia y Grupo</label>
                        <input type="text" class="form-control bg-light" id="inputMateria" value="Física I - Grupo A" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Seleccionar Docente</label>
                        <select class="form-select" id="selectDocente">
                            <option selected disabled>Buscar maestro...</option>
                            <option value="1">María López (Disponible)</option>
                            <option value="2">Juan Pérez (Cruce de horario)</option>
                            <option value="3">Ana Torres (Disponible)</option>
                        </select>
                        <div class="form-text text-success" id="availabilityMsg" style="display:none">
                            <i class="bi bi-check-circle"></i> Docente disponible en este horario.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tipo de Contrato</label>
                        <select class="form-select">
                            <option>Titular</option>
                            <option>Interino</option>
                            <option>Suplente</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarAsignacion()">
                    <span id="btnText">Guardar Cambios</span>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT PARA PROTOTIPO (Simula interacción del Modal) --}}
<script>
    // Configura el modal dependiendo si es Editar o Asignar nuevo
    function prepararModal(accion, docente, materia) {
        const modal = new bootstrap.Modal(document.getElementById('modalAsignacion'));
        const titulo = document.getElementById('modalTitle');
        const inputMateria = document.getElementById('inputMateria');
        
        if (accion === 'nuevo') {
            titulo.innerText = "Nueva Asignación";
            inputMateria.readOnly = false;
            inputMateria.value = "";
            inputMateria.placeholder = "Buscar materia...";
        } else if (accion === 'asignar') {
            titulo.innerText = "Asignar Vacante";
            inputMateria.value = materia + " - Grupo B";
            inputMateria.readOnly = true;
        } else {
            titulo.innerText = "Editar Asignación";
            inputMateria.value = materia + " - Grupo A";
            inputMateria.readOnly = true;
        }
        
        modal.show();
    }

    // Simula guardar
    function guardarAsignacion() {
        const btnText = document.getElementById('btnText');
        const original = btnText.innerText;
        
        // Efecto de carga
        btnText.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Guardando...';
        
        setTimeout(() => {
            // Cerrar modal y mostrar alerta (simulado)
            const modalEl = document.getElementById('modalAsignacion');
            const modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
            
            btnText.innerText = original;
            alert("Asignación guardada correctamente (Prototipo)");
        }, 1000);
    }

    // Pequeño detalle de UX: Mostrar disponibilidad al cambiar select
    document.getElementById('selectDocente').addEventListener('change', function() {
        const msg = document.getElementById('availabilityMsg');
        if(this.value === '2') {
            msg.style.display = 'block';
            msg.className = 'form-text text-danger';
            msg.innerHTML = '<i class="bi bi-exclamation-triangle"></i> Advertencia: Cruce de horario con otra materia.';
        } else {
            msg.style.display = 'block';
            msg.className = 'form-text text-success';
            msg.innerHTML = '<i class="bi bi-check-circle"></i> Docente disponible.';
        }
    });
</script>

@endsection