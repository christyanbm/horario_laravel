@extends('layouts.app')

@section('title', 'Dashboard Alumno')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Bienvenido, {{ Auth::user()->name }}</h2>

        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-outline-danger">
                Cerrar sesión
            </button>
        </form>
    </div>

    <div class="row g-4">

        {{-- Progreso General --}}
        <div class="col-md-4">
            <a href="{{ route('alumno.progreso') }}" class="text-decoration-none">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-chart-line fa-2x mb-2"></i>
                        <h5 class="card-title">Progreso</h5>
                        <p class="card-text">Consulta tu progreso académico</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Horario --}}
        <div class="col-md-4">
            <a href="{{ route('alumno.horario.seleccion') }}" class="text-decoration-none">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                        <h5 class="card-title">Horario</h5>
                        <p class="card-text">Selecciona o consulta tu horario</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Materias --}}
        <div class="col-md-4">
            <a href="{{ route('alumno.materias') }}" class="text-decoration-none">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-book fa-2x mb-2"></i>
                        <h5 class="card-title">Materias</h5>
                        <p class="card-text">Revisa las materias asignadas</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
@endsection
