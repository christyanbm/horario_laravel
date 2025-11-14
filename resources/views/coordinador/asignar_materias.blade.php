@extends('layouts.app')

@section('title', 'Asignar Materias a Alumnos')

@section('nav')
<li class="nav-item">
    <a class="nav-link active" href="/coordinador" aria-label="Ir al Dashboard">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link active" href="/coordinador/asignar_materias" aria-label="Asignar Materias a Alumnos">
        <i class="fas fa-user-graduate"></i> Asignar Materias a Alumnos
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/coordinador/asignar_materias_maestros" aria-label="Asignar Materias a Maestros">
        <i class="fas fa-chalkboard-teacher"></i> Asignar Materias a Maestros
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid py-5" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 80vh;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 text-primary font-weight-bold">
                <i class="fas fa-user-graduate"></i> Asignar Materias a Alumnos
            </h2>
            <p class="lead text-muted">Selecciona un alumno y asigna las materias disponibles. Asignaciones realizadas: <span id="contador-asignaciones" class="badge bg-success">0</span></p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                {{-- Selección de Alumno --}}
                <div class="card shadow-lg border-0 rounded-lg mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">
                            <i class="fas fa-user"></i> Paso 1: Selecciona un Alumno
                        </h5>
                        <div class="mb-3">
                            <label for="alumno" class="form-label fw-bold">Alumno</label>
                            <select class="form-select form-select-lg" id="alumno" aria-describedby="alumno-help">
                                <option value="" selected disabled>-- Selecciona un alumno --</option>
                                <option value="juan">Juan Pérez</option>
                                <option value="ana">Ana Gómez</option>
                            </select>
                            <div id="alumno-help" class="form-text text-light">Elige un alumno para ver las materias disponibles.</div>
                        </div>
                    </div>
                </div>

                {{-- Materias Disponibles para el Alumno --}}
                <div id="materias-container" class="card shadow-lg border-0 rounded-lg" style="display:none; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;" role="region" aria-labelledby="materias-title">
                    <div class="card-body">
                        <h5 id="materias-title" class="card-title font-weight-bold mb-4">
                            <i class="fas fa-book"></i> Paso 2: Materias Disponibles
                        </h5>
                        <div class="mb-3">
                            <label for="materia" class="form-label fw-bold">Seleccionar Materia</label>
                            <select class="form-select form-select-lg" id="materia" aria-describedby="materia-help">
                                {{-- Se llenará dinámicamente --}}
                            </select>
                            <div id="materia-help" class="form-text text-light">Elige una materia que el alumno pueda tomar (excluyendo las ya cursadas).</div>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-light btn-lg" id="asignarBtn" aria-label="Asignar materia al alumno">
                                <i class="fas fa-plus"></i> Asignar Materia
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <button id="guardar-asignaciones" class="btn btn-primary btn-lg me-3" aria-label="Guardar asignaciones">
                <i class="fas fa-save"></i> Guardar Asignaciones
            </button>
            <a href="/coordinador" class="btn btn-outline-primary btn-lg" aria-label="Volver al Dashboard">
                <i class="fas fa-arrow-left"></i> Volver al Dashboard
            </a>
        </div>

        <div id="alert-container" class="mt-4"></div>
    </div>
</div>

