@extends('layouts.app')

@section('title', 'Editar Alumno')

@section('content')
@include('partials.menu')

<div class="container mt-4">

    <h2 class="mb-4">Editar Alumno</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Hay algunos problemas con los datos.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('coordinador.alumnos.update', $alumno->id) }}" method="POST">
                @csrf
                @method('PUT')

             
                <div class="mb-3">
                    <label class="form-label">Matrícula:</label>
                    <input 
                        type="text" 
                        name="matricula" 
                        value="{{ old('matricula', $alumno->matricula) }}" 
                        class="form-control" 
                        required
                    >
                </div>

                
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre:</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $alumno->name) }}"
                        class="form-control"
                        required
                    >
                </div>

                
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico:</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $alumno->email) }}"
                        class="form-control"
                        required
                    >
                </div>

                
                <div class="mb-3">
                    <label for="password" class="form-label">Nueva Contraseña (opcional):</label>
                    <input type="password" name="password" class="form-control">
                    <small class="text-muted">Dejar vacío si no deseas cambiarla.</small>
                </div>

               
                <div class="mb-3">
                    <label class="form-label">Confirmar Nueva Contraseña:</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

               
                <div class="d-flex justify-content-between">
                    <a href="{{ route('coordinador.alumnos.index') }}" class="btn btn-secondary">
                        ← Regresar
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Guardar Cambios
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
