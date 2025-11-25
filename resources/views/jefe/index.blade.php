@extends('layouts.app')

@section('title', 'Dashboard Jefe de Carrera')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Bienvenido, {{ Auth::user()->name }} (Jefe de Carrera)</h2>

        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-outline-danger">
                Cerrar sesión
            </button>
        </form>
    </div>

    <div class="row g-4 mt-3">
        <div class="col-md-4">
            <a href="{{ route('jefe.grupos') }}" class="text-decoration-none">
                <div class="card card-option p-3">
                    <i class="fa fa-users fa-2x mb-2"></i>
                    <h5>Gestión de Grupos</h5>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('jefe.reportes') }}" class="text-decoration-none">
                <div class="card card-option p-3">
                    <i class="fa fa-chart-line fa-2x mb-2"></i>
                    <h5>Reportes</h5>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
