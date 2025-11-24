@extends('layouts.app')

@section('title', 'Dashboard Administrador')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Bienvenido, {{ Auth::user()->name }}</h2>

    <div class="row g-4">
        {{-- Cards de acceso rápido --}}
        <div class="col-md-3">
            <a href="{{ route('admin.usuarios', ['role' => 'alumno']) }}" class="text-decoration-none">
                <div class="card card-option text-center p-3">
                    <i class="fas fa-user-graduate fa-3x mb-2"></i>
                    <h5>Alumnos</h5>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('admin.usuarios', ['role' => 'maestro']) }}" class="text-decoration-none">
                <div class="card card-option text-center p-3">
                    <i class="fas fa-chalkboard-teacher fa-3x mb-2"></i>
                    <h5>Maestros</h5>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('admin.usuarios', ['role' => 'jefe']) }}" class="text-decoration-none">
                <div class="card card-option text-center p-3">
                    <i class="fas fa-user-tie fa-3x mb-2"></i>
                    <h5>Jefes de Carrera</h5>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('admin.usuarios', ['role' => 'coordinador']) }}" class="text-decoration-none">
                <div class="card card-option text-center p-3">
                    <i class="fas fa-briefcase fa-3x mb-2"></i>
                    <h5>Coordinadores</h5>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
