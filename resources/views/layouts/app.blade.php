<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ ucfirst(Auth::user()->getRoleNames()->first()) }} • {{ config('app.name') }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #eef2f3 0%, #d9e4f5 100%);
            min-height: 100vh;
            font-family: "Nunito", sans-serif;
        }

        .navbar-admin       { background: linear-gradient(135deg, #ff416c, #ff4b2b); }
        .navbar-alumno      { background: linear-gradient(135deg, #667eea, #764ba2); }
        .navbar-maestro     { background: linear-gradient(135deg, #11998e, #38ef7d); }
        .navbar-jefe        { background: linear-gradient(135deg, #ff8c00, #ff5200); }
        .navbar-coordinador { background: linear-gradient(135deg, #00c6ff, #0072ff); }

        .navbar-custom .nav-link,
        .navbar-custom .navbar-brand {
            color: white !important;
            font-weight: 600;
        }
        .navbar-custom .nav-link:hover { opacity: 0.8; }

        .card-option {
            transition: 0.3s ease-in-out;
        }
        .card-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 35px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

@php
    $rol = Auth::user()->getRoleNames()->first(); // admin, alumno, maestro, jefe, coordinador
    $rutaDashboard = route($rol . '.dashboard');
    $iconos = [
        'admin' => 'fa-user-shield',
        'alumno' => 'fa-user-graduate',
        'maestro' => 'fa-chalkboard-teacher',
        'jefe' => 'fa-user-tie',
        'coordinador' => 'fa-briefcase'
    ];
@endphp

<!-- NAVBAR DINÁMICO -->
<nav class="navbar navbar-expand-lg navbar-custom shadow-sm navbar-{{ $rol }}">
    <div class="container">
        <a class="navbar-brand" href="{{ $rutaDashboard }}">
            <i class="fas {{ $iconos[$rol] }} me-2"></i> {{ ucfirst($rol) }} - Dashboard
        </a>
        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDynamic">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarDynamic">
            <ul class="navbar-nav ms-auto">

                {{-- MENÚ POR ROL --}}
                @switch($rol)
                    @case('alumno')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('alumno.materias') }}">
                                <i class="fa fa-calendar me-1"></i> Horario
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('alumno.progreso') }}">
                                <i class="fa fa-check me-1"></i> Progreso
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-star me-1"></i> Evaluaciones
                            </a>
                        </li>
                        @break

                    @case('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="fa fa-home me-1"></i> Inicio
                            </a>
                        </li>
                        @break

                    @case('maestro')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('maestro.asistencias') }}">
            <i class="fa fa-check-square me-1"></i> Asistencias
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('maestro.calificaciones.finales') }}">
            <i class="fa fa-clipboard me-1"></i> Calificaciones
        </a>
    </li>
    @break


 @case('jefe')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('jefe.grupos') }}">
            <i class="fa fa-users me-1"></i> Gestión de Grupos
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('jefe.reportes') }}">
            <i class="fa fa-chart-line me-1"></i> Reportes
        </a>
    </li>
    @break

@case('coordinador')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('coordinador.horarios') }}">
            <i class="fa fa-calendar me-1"></i> Horarios
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('coordinador.asignaciones') }}">
            <i class="fa fa-folder me-1"></i> Asignaciones
        </a>
    </li>
    @break
                @endswitch

                {{-- LOGOUT --}}
                <li class="nav-item ms-3">
                    <a class="btn btn-light text-dark" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Salir
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </ul>
        </div>
    </div>
</nav>

<!-- CONTENIDO -->
<main class="py-5">
    @yield('content')
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
