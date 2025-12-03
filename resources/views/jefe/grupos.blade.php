@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Gestión de Grupos')

@section('content')
<div class="container mt-4">

    {{-- 1. Encabezado y Botón de Creación --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-0">Gestión de Grupos</h2>
            <p class="text-muted mb-0">Administración de cupos y maestros • Ciclo 2025-1</p>
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
                    <select class="form-select" wire:model="filtroCarrera">
                        <option value="">Todas las Carreras</option>
                        <option value="isc">Ing. Sistemas Computacionales</option>
                        <option value="ind">Ing. Industrial</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" wire:model="filtroSemestre">
                        <option value="">Semestre: Todos</option>
                        <option value="1">1er Semestre</option>
                        <option value="3">3er Semestre</option>
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-outline-secondary" wire:click="filtrar">Filtrar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Tabla de Grupos --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary text-uppercase small">
                        <tr>
                            <th class="ps-4">Identificador</th>
                            <th>Carrera / Semestre</th>
                            <th style="width: 25%;">Capacidad (Alumnos)</th>
                            <th>Maestro Asignado</th>
                            <th class="text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grupos as $grupo)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded p-2 me-3 fw-bold text-center" style="width: 50px;">
                                        {{ $grupo->nombre_corto }}
                                    </div>
                                    <div>
                                        <span class="fw-bold d-block text-dark">{{ $grupo->nombre }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="d-block text-dark fw-bold">{{ $grupo->carrera }}</span>
                                <small class="text-muted">Semestre {{ $grupo->semestre }}</small>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between small mb-1">
                                    <span>Inscritos: <strong>{{ $grupo->inscritos }}</strong></span>
                                    <span class="text-muted">Max: {{ $grupo->cupo_max }}</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    @php
                                        $porcentaje = ($grupo->inscritos / $grupo->cupo_max) * 100;
                                    @endphp
                                    <div class="progress-bar {{ $porcentaje < 100 ? 'bg-success' : 'bg-danger' }}" role="progressbar" style="width: {{ $porcentaje }}%"></div>
                                </div>
                            </td>
                            <td>
                                <span>{{ $grupo->maestro?->name ?? '-- Sin Maestro --' }}</span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-light border btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                        Opciones
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow">
                                        <li><a class="dropdown-item" href="#">Ver Alumnos</a></li>
                                        <li><a class="dropdown-item" href="#">Editar</a></li>
                                        <li><a class="dropdown-item text-danger" href="#">Eliminar</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3">
            <small class="text-muted">Mostrando {{ $grupos->count() }} de {{ $grupos->total() ?? $grupos->count() }} grupos activos.</small>
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
                <form method="POST" action="{{ route('jefe.grupos.store') }}">
                    @csrf
                    <div class="row g-2 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold">Nombre Oficial</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Ej. Grupo A" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Cupo Max</label>
                            <input type="number" class="form-control" name="cupo_max" value="40" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Carrera</label>
                        <select class="form-select" name="carrera" required>
                            <option value="ISC">Ing. Sistemas Computacionales</option>
                            <option value="IND">Ing. Industrial</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Semestre</label>
                        <input type="number" class="form-control" name="semestre" min="1" max="10" required>
                    </div>

                  <div class="mb-3">
    <label class="form-label fw-bold">Horario</label>
    <div class="row g-2">
        <div class="col">
            <input type="time" class="form-control" name="hora_inicio" required>
        </div>
        <div class="col">
            <input type="time" class="form-control" name="hora_fin" required>
        </div>
    </div>
</div>


                    <div class="mb-3">
                        <label class="form-label fw-bold">Maestro</label>
                        <select class="form-select" name="maestro_id">
                            <option value="">-- Sin Maestro --</option>
                            @foreach($maestros as $maestro)
                                <option value="{{ $maestro->id }}">{{ $maestro->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Grupo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
