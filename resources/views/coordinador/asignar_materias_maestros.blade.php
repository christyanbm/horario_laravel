@extends('layouts.app')

@section('title', 'Asignar Materias a Maestros')

@section('nav')
<li class="nav-item">
    <a class="nav-link active" href="/coordinador" aria-label="Ir al Dashboard">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/coordinador/asignar_materias" aria-label="Asignar Materias a Alumnos">
        <i class="fas fa-user-graduate"></i> Asignar Materias a Alumnos
    </a>
</li>
<li class="nav-item">
    <a class="nav-link active" href="/coordinador/asignar_materias_maestros" aria-label="Asignar Materias a Maestros">
        <i class="fas fa-chalkboard-teacher"></i> Asignar Materias a Maestros
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid py-5" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 80vh;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 text-primary font-weight-bold">
                <i class="fas fa-user-tie"></i> Asignar Materias a Maestros
            </h2>
            <p class="lead text-muted">Selecciona las materias para cada maestro y confirma las asignaciones. Asignaciones realizadas: <span id="contador-asignaciones" class="badge bg-success">0</span></p>
        </div>

        <div class="row g-4" id="maestros-list">
            {{-- Maestro 1 --}}
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0 rounded-lg h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">
                            <i class="fas fa-user"></i> Juan Pérez
                        </h5>
                        <div class="mb-3">
                            <label for="materia-juan" class="form-label fw-bold">Seleccionar Materia</label>
                            <select class="form-select" id="materia-juan" aria-label="Seleccionar materia para Juan Pérez">
                                <option value="" selected disabled>-- Selecciona una materia --</option>
                                {{-- Materias ISC --}}
                                <option>Cálculo Diferencial</option>
                                <option>Cálculo Integral</option>
                                <option>Cálculo Vectorial</option>
                                <option>Ecuaciones Diferenciales</option>
                                <option>Gráficación</option>
                                <option>Lenguajes y Autómatas I</option>
                                <option>Lenguajes y Autómatas II</option>
                                <option>Programación Lógica y Funcional</option>
                                <option>Inteligencia Artificial</option>
                                <option>Fundamentos de Programación</option>
                                <option>Programación Orientada a Objetos</option>
                                <option>Estructura de Datos</option>
                                <option>Métodos Numéricos</option>
                                <option>Fundamentos de Telecomunicaciones</option>
                                <option>Redes de Computadoras</option>
                                <option>Conmutación y Enrutamiento</option>
                                <option>Administración de Redes</option>
                                <option>Internet de las Cosas</option>
                                <option>Taller de Ética</option>
                                <option>Contabilidad Financiera</option>
                                <option>Cultura Empresarial</option>
                                <option>Tópicos Avanzados de Programación</option>
                                <option>Sistemas Operativos</option>
                                <option>Taller de Sistemas Operativos</option>
                                <option>Taller de Investigación I</option>
                                <option>Taller de Investigación II</option>
                                <option>Plataforma de Desarrollo en la Nube</option>
                                <option>Matemáticas Discretas</option>
                                <option>Química</option>
                                <option>Investigación de Operaciones</option>
                                <option>Fundamentos de Base de Datos</option>
                                <option>Taller de Base de Datos</option>
                                <option>Administración de Base de Datos</option>
                                <option>Seguridad</option>
                                <option>Programación Web</option>
                                <option>Taller de Administración</option>
                                <option>Álgebra Lineal</option>
                                <option>Desarrollo Sustentable</option>
                                <option>Simulación</option>
                                <option>Fundamentos de Ingeniería de Software</option>
                                <option>Ingeniería de Software</option>
                                <option>Gestión de Proyectos de SW</option>
                                <option>Programación de Dispositivos Móviles</option>
                                <option>Fundamentos de Investigación</option>
                                <option>Probabilidad y Estadística</option>
                                <option>Física General</option>
                                <option>Principios Eléctricos y Aplicaciones</option>
                                <option>Arquitectura de Computadoras</option>
                                <option>Lenguajes de Interfaz</option>
                                <option>Sistemas Programables</option>
                                <option>Programación Web Avanzada</option>
                                <option>Actividades Complementarias</option>
                                <option>Servicio Social</option>
                                <option>Residencias Profesionales</option>
                            </select>
                        </div>
                        <button class="btn btn-light btn-sm w-100 asignar-btn" data-maestro="Juan Pérez" aria-label="Asignar materia a Juan Pérez">
                            <i class="fas fa-check"></i> Asignar
                        </button>
                    </div>
                </div>
            </div>

            {{-- Maestro 2 --}}
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0 rounded-lg h-100" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">
                            <i class="fas fa-user"></i> Ana Gómez
                        </h5>
                        <div class="mb-3">
                            <label for="materia-ana" class="form-label fw-bold">Seleccionar Materia</label>
                            <select class="form-select" id="materia-ana" aria-label="Seleccionar materia para Ana Gómez">
                                <option value="" selected disabled>-- Selecciona una materia --</option>
                                {{-- Materias ISC --}}
                                <option>Cálculo Diferencial</option>
                                <option>Cálculo Integral</option>
                                <option>Cálculo Vectorial</option>
                                <option>Ecuaciones Diferenciales</option>
                                <option>Gráficación</option>
                                <option>Lenguajes y Autómatas I</option>
                                <option>Lenguajes y Autómatas II</option>
                                <option>Programación Lógica y Funcional</option>
                                <option>Inteligencia Artificial</option>
                                <option>Fundamentos de Programación</option>
                                <option>Programación Orientada a Objetos</option>
                                <option>Estructura de Datos</option>
                                <option>Métodos Numéricos</option>
                                <option>Fundamentos de Telecomunicaciones</option>
                                <option>Redes de Computadoras</option>
                                <option>Conmutación y Enrutamiento</option>
                                <option>Administración de Redes</option>
                                <option>Internet de las Cosas</option>
                                <option>Taller de Ética</option>
                                <option>Contabilidad Financiera</option>
                                <option>Cultura Empresarial</option>
                                <option>Tópicos Avanzados de Programación</option>
                                <option>Sistemas Operativos</option>
                                <option>Taller de Sistemas Operativos</option>
                                <option>Taller de Investigación I</option>
                                <option>Taller de Investigación II</option>
                                <option>Plataforma de Desarrollo en la Nube</option>
                                <option>Matemáticas Discretas</option>
                                <option>Química</option>
                                <option>Investigación de Operaciones</option>
                                <option>Fundamentos de Base de Datos</option>
                                <option>Taller de Base de Datos</option>
                                <option>Administración de Base de Datos</option>
                                <option>Seguridad</option>
                                <option>Programación Web</option>
                                <option>Taller de Administración</option>
                                <option>Álgebra Lineal</option>
                                <option>Desarrollo Sustentable</option>
                                <option>Simulación</option>
                                <option>Fundamentos de Ingeniería de Software</option>
                                <option>Ingeniería de Software</option>
                                <option>Gestión de Proyectos de SW</option>
                                <option>Programación de Dispositivos Móviles</option>
                                <option>Fundamentos de Investigación</option>
                                <option>Probabilidad y Estadística</option>
                                <option>Física General</option>
                                <option>Principios Eléctricos y Aplicaciones</option>
                                <option>Arquitectura de Computadoras</option>
                                <option>Lenguajes de Interfaz</option>
                                <option>Sistemas Programables</option>
                                <option>Programación Web Avanzada</option>
                                <option>Actividades Complementarias</option>
                                <option>Servicio Social</option>
                                <option>Residencias Profesionales</option>
                            </select>
                        </div>
                        <button class="btn btn-light btn-sm w-100 asignar-btn" data-maestro="Ana Gómez" aria-label="Asignar materia a Ana Gómez">
                            <i class="fas fa-check"></i> Asignar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <button id="guardar-todas" class="btn btn-primary btn-lg me-3" aria-label="Guardar todas las asignaciones">
                <i class="fas fa-save"></i> Guardar Todas las Asignaciones
            </button>
            <a href="/coordinador" class="btn btn-outline-primary btn-lg" aria-label="Volver al Dashboard">
                <i class="fas fa-arrow-left"></i> Volver al Dashboard
            </a>
        </div>

        <div id="alert-container" class="mt-4"></div>
    </div>
