@extends('layouts.app') {{-- Extiende el layout principal --}}

@section('title', 'Dashboard Jefe de Carrera')

@section('content')
    {{-- Incluimos el menú --}}
    @include('partials.menu')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Bienvenido, {{ Auth::user()->name }} (Jefe de Carrera)</h2>
        </div>

        <div class="row g-4 mt-3">

            <!--Asignaciones-->
            <a href="{{ route('jefe.asignaciones') }}" class="text-decoration-none">
                <div class="card card-option p-3 text-center">
                    <i class="fa fa-folder fa-2x mb-2"></i>
                    <h5>Asignaciones</h5>
                </div>
            </a>

            <!-- Reportes -->
            <div class="col-md-4">
                <a href="{{ route('jefe.reportes') }}" class="text-decoration-none">
                    <div class="card card-option p-3 text-center">
                        <i class="fa fa-chart-line fa-2x mb-2"></i>
                        <h5>Reportes</h5>
                    </div>
                </a>
            </div>

            <!-- Crear Alumno -->
            <div class="col-md-4">
                <a href="{{ route('jefe.alumnos.index') }}" class="text-decoration-none">
                    <div class="card card-option p-3 text-center">
                        <i class="fa fa-user-plus fa-2x mb-2"></i>
                        <h5>Crear Alumno</h5>
                    </div>
                </a>
            </div>

            <!-- Crear Maestro -->
            <div class="col-md-4">
                <a href="{{ route('jefe.maestros.index') }}" class="text-decoration-none">
                    <div class="card card-option p-3 text-center">
                        <i class="fa fa-chalkboard-teacher fa-2x mb-2"></i>
                        <h5>Crear Maestro</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('jefe.evaluaciones.index') }}" class="text-decoration-none">
                    <div class="card card-option p-3 text-center">
                        <i class="fa fa-star-half-alt fa-2x mb-2"></i>
                        <h5>Evaluaciones Docentes</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
