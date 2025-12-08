@extends('layouts.app')



@section('content')

    {{-- Menú debe ir fuera del container --}}
    @include('partials.menu')

    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Bienvenido, {{ Auth::user()->name }} (Coordinador)</h2>
        </div>

        <div class="row g-4 mt-3">

            {{-- Horarios --}}
            <div class="col-md-4">
                <a href="{{ route('coordinador.horarios') }}" class="text-decoration-none">
                    <div class="card card-option p-3">
                        <i class="fa fa-calendar fa-2x mb-2"></i>
                        <h5>Horarios</h5>
                    </div>
                </a>
            </div>

    <div class="col-md-4">
    <a href="{{ route('coordinador.alumnos.index') }}" class="text-decoration-none">
        <div class="card card-option p-3">
            <i class="fa fa-user-plus fa-2x mb-2"></i>
            <h5>Crear Alumno</h5>
        </div>
    </a>
</div>

            {{-- Grupos --}}
            <div class="col-md-4">
                <a href="{{ route('coordinador.grupos.index') }}" class="text-decoration-none">
                    <div class="card card-option p-3">
                        <i class="fa fa-users fa-2x mb-2"></i>
                        <h5>Grupos</h5>
                    </div>
                </a>
            </div>

        </div>

    </div>
@endsection
