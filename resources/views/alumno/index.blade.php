<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Alumno</title>

    <!-- Bootstrap CSS -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet">
</head>
<body>

@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-10">

            <!-- Tarjeta principal -->
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="fw-bold m-0">
                        Bienvenido al Dashboard Alumno
                    </h3>
                </div>

                <div class="card-body">

                    <p class="fs-5">
                        Hola <strong>{{ Auth::user()->name }}</strong>, nos da gusto verte nuevamente.  
                        Aquí podrás consultar tu información académica y opciones disponibles.
                    </p>

                    <hr>

                    <!-- Secciones del dashboard -->
                    <div class="row text-center">

                        <div class="col-md-4 mb-4">
                            <div class="p-4 shadow rounded bg-light">
                                <h5 class="fw-bold text-primary">Mi Horario</h5>
                                <p class="text-muted">Consulta las materias y horarios asignados.</p>
                                <a href="#" class="btn btn-primary w-100">Ver horario</a>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="p-4 shadow rounded bg-light">
                                <h5 class="fw-bold text-success">Mis Materias</h5>
                                <p class="text-muted">Visualiza las materias inscritas este semestre.</p>
                                <a href="#" class="btn btn-success w-100">Ver materias</a>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="p-4 shadow rounded bg-light">
                                <h5 class="fw-bold text-danger">Perfil</h5>
                                <p class="text-muted">Consulta o edita tus datos personales.</p>
                                <a href="#" class="btn btn-danger w-100">Ver perfil</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
