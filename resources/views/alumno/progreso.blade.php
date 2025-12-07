@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Progreso Académico')

@section('content')
<div class="container mt-4">

    <h2 class="fw-bold text-primary mb-4">Tu Progreso Académico</h2>

    {{-- Gráfica simplificada de resumen académico --}}
    <div class="card shadow-sm mb-5">
        <div class="card-header">Resumen Académico</div>
        <div class="card-body text-center">
            <h4>Promedio General</h4>
            <h1 class="display-1 text-primary fw-bold">{{ $promedio }}</h1>
            <div class="mt-4">
                <h6>Créditos Cursados: {{ $creditosCursados }} / {{ $totalCreditos }}</h6>
                <div class="progress mb-3" style="height: 20px;">
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ ($creditosCursados/$totalCreditos)*100 }}%">
                        {{ number_format(($creditosCursados/$totalCreditos)*100, 1) }}%
                    </div>
                </div>
                <h6>Créditos Aprobados: {{ $creditosAprobados }} / {{ $totalCreditos }}</h6>
                <div class="progress" style="height: 20px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($creditosAprobados/$totalCreditos)*100 }}%">
                        {{ number_format(($creditosAprobados/$totalCreditos)*100, 1) }}%
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Materias por semestre --}}
    @foreach($materiasPorSemestre as $semestre => $materias)
        <div class="card shadow-sm mb-4">
            <div class="card-header">Semestre {{ $semestre }}</div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                    @foreach($materias as $item)
                        @php
                            if(isset($item->calificacion)){
                                if($item->calificacion >= 70){
                                    $color = 'bg-success text-white'; // verde: aprobada
                                } else {
                                    $color = 'bg-danger text-white'; // rojo: reprobada
                                }
                            } elseif(isset($item->enCurso) && $item->enCurso){
                                $color = 'bg-primary text-white'; // azul: en curso
                            } else {
                                $color = 'bg-warning text-dark'; // amarillo: pendiente
                            }
                        @endphp
                        <div class="col">
                            <div class="card {{ $color }} text-center shadow-sm tablero-card">
                                <div class="card-body p-3">
                                    <h6 class="card-title">{{ $item->materia->nombre ?? $item->nombre }}</h6>
                                    @if(isset($item->maestro))
                                        <p class="mb-1 small">Docente: {{ $item->maestro->name }}</p>
                                    @endif
                                    <p class="fw-bold mb-0">
                                        @if(isset($item->calificacion))
                                            {{ $item->calificacion }}
                                        @elseif(isset($item->enCurso) && $item->enCurso)
                                            En curso
                                        @else
                                            Pendiente
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

</div>

{{-- Estilos para tablero --}}
<style>
.tablero-card {
    min-height: 120px;
    transition: transform 0.2s, box-shadow 0.2s;
}
.tablero-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}
</style>
@endsection
