@extends('layouts.app')

@section('title', 'Gestión de Grupos')

@section('content')
<div class="container mt-4">

    {{-- 1. Encabezado y Botón de Creación --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-0">Gestión de Grupos</h2>
            <p class="text-muted mb-0">Administración de cupos y tutores • Ciclo 2025-1</p>
        </div>
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalGrupo">
            <i class="bi bi-plus-lg"></i> Nuevo Grupo
        </button>
    </div>

    {{-- 2. Filtros --}}
    <div class="card shadow-sm border-0 mb-4 bg-light">
        <div class="card-body py-3">
            <div class="row g-3">
                <div class="col-md-4">
                    <select class="form-select">
                        <option value="">Todas las Carreras</option>
                        <option value="isc">Ing. Sistemas Computacionales</option>
                        <option value="ind">Ing. Industrial</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">Semestre: Todos</option>
                        <option value="1">1er Semestre</option>
                        <option value="3">3er Semestre</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">Turno: Ambos</option>
                        <option value="M">Matutino</option>
                        <option value="V">Vespertino</option>
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-outline-secondary">Filtrar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Tabla Avanzada --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary text-uppercase small">
                        <tr>
                            <th class="ps-4">Identificador</th>
                            <th>Carrera / Semestre</th>
                            <th style="width: 25%;">Capacidad (Alumnos)</th>
                            <th>Tutor Asignado</th>
                            <th class="text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        {{-- Grupo 1: Normal --}}
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded p-2 me-3 fw-bold text-center" style="width: 50px;">
                                        3°A
                                    </div>
                                    <div>
                                        <span class="fw-bold d-block text-dark">Grupo A - 2025</span>
                                        <span class="badge bg-info text-dark border"><i class="bi bi-sun"></i> Matutino</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="d-block text-dark fw-bold">Ing. Sistemas</span>
                                <small class="text-muted">Plan 2018</small>
                            </td>
                            <td>
                                {{-- Barra de Progreso de Cupo --}}
                                <div class="d-flex justify-content-between small mb-1">
                                    <span>Inscritos: <strong>25</strong></span>
                                    <span class="text-muted">Max: 40</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 62%"></div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-small bg-light rounded-circle text-secondary me-2 border d-flex justify-content-center align-items-center" style="width:32px; height:32px;">JP</div>
                                    <span class="small">Ing. Juan Pérez</span>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-light border btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Opciones
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-people me-2"></i> Ver Alumnos</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-calendar3 me-2"></i> Ver Horario</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalGrupo"><i class="bi bi-pencil me-2"></i> Editar</a></li>
                                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i> Eliminar</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        {{-- Grupo 2: Lleno (Alerta) --}}
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning text-dark rounded p-2 me-3 fw-bold text-center" style="width: 50px;">
                                        1°B
                                    </div>
                                    <div>
                                        <span class="fw-bold d-block text-dark">Grupo B - 2025</span>
                                        <span class="badge bg-secondary border"><i class="bi bi-moon"></i> Vespertino</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="d-block text-dark fw-bold">Ing. Industrial</span>
                                <small class="text-muted">Plan 2020</small>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-danger fw-bold">¡Lleno!</span>
                                    <span class="text-muted">40/40</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"></div>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted small fst-italic">-- Sin Tutor --</span>
                                <button class="btn btn-link btn-sm p-0 text-decoration-none ms-1">Asignar</button>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-light border btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                        Opciones
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow">
                                        <li><a class="dropdown-item" href="#">Ver Alumnos</a></li>
                                        <li><a class="dropdown-item" href="#">Ver Horario</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#">Editar</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3">
             <small class="text-muted">Mostrando 2 de 15 grupos activos.</small>
        </div>
    </div>
</div>

{{-- MODAL CREAR/EDITAR GRUPO --}}
<div class="modal fade" id="modalGrupo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Configurar Grupo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-2 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold">Nombre Oficial</label>
                            <input type="text" class="form-control" placeholder="Ej. Grupo A">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Cupo Max</label>
                            <input type="number" class="form-control" value="40">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Carrera y Semestre</label>
                        <select class="form-select mb-2">
                            <option>Ingeniería en Sistemas Computacionales</option>
                        </select>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="semestre" id="s1" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="s1">1°</label>
                            <input type="radio" class="btn-check" name="semestre" id="s3" autocomplete="off">
                            <label class="btn btn-outline-primary" for="s3">3°</label>
                            <input type="radio" class="btn-check" name="semestre" id="s5" autocomplete="off">
                            <label class="btn btn-outline-primary" for="s5">5°</label>
                            <input type="radio" class="btn-check" name="semestre" id="s7" autocomplete="off">
                            <label class="btn btn-outline-primary" for="s7">7°</label>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Turno</label>
                            <select class="form-select">
                                <option>Matutino (7:00 - 14:00)</option>
                                <option>Vespertino (14:00 - 21:00)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tutor</label>
                            <select class="form-select">
                                <option selected>Sin asignar</option>
                                <option>Ing. Juan Pérez</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar Grupo</button>
            </div>
        </div>
    </div>
</div>

@endsection