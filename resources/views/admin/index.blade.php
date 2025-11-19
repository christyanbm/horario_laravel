<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <!-- Bootstrap -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet">

</head>
<body>

@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <!-- ENCABEZADO -->
    <div class="text-center mb-4">
        <h1 class="fw-bold text-danger">Dashboard del Administrador</h1>
        <p class="text-muted fs-5">Bienvenido Administrador al panel de control</p>
    </div>

    <!-- ALERTA DE SESIÓN -->
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>✔ Correcto:</strong> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- TARJETAS DE ACCESO RÁPIDO -->
    <div class="row g-4">

        <!-- Gestión de alumnos -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Gestionar Alumnos</h5>
                    <p class="card-text text-muted">Registrar, editar y administrar alumnos.</p>
                    <a href="#" class="btn btn-primary w-100">Ir a Alumnos</a>
                </div>
            </div>
        </div>

        <!-- Gestión de maestros -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Gestionar Maestros</h5>
                    <p class="card-text text-muted">Control de docentes y asignaciones.</p>
                    <a href="#" class="btn btn-secondary w-100">Ir a Maestros</a>
                </div>
            </div>
        </div>

        <!-- Gestión de carreras -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Gestionar Carreras</h5>
                    <p class="card-text text-muted">Administrar programas educativos.</p>
                    <a href="#" class="btn btn-success w-100">Ir a Carreras</a>
                </div>
            </div>
        </div>

        <!-- Gestión de materias -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Gestionar Materias</h5>
                    <p class="card-text text-muted">Materias, grupos y asignaciones.</p>
                    <a href="#" class="btn btn-warning w-100">Ir a Materias</a>
                </div>
            </div>
        </div>

        <!-- Horarios -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Configurar Horarios</h5>
                    <p class="card-text text-muted">Crear y editar horarios escolares.</p>
                    <a href="#" class="btn btn-info w-100">Ver Horarios</a>
                </div>
            </div>
        </div>

        <!-- Configuración -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Administración General</h5>
                    <p class="card-text text-muted">Roles, permisos y configuración.</p>
                    <a href="#" class="btn btn-dark w-100">Configuración</a>
                </div>
            </div>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="text-center mt-5">
        <p class="text-muted">Has iniciado sesión como administrador.</p>
    </div>

</div>
@endsection

<!-- Bootstrap JS -->
<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>
</html>
