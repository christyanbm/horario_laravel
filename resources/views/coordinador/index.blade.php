<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Coordinador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Panel del Coordinador</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Gestionar Carreras</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Gestionar Maestros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Horarios</a>
                </li>

                <!-- LOGOUT CORRECTO (POST) -->
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm ms-2">
                            Salir
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <div class="text-center mb-4">
        <h1 class="fw-bold text-primary">Bienvenido, Coordinador</h1>
        <p class="text-muted">Aquí puedes gestionar carreras, maestros y horarios académicos.</p>
    </div>

    <div class="row g-4">

        <!-- Tarjeta 1 -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Gestionar Carreras</h5>
                    <p class="card-text text-muted">Consulta, agrega o modifica las carreras de la institución.</p>
                    <a href="#" class="btn btn-primary">Entrar</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta 2 -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Control de Maestros</h5>
                    <p class="card-text text-muted">Gestiona la información del personal docente.</p>
                    <a href="#" class="btn btn-primary">Entrar</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta 3 -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Administrar Horarios</h5>
                    <p class="card-text text-muted">Crea y organiza horarios escolares.</p>
                    <a href="#" class="btn btn-primary">Entrar</a>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
