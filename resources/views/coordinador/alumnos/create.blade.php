@extends('layouts.app')

@section('title', 'Crear Alumno')

@section('content')
@include('partials.menu')

<div class="container mt-4">

    <h2 class="mb-4 fw-bold">Crear Nuevo Alumno</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Ups!</strong> Hay algunos problemas.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('coordinador.alumnos.store') }}" method="POST">
                @csrf

               
                <div class="mb-3">
                    <label class="form-label fw-bold">Matrícula</label>
                    <input type="text" name="matricula" class="form-control" required>
                </div>

                
                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre completo</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                
                <div class="mb-3">
                    <label class="form-label fw-bold">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

               
                <div class="mb-3">
                    <label class="form-label fw-bold">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                
                <div class="mb-3">
                    <label class="form-label fw-bold">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('coordinador.alumnos.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                    <button class="btn btn-primary">Guardar Alumno</button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
