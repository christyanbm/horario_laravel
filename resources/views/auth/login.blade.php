@extends('layouts.app')

@section('title', 'Login')

@section('nav')
@endsection

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center min-vh-100" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
    <div class="row justify-content-center w-100">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-0 rounded-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="display-5 font-weight-bold">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </h2>
                        <p class="text-muted">Ingresa tus credenciales para acceder al sistema.</p>
                    </div>

                    <form action="/login" method="POST" novalidate>
                        @csrf
                        <div class="mb-4">
                            <label for="user" class="form-label fw-bold">
                                <i class="fas fa-user"></i> Usuario (alumno, maestro, coordinador)
                            </label>
                            <input type="text" class="form-control form-control-lg" id="user" name="user" placeholder="Ej: alumno123" required aria-describedby="user-help">
                            <div id="user-help" class="form-text text-light">Ingresa tu nombre de usuario asignado.</div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">
                                <i class="fas fa-lock"></i> Contraseña
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Ingresa tu contraseña" required aria-describedby="password-help">
                                <button class="btn btn-outline-light" type="button" id="toggle-password" aria-label="Mostrar/ocultar contraseña">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div id="password-help" class="form-text text-light">Asegúrate de que sea segura y única.</div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-light btn-lg font-weight-bold" aria-label="Ingresar al sistema">
                                <i class="fas fa-arrow-right"></i> Ingresar
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <a href="#" class="text-light text-decoration-underline" aria-label="Recuperar contraseña">¿Olvidaste tu contraseña?</a>
                        </div>
                    </form>

                    @if(session('error'))
                    <div class="alert alert-danger mt-4 border-0 rounded-lg fade show" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    document.getElementById('toggle-password').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });


    document.querySelector('form').addEventListener('submit', function(e) {
        const user = document.getElementById('user');
        const password = document.getElementById('password');
        let valid = true;

        if (!user.value.trim()) {
            user.classList.add('is-invalid');
            valid = false;
        } else {
            user.classList.remove('is-invalid');
        }

        if (!password.value.trim()) {
            password.classList.add('is-invalid');
            valid = false;
        } else {
            password.classList.remove('is-invalid');
        }

        if (!valid) {
            e.preventDefault();
        }
    });
</script>

<style>

    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }
    .is-invalid {
        border-color: #dc3545 !important;
    }
    .alert {
        animation: slideIn 0.5s ease;
    }
    @keyframes slideIn {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>
@endsection
