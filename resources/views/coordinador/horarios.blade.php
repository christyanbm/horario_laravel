@extends('layouts.app')

@section('title', 'Gestión de Horarios')

@section('content')
<div class="container mt-4" x-data="horariosApp()"> 

    {{-- 1. Barra de Herramientas y Filtros --}}
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 border-bottom pb-3">
        <div>
            <h2 class="fw-bold text-primary mb-1">Gestión de Horarios</h2>
            <p class="text-muted mb-0">Configuración de espacios y tiempos por grupo.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary">
                <i class="bi bi-printer"></i> Imprimir
            </button>
            <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalHorario">
                <i class="bi bi-plus-lg"></i> Agregar Clase
            </button>
        </div>
    </div>

    {{-- Filtros de Contexto (Obligatorios para ordenar la vista) --}}
    <div class="card shadow-sm border-0 mb-4 bg-light">
        <div class="card-body py-3">
            <div class="row g-2 align-items-center">
                <div class="col-auto fw-bold text-secondary">
                    <i class="bi bi-funnel-fill"></i> Filtrar por:
                </div>
                <div class="col-md-3">
                    <select class="form-select form-select-sm">
                        <option>Ingeniería en Sistemas</option>
                        <option>Lic. en Administración</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select form-select-sm">
                        <option>3er Semestre</option>
                        <option>5to Semestre</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select form-select-sm fw-bold text-dark">
                        <option>Grupo A</option>
                        <option>Grupo B</option>
                    </select>
                </div>
                <div class="col text-end">
                    <span class="badge bg-success bg-opacity-10 text-success border border-success">
                        <i class="bi bi-check-circle"></i> Horario Validado
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Pestañas de Visualización --}}
    <ul class="nav nav-tabs mb-3" id="tabHorarios" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold" id="grafica-tab" data-bs-toggle="tab" data-bs-target="#grafica" type="button">
                <i class="bi bi-calendar-week"></i> Vista Semanal
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold" id="lista-tab" data-bs-toggle="tab" data-bs-target="#lista" type="button">
                <i class="bi bi-list-task"></i> Listado Detallado
            </button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        
        {{-- VISTA 1: GRID SEMANAL (Visual) --}}
        <div class="tab-pane fade show active" id="grafica" role="tabpanel">
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle mb-0 table-sm">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th style="width: 10%">Hora</th>
                                    <th style="width: 18%">Lunes</th>
                                    <th style="width: 18%">Martes</th>
                                    <th style="width: 18%">Miércoles</th>
                                    <th style="width: 18%">Jueves</th>
                                    <th style="width: 18%">Viernes</th>
                                </tr>
                            </thead>
                            <tbody class="small">
                                {{-- Bloque 7:00 - 8:00 --}}
                                <tr>
                                    <td class="fw-bold bg-light text-muted">07:00 - 08:00</td>
                                    <td></td> {{-- Lunes Libre --}}
                                    <td class="bg-primary text-white rounded p-2 position-relative">
                                        <strong>Prog. Orientada Obj.</strong><br>
                                        Aula 101
                                        <div class="position-absolute top-0 end-0 p-1">
                                            <i class="bi bi-pencil-square text-white-50" style="cursor:pointer"></i>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td class="bg-primary text-white rounded p-2">
                                        <strong>Prog. Orientada Obj.</strong><br>
                                        Aula 101
                                    </td>
                                    <td></td>
                                </tr>

                                {{-- Bloque 8:00 - 9:00 (Con Conflicto Simulado) --}}
                                <tr>
                                    <td class="fw-bold bg-light text-muted">08:00 - 09:00</td>
                                    <td class="bg-info text-dark bg-opacity-25 rounded p-2 border border-info">
                                        <strong>Matemáticas</strong><br>
                                        Juan Pérez<br>
                                        <span class="badge bg-secondary">Aula 202</span>
                                    </td>
                                    <td class="bg-danger text-white rounded p-2 border border-danger shadow-sm">
                                        <i class="bi bi-exclamation-triangle-fill"></i> <strong>CONFLICTO</strong><br>
                                        2 Materias asignadas<br>
                                        (Física / Inglés)
                                    </td>
                                    <td class="bg-info text-dark bg-opacity-25 rounded p-2 border border-info">
                                        <strong>Matemáticas</strong><br>
                                        Aula 202
                                    </td>
                                    <td></td>
                                    <td class="bg-info text-dark bg-opacity-25 rounded p-2 border border-info">
                                        <strong>Matemáticas</strong><br>
                                        Aula 202
                                    </td>
                                </tr>
                                
                                {{-- Más horas... --}}
                                <tr>
                                    <td class="fw-bold bg-light text-muted">09:00 - 10:00</td>
                                    <td class="text-muted bg-light diagonal-stripe">Receso</td>
                                    <td class="text-muted bg-light diagonal-stripe">Receso</td>
                                    <td class="text-muted bg-light diagonal-stripe">Receso</td>
                                    <td class="text-muted bg-light diagonal-stripe">Receso</td>
                                    <td class="text-muted bg-light diagonal-stripe">Receso</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- VISTA 2: LISTA (Edición) --}}
        <div class="tab-pane fade" id="lista" role="tabpanel">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Materia</th>
                                <th>Docente</th>
                                <th>Día</th>
                                <th>Horario</th>
                                <th>Aula</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold">Matemáticas</td>
                                <td>Juan Pérez</td>
                                <td><span class="badge bg-primary">Lunes</span></td>
                                <td>08:00 - 09:00</td>
                                <td>202</td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Física II</td>
                                <td>María López</td>
                                <td><span class="badge bg-danger">Martes</span></td>
                                <td class="text-danger fw-bold">08:00 - 09:00</td>
                                <td class="text-danger">101</td>
                                <td class="text-end">
                                    <span class="badge bg-danger mb-1">Cruce de Aula</span><br>
                                    <button class="btn btn-sm btn-danger">Resolver</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL AGREGAR/EDITAR (Prototipo) --}}
<div class="modal fade" id="modalHorario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">Programar Clase</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Materia</label>
                        <select class="form-select">
                            <option>Matemáticas Discretas (5 Créditos)</option>
                            <option>Programación I (6 Créditos)</option>
                        </select>
                    </div>
                    
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small text-muted">Día</label>
                            <select class="form-select">
                                <option>Lunes</option>
                                <option>Martes</option>
                                <option>Miércoles</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted">Aula</label>
                            <select class="form-select">
                                <option>Lab 1</option>
                                <option>Aula 202</option>
                                <option>Aula 101 (Ocupada 10-11)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small text-muted">Hora Inicio</label>
                            <input type="time" class="form-control" value="07:00">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted">Hora Fin</label>
                            <input type="time" class="form-control" value="09:00">
                        </div>
                    </div>
                    
                    <div class="alert alert-warning small d-flex align-items-center">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        El maestro Juan Pérez tiene clase en otro grupo a esta hora.
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar Horario</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilo para las horas de receso */
    .diagonal-stripe {
        background-image: linear-gradient(45deg, rgba(0,0,0,.05) 25%, transparent 25%, transparent 50%, rgba(0,0,0,.05) 50%, rgba(0,0,0,.05) 75%, transparent 75%, transparent);
        background-size: 10px 10px;
    }
</style>
@endsection