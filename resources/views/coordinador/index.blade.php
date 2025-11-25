<?php
@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Dashboard Coordinador')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Bienvenido, {{ Auth::user()->name }} (Coordinador)</h2>

        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-outline-danger">
                Cerrar sesión
            </button>
        </form>
    </div>

    <div class="row g-4 mt-3">
        <div class="col-md-4">
            <a href="{{ route('coordinador.horarios') }}" class="text-decoration-none">
                <div class="card card-option p-3">
                    <i class="fa fa-calendar fa-2x mb-2"></i>
                    <h5>Horarios</h5>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('coordinador.asignaciones') }}" class="text-decoration-none">
                <div class="card card-option p-3">
                    <i class="fa fa-folder fa-2x mb-2"></i>
                    <h5>Asignaciones</h5>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
