@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Dashboard Maestro')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Bienvenido, {{ Auth::user()->name }}</h2>

    <div class="row g-4">
        {{-- Asistencias --}}
        <div class="col-md-4">
         <a href="{{ route('maestro.asistencias') }}" class="text-decoration-none">

                <div class="card text-center shadow-sm p-3">
                    <i class="fas fa-user-check fa-2x mb-2"></i>
                    <h5>Asistencias</h5>
                </div>
            </a>
        </div>

        {{-- Calificaciones Finales --}}
        <div class="col-md-4">
            <a href="{{ route('maestro.calificaciones.finales') }}" class="text-decoration-none">
                <div class="card text-center shadow-sm p-3">
                    <i class="fas fa-graduation-cap fa-2x mb-2"></i>
                    <h5>Calificaciones Finales</h5>
                </div>
            </a>
        </div>

        {{-- Horario de Clases --}}
        <div class="col-md-4">
            <a href="{{ route('maestro.horario') }}" class="text-decoration-none">
                <div class="card text-center shadow-sm p-3">
                    <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                    <h5>Horario de Clases</h5>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
