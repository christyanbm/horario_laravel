@extends('layouts.app')

@section('title', 'Crear Alumno')

@section('content')
    <div class="container mt-4">

        <h2 class="mb-4">Crear Nuevo Alumno</h2>

        <div class="card shadow">
            <div class="card-body">

                <form action="{{ route('coordinador.alumnos.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nombre completo</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Guardar</button>
                    <a href="{{ route('coordinador.alumnos.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>

                </form>

            </div>
        </div>

    </div>
@endsection
