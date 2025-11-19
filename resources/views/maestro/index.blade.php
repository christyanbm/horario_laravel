<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Maestro</title>

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

            <!-- Encabezado -->
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-success text-white text-center">
                    <h3 class="fw-bold m-0">Panel del Maestro</h3>
                </div>
                <div class="card-body">
                    <p class="fs-5">
                        Bienvenido <strong>{{ Auth::user()->name }}</strong>.  
                        Aquí puedes consultar tus horarios, clases y subir avisos para los alumnos.
                    </p>
                </div>
            </div>

            <!-- Tarjetas de opciones -->
            <div class="row g-4">

                <!-- Mis clases -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-primary">Mis Clases</h5>
                            <p class="text-muted">Consulta las materias que impartes este semestre.</p>
                            <a href="#" class="btn btn-primary w-100">Ver clases</a>
                        </div>
                    </div>
                </div>

                <!-- Horario -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-success">Mi Horario</h5>
                            <p class="text-muted">Revisa tus clases asignadas por día y hora.</p>
                            <a href="#" class="btn btn-success w-100">Ver horario</a>
                        </div>
                    </div>
                </div>

                <!-- Avisos -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-warning">Avisos</h5>
                            <p class="text-muted">Publica información importante para tus alumnos.</p>
                            <a href="#" class="btn btn-warning w-100">Enviar aviso</a>
                        </div>
                    </div>
                </div>

                <!-- Lista de alumnos -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 mt-4">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-danger">Lista de Alumnos</h5>
                            <p class="text-muted">Consulta los grupos y estudiantes inscritos.</p>
                            <a href="#" class="btn btn-danger w-100">Ver alumnos</a>
                        </div>
                    </div>
                </div>

                <!-- Subir material -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 mt-4">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-info">Material Didáctico</h5>
                            <p class="text-muted">Comparte archivos, guías o actividades.</p>
                            <a href="#" class="btn btn-info w-100 text-white">Subir material</a>
                        </div>
                    </div>
                </div>

                <!-- Perfil -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 mt-4">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-secondary">Perfil</h5>
                            <p class="text-muted">Actualiza tu información personal.</p>
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
