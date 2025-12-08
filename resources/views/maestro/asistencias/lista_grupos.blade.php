@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Asistencias')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Asistencias</h2>
    </div>

    <h4 class="mb-3 text-muted">Selecciona un grupo para registrar asistencias</h4>

    <div class="row g-4">

        @forelse($grupos as $grupo)
            <div class="col-md-4">
                <a href="{{ route('maestro.asistencias.grupo', $grupo->id) }}" class="text-decoration-none">
                    <div class="card shadow-sm border-0 h-100 group-card">
                        <div class="card-body text-center">

                            <div class="bg-primary text-white rounded-circle d-inline-flex 
                                justify-content-center align-items-center mb-3" 
                                style="width: 60px; height: 60px; font-size: 26px;">
                                <i class="fas fa-users"></i>
                            </div>

                            <h5 class="fw-bold">
                                {{ $grupo->nombre }}
                            </h5>

                            <p class="text-muted mb-1">
                                {{ $grupo->materia->nombre ?? 'Sin materia' }}
                            </p>

                            <button class="btn btn-outline-primary mt-2">
                                Ver asistencias
                            </button>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-muted">No tienes grupos asignados.</p>
        @endforelse

    </div>

</div>

<style>
.group-card {
    transition: all 0.2s ease-in-out;
}
.group-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
}
</style>

@endsection
