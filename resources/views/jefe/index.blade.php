<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Jefe de Carrera</title>

    <!-- Bootstrap 5 -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet">

</head>
<body>

@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-11">

            <!-- Título -->
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="fw-bold m-0">Panel del Jefe de Carrera</h3>
                </div>
                <div class="card-body">
                    <p class="fs-5">
                        Bienvenido <strong>{{ Auth::user()->name }}</strong>.  
                        Aquí puedes gestionar carreras, maestros, horarios y grupos de tu departamento.
                    </p>
                </div>
            </div>

            <!-- Opciones -->
            <div class="row g-4">

                <!-- Carreras -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-primary">Carreras</h5>
                            <p class="text-muted">Administra y edita las carreras de la institución.</p>
                            <a href="#" class="btn btn-primary w-100">Administrar carreras</a>
                        </div>
                    </div>
                </div>

                <!-- Maestros -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-success">Maestros</h5>
                            <p class="text-muted">Visualiza y gestiona los maestros de tu carrera.</p>
                            <a href="#" class="btn btn-success w-100">Ver maestros</a>
                        </div>
                    </div>
                </div>

                <!-- Horarios -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-warning">Horarios</h5>
                            <p class="text-muted">Crea, edita y organiza los horarios por semestre.</p>
                            <a href="#" class="btn btn-warning w-100">Gestionar horarios</a>
                        </div>
                    </div>
                </div>

                <!-- Grupos -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 mt-4">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-danger">Grupos</h5>
                            <p class="text-muted">Consulta y configura los grupos activos.</p>
                            <a href="#" class="btn btn-danger w-100">Ver grupos</a>
                        </div>
                    </div>
                </div>

                <!-- Reportes -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 mt-4">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-info">Reportes</h5>
                            <p class="text-muted">Genera reportes académicos y administrativos.</p>
                            <a href="#" class="btn btn-info w-100 text-white">Generar reportes</a>
                        </div>
                    </div>
                </div>

                <!-- Perfil -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 mt-4">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-secondary">Perfil</h5>
                            <p class="text-muted">Actualiza tu información personal y cuenta.</p>
                            <a href="#" class="btn btn-secondary w-100">Editar perfil</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection

<!-- Bootstrap JS -->
<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>
</html>