</div>

<script>
    let asignaciones = 0;

    document.querySelectorAll('.asignar-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const maestro = this.getAttribute('data-maestro');
            const select = document.getElementById('materia-' + maestro.toLowerCase().replace(' ', '-'));
            const materia = select.value;

            if (!materia) {
                showAlert('Selecciona una materia para ' + maestro, 'danger');
                return;
            }

            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Asignando...';
            this.disabled = true;

            setTimeout(() => {
                asignaciones++;
                document.getElementById('contador-asignaciones').textContent = asignaciones;
                showAlert('Materia asignada a ' + maestro + ': ' + materia, 'success');
                this.innerHTML = '<i class="fas fa-check"></i> Asignada';
                this.classList.remove('btn-light');
                this.classList.add('btn-success');
                this.disabled = true;
            }, 1000);
        });
    });

    document.getElementById('guardar-todas').addEventListener('click', function() {
        if (asignaciones === 0) {
            showAlert('No hay asignaciones para guardar.', 'warning');
            return;
        }
        showAlert('Todas las asignaciones guardadas exitosamente.', 'success');
    });

    function showAlert(message, type) {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show`;
        alert.innerHTML = `<i class="fas fa-info-circle"></i> ${message} <button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
        document.getElementById('alert-container').appendChild(alert);
        setTimeout(() => alert.remove(), 5000);
    }
</script>

<style>
    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }
    .asignar-btn:disabled {
        opacity: 0.6;
    }
</style>
@endsection
