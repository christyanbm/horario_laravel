@extends('layouts.app')

@section('title', 'Elegir Materias')

@section('nav')
<li class="nav-item">
    <a class="nav-link" href="/alumno" aria-label="Ir al Dashboard">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link active" href="/alumno/elegir_materias" aria-label="Elegir Materias">
        <i class="fas fa-book-open"></i> Elegir Materias
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/alumno/promedios" aria-label="Ver Promedios">
        <i class="fas fa-chart-line"></i> Promedios
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/alumno/materias_semestre" aria-label="Ver Materias del Semestre">
        <i class="fas fa-calendar-alt"></i> Materias del Semestre
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid py-5" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 80vh;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 text-primary font-weight-bold">
                <i class="fas fa-graduation-cap"></i> Elegir Materias
            </h2>
            <p class="lead text-muted">Selecciona tu carrera y elige las materias que deseas cursar este semestre. ¡Personaliza tu plan académico!</p>
        </div>

        <div class="row justify-content-center">
            {{-- Paso 1: Selección de carrera --}}
            <div class="col-md-6 col-sm-12">
                <div class="card shadow-lg border-0 rounded-lg mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">
                            <i class="fas fa-university"></i> Paso 1: Selecciona tu Carrera
                        </h5>
                        <form id="form-carrera">
                            <div class="mb-3">
                                <label for="carrera" class="form-label fw-bold">Carrera</label>
                                <select class="form-select form-select-lg" id="carrera" required aria-describedby="carrera-help">
                                    <option value="" selected disabled>-- Selecciona una carrera --</option>
                                    <option value="ISC">Ingeniería en Sistemas Computacionales</option>
                                    <option value="II">Ingeniería en Informática</option>
                                    <option value="IC">Ingeniería Civil</option>
                                    <option value="IE">Ingeniería Electrónica</option>
                                    <option value="ER">Energías Renovables</option>
                                    <option value="BIO">Biología</option>
                                    <option value="GE">Gestión Empresarial</option>
                                </select>
                                <div id="carrera-help" class="form-text text-light">Elige la carrera para ver las materias disponibles.</div>
                            </div>
                            <button type="submit" class="btn btn-light btn-lg w-100" id="btn-continuar" aria-label="Continuar a selección de materias">
                                <i class="fas fa-arrow-right"></i> Continuar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Paso 2: Materias --}}
            <div class="col-12">
                <div id="materias-container" class="card shadow-lg border-0 rounded-lg" style="display:none; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;" role="region" aria-labelledby="materias-title">
                    <div class="card-body">
                        <h5 id="materias-title" class="card-title font-weight-bold mb-4">
                            <i class="fas fa-list-check"></i> Paso 2: Materias Disponibles
                        </h5>
                        <p class="text-muted">Selecciona las materias que deseas agregar. Puedes elegir varias.</p>
                        <div class="mb-3">
                            <span id="contador-seleccionadas" class="badge bg-light text-dark">0 seleccionadas</span>
                        </div>
                        <ul class="list-group list-group-flush" id="materias-todas">
                            {{-- Aquí se agregarán todas las materias --}}
                        </ul>
                        <div class="text-center mt-4">
                            <button id="btn-guardar" class="btn btn-light btn-lg" style="display:none;" aria-label="Guardar selección de materias">
                                <i class="fas fa-save"></i> Guardar Selección
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Materias de tronco común sin "Introducción a la Programación"
    const materiasTroncoComun = [
        "Cálculo Integral",
        "Física",
        "Química"
    ];

    const materiasPorCarrera = {
        "ISC": [
            "Cálculo Diferencial",
            "Cálculo Vectorial",
            "Ecuaciones Diferenciales",
            "Graficación",
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
            "Conmutación y Enrutamiento de Redes",
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
            "Gestión de Proyectos de Software",
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
        ],
        "II": ["Inteligencia Artificial", "Lenguajes y Autómatas I", "Redes de Computadoras"],
        "IC": ["Topografía", "Materiales de Construcción", "Cálculo Diferencial"],
        "IE": ["Electrónica Analógica", "Circuitos Digitales", "Control Automático"],
        "ER": ["Energías Renovables", "Sistemas Fotovoltaicos", "Sistemas Eólicos"],
        "BIO": ["Biología Molecular", "Genética", "Microbiología"],
        "GE": ["Contabilidad Financiera", "Gestión de Proyectos", "Marketing"]
    };

    let seleccionadas = [];

    document.getElementById('form-carrera').addEventListener('submit', function(e){
        e.preventDefault();
        const carrera = document.getElementById('carrera').value;
        if(!carrera) {
            document.getElementById('carrera').classList.add('is-invalid');
            return;
        }
        document.getElementById('carrera').classList.remove('is-invalid');

        // Mostrar indicador de carga
        const btn = document.getElementById('btn-continuar');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Cargando...';
        btn.disabled = true;

        // Combinar materias de tronco común y carrera
        const todasMaterias = [...materiasTroncoComun, ...materiasPorCarrera[carrera]];

        const lista = document.getElementById('materias-todas');
        lista.innerHTML = '';
        seleccionadas = [];
        actualizarContador();

        todasMaterias.forEach(mat => {
            const li = document.createElement('li');
            li.className = "list-group-item d-flex justify-content-between align-items-center bg-transparent border-0";
            li.innerHTML = `
                <label class="form-check-label fw-bold" for="check-${mat.replace(/\s+/g, '-')}">${mat}</label>
                <input class="form-check-input" type="checkbox" id="check-${mat.replace(/\s+/g, '-')}" value="${mat}" aria-label="Seleccionar ${mat}">
            `;
            lista.appendChild(li);

            // Event listener para checkboxes
            const checkbox = li.querySelector('input');
            checkbox.addEventListener('change', function(){
                if(this.checked){
                    seleccionadas.push(this.value);
                } else {
                    seleccionadas = seleccionadas.filter(m => m !== this.value);
                }
                actualizarContador();
                document.getElementById('btn-guardar').style.display = seleccionadas.length > 0 ? 'inline-block' : 'none';
            });
        });

        // Mostrar contenedor con animación
        const container = document.getElementById('materias-container');
        container.style.display = 'block';
        container.classList.add('fade-in');

        // Resetear botón
        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-arrow-right"></i> Continuar';
            btn.disabled = false;
        }, 500);
    });

    function actualizarContador(){
        document.getElementById('contador-seleccionadas').textContent = `${seleccionadas.length} seleccionadas`;
    }

    // Evento para guardar (puedes conectar a backend aquí)
    document.getElementById('btn-guardar').addEventListener('click', function(){
        alert(`Materias seleccionadas: ${seleccionadas.join(', ')}\n(Conecta esto a tu backend para guardar.)`);
        // Aquí podrías enviar una petición AJAX a tu controlador Laravel
    });
</script>

<style>
    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .list-group-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>
@endsection