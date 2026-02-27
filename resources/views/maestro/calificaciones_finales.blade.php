@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Prototipo Calificaciones')

@section('content')
<div class="container mt-4">

    
    <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-3">
        <div>
            <h2 class="fw-bold text-primary mb-1">Acta de Calificaciones</h2>
            <h5 class="text-muted">Matemáticas Discretas • Grupo A (Demo)</h5>
        </div>
        <div class="text-end">
            <span class="badge bg-warning text-dark border p-2">
                <i class="bi bi-eye"></i> Modo Prototipo
            </span>
        </div>
    </div>

    <div class="card shadow-sm border-0">

       
        <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
            <span class="fw-bold text-secondary">Listado de Alumnos (3)</span>
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="resetearDemo()">
                <i class="bi bi-arrow-counterclockwise"></i> Reiniciar Demo
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 table-bordered">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 15%">Matrícula</th>
                            <th style="width: 40%" class="text-start">Alumno</th>
                            <th style="width: 15%">Asistencias</th>
                            <th style="width: 25%">Calif. Final</th>
                        </tr>
                    </thead>
                    <tbody id="tablaAlumnos">

                       
                        <tr>
                            <td class="text-center fw-bold text-muted">1</td>
                            <td class="text-center font-monospace">193001</td>
                            <td>
                                <span class="fw-bold text-dark">Alvarez, Luis</span>
                            </td>
                            <td class="text-center text-success">95%</td>
                            <td class="p-2">
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control text-center fw-bold input-nota"
                                           min="0" max="100" placeholder="-" oninput="simularValidacion(this)">
                                    <span class="input-group-text status-icon"><i class="bi bi-dash-circle text-muted"></i></span>
                                </div>
                            </td>
                        </tr>

                        {{-- ALUMNO 2 --}}
                        <tr>
                            <td class="text-center fw-bold text-muted">2</td>
                            <td class="text-center font-monospace">193002</td>
                            <td>
                                <span class="fw-bold text-dark">Benitez, Carla</span>
                            </td>
                            <td class="text-center text-success">100%</td>
                            <td class="p-2">
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control text-center fw-bold input-nota"
                                           min="0" max="100" placeholder="-" value="95" oninput="simularValidacion(this)">
                                    <span class="input-group-text status-icon"><i class="bi bi-dash-circle text-muted"></i></span>
                                </div>
                            </td>
                        </tr>

                       
                        <tr>
                            <td class="text-center fw-bold text-muted">3</td>
                            <td class="text-center font-monospace">193003</td>
                            <td>
                                <span class="fw-bold text-dark">Castro, Mario</span>
                                <span class="badge bg-danger ms-2">SD</span>
                            </td>
                            <td class="text-center text-danger fw-bold">60%</td>
                            <td class="p-2">
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control text-center fw-bold input-nota"
                                           min="0" max="100" placeholder="-" value="50" oninput="simularValidacion(this)">
                                    <span class="input-group-text status-icon"><i class="bi bi-dash-circle text-muted"></i></span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

       
        <div class="card-footer bg-white py-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="checkCerrar" onchange="toggleCierre(this)">
                        <label class="form-check-label fw-bold" for="checkCerrar">Finalizar y Cerrar Acta</label>
                        <div class="form-text text-muted small">
                            Simula el bloqueo de edición.
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    
                    <button type="button" class="btn btn-primary px-5 shadow-sm" id="btnGuardar" onclick="simularGuardado()">
                        <i class="bi bi-save me-2"></i> Guardar Todo
                    </button>
                </div>
            </div>
        </div>
    </div>

  
    <div class="alert alert-success fixed-bottom m-4 shadow-lg" id="alertaExito" style="display: none; max-width: 400px;">
        <i class="bi bi-check-circle-fill me-2"></i> <strong>¡Éxito!</strong> Calificaciones guardadas correctamente.
    </div>

</div>


<script>
    
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll('.input-nota').forEach(input => simularValidacion(input));
    });

    
    function simularValidacion(input) {
        const val = parseInt(input.value);
        const icon = input.nextElementSibling;

        input.classList.remove('text-danger', 'text-success', 'bg-danger', 'bg-success');
        input.style.backgroundColor = "";

        if (isNaN(val)) {
            icon.innerHTML = '<i class="bi bi-dash-circle text-muted"></i>';
            return;
        }

        if (val < 70) {
            input.classList.add('text-danger');
            input.style.backgroundColor = "#fff5f5"; 
            icon.innerHTML = '<i class="bi bi-x-circle-fill text-danger"></i>';
        } else {
            input.classList.add('text-success');
            icon.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i>';
        }
    }

    
    function simularGuardado() {
        const btn = document.getElementById('btnGuardar');
        const originalText = btn.innerHTML;

       
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Guardando...';

       
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;

           
            const alerta = document.getElementById('alertaExito');
            alerta.style.display = 'block';
            alerta.classList.add('animate__animated', 'animate__fadeInUp'); 

          
            setTimeout(() => {
                alerta.style.display = 'none';
            }, 3000);

        }, 1500);
    }

  
    function toggleCierre(checkbox) {
        const inputs = document.querySelectorAll('.input-nota');
        const btn = document.getElementById('btnGuardar');

        if (checkbox.checked) {
            inputs.forEach(i => i.disabled = true);
            btn.disabled = true;
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-secondary');
            btn.innerText = "Acta Cerrada";
        } else {
            inputs.forEach(i => i.disabled = false);
            btn.disabled = false;
            btn.classList.add('btn-primary');
            btn.classList.remove('btn-secondary');
            btn.innerHTML = '<i class="bi bi-save me-2"></i> Guardar Todo';
        }
    }

   
    function resetearDemo() {
        document.querySelectorAll('.input-nota').forEach(i => {
            i.value = '';
            i.disabled = false;
            simularValidacion(i);
        });
        document.getElementById('checkCerrar').checked = false;
        toggleCierre(document.getElementById('checkCerrar'));
    }
</script>
@endsection