<script>
    // Materias de Ingeniería en Sistemas Computacionales (ISC)
    const materiasISC = [
        "Cálculo Diferencial",
        "Cálculo Integral",
        "Cálculo Vectorial",
        "Ecuaciones Diferenciales",
        "Gráficación",
        "Lenguajes y Autómatas I",
        "Lenguajes y Autómatas II",
        "Programación Lógica y Funcional",
        "Inteligencia Artificial",
        "Fundamentos de Programación",
        "Programación Orientada a Objetos",
        "Estructura de Datos",
        "Métodos Numéricos",
        "Fundamentos de Telecomunicaciones",
        "Redes de Computadoras",
        "Conmutación y Enrutamiento",
        "Administración de Redes",
        "Internet de las Cosas",
        "Taller de Ética",
        "Contabilidad Financiera",
        "Cultura Empresarial",
        "Tópicos Avanzados de Programación",
        "Sistemas Operativos",
        "Taller de Sistemas Operativos",
        "Taller de Investigación I",
        "Taller de Investigación II",
        "Plataforma de Desarrollo en la Nube",
        "Matemáticas Discretas",
        "Química",
        "Investigación de Operaciones",
        "Fundamentos de Base de Datos",
        "Taller de Base de Datos",
        "Administración de Base de Datos",
        "Seguridad",
        "Programación Web",
        "Taller de Administración",
        "Álgebra Lineal",
        "Desarrollo Sustentable",
        "Simulación",
        "Fundamentos de Ingeniería de Software",
        "Ingeniería de Software",
        "Gestión de Proyectos de SW",
        "Programación de Dispositivos Móviles",
        "Fundamentos de Investigación",
        "Probabilidad y Estadística",
        "Física General",
        "Principios Eléctricos y Aplicaciones",
        "Arquitectura de Computadoras",
        "Lenguajes de Interfaz",
        "Sistemas Programables",
        "Programación Web Avanzada",
        "Actividades Complementarias",
        "Servicio Social",
        "Residencias Profesionales"
    ];

    // Alumno y materias que ya tomó o no puede tomar
    const elegibilidadAlumnos = {
        "juan": ["Cálculo Diferencial", "Cálculo Integral", "Lenguajes y Autómatas I", "Fundamentos de Programación", "Programación Orientada a Objetos"],
        "ana": ["Cálculo Diferencial", "Cálculo Vectorial", "Estructura de Datos", "Métodos Numéricos"]
    };

    let asignaciones = 0;

    const alumnoSelect = document.getElementById('alumno');
    const materiasSelect = document.getElementById('materia');
    const materiasContainer = document.getElementById('materias-container');
    const asignarBtn = document.getElementById('asignarBtn');

    alumnoSelect.addEventListener('change', () => {
        const alumno = alumnoSelect.value;
        if (!alumno) {
            document.getElementById('alumno').classList.add('is-invalid');
            return;
        }
        document.getElementById('alumno').classList.remove('is-invalid');

        // Materias disponibles = todas menos las que ya tomó
        const disponibles = materiasISC.filter(m => !elegibilidadAlumnos[alumno].includes(m));

        // Limpiar dropdown
        materiasSelect.innerHTML = '<option value="" selected disabled>-- Selecciona una materia --</option>';
        disponibles.forEach(mat => {
            const option = document.createElement('option');
            option.value = mat;
            option.textContent = mat;
            materiasSelect.appendChild(option);
        });

        // Mostrar contenedor con animación
        materiasContainer.style.display = 'block';
        materiasContainer.classList.add('fade-in');
    });

    asignarBtn.addEventListener('click', () => {
        const alumno = alumnoSelect.value;
        const materia = materiasSelect.value;
        if (!alumno || !materia) {
            showAlert('Selecciona un alumno y una materia.', 'danger');
            return;
        }

        // Simular loading
        asignarBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Asignando...';
        asignarBtn.disabled = true;

        // Simular AJAX (reemplaza con tu petición real a /coordinador/asignar-materia-alumno)
        setTimeout(() => {
            asignaciones++;
            document.getElementById('contador-asignaciones').textContent = asignaciones;
            showAlert(`Materia "${materia}" asignada a ${alumnoSelect.options[alumnoSelect.selectedIndex].text}`, 'success');
            asignarBtn.innerHTML = '<i class="fas fa-plus"></i> Asignar Materia';
            asignarBtn.disabled = false;
        }, 1000);
    });

    // Función para guardar asignaciones (simulado)
    document.getElementById('guardar-asignaciones').addEventListener('click', function() {
        if (asignaciones === 0) {
            showAlert('No hay asignaciones para guardar.', 'warning');
            return;
        }
        showAlert('Asignaciones guardadas exitosamente.', 'success');
        // Aquí conecta a tu backend para guardar en BD
    });

    // Función para mostrar alertas
    function showAlert(message, type) {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show`;
        alert.innerHTML = `<i class="fas fa-info-circle"></i> ${message} <button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
        document.getElementById('alert-container').appendChild(alert);
        setTimeout(() => alert.remove(), 5000);
    }
</script>

<style>
    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }
    .is-invalid {
        border-color: #dc3545 !important;
    }
</style>
@endsection