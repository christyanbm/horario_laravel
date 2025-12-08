@extends('layouts.app')
@extends('partials.menu')

@section('title', 'Gestión de Horarios y Calificaciones')

@section('content')
<div class="container mt-4">

    {{-- Encabezado --}}
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 border-bottom pb-3">
        <div>
            <h2 class="fw-bold text-primary mb-1">Gestión de Horarios y Calificaciones</h2>
            <p class="text-muted mb-0">Administra los grupos, los alumnos inscritos y los horarios registrados.</p>
        </div>
    </div>

    {{-- Tabla principal --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Grupo</th>
                        <th>Materia</th>
                        <th>Docente</th>
                        <th>Horario</th>
                        <th>Alumnos Inscritos</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($grupos as $grupo)
                        <tr>
                            {{-- Nombre del grupo --}}
                            <td class="fw-semibold">
                                {{ $grupo->nombre }}
                            </td>

                            {{-- Materia --}}
                            <td>
                                {{ $grupo->materia->nombre ?? 'Sin asignar' }}
                            </td>

                            {{-- Maestro --}}
                            <td>
                                {{ $grupo->maestro->name ?? 'Sin asignar' }}
                            </td>

                            {{-- Horario --}}
                            <td>
                                {{ $grupo->horario ?? '-' }}
                            </td>

                            {{-- Lista de alumnos + calificación + eliminar --}}
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach ($grupo->alumnos as $alumno)
                                        <li class="mb-2">
                                            <div class="d-flex justify-content-between align-items-center">

                                                {{-- Nombre del alumno --}}
                                                <div>
                                                    <strong>{{ $alumno->name }}</strong><br>

                                                    {{-- Calificación --}}
                                                    <span class="text-muted">
                                                        Calificación:
                                                        {{ $alumno->calificacion ?? '-' }}
                                                    </span>

                                                    {{-- Badge de reprobado --}}
                                                    @if (isset($alumno->calificacion) && $alumno->calificacion < 60)
                                                        <span class="badge bg-danger ms-1">Reprobado</span>
                                                    @endif
                                                </div>

                                                {{-- Botón eliminar alumno --}}
                                                <form
                                                    action="{{ route('coordinador.grupos.removeAlumno', ['grupo' => $grupo->id, 'alumno' => $alumno->id]) }}"
                                                    method="POST" onsubmit="return confirm('¿Eliminar alumno del grupo?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i> Eliminar
                                                    </button>
                                                </form>

                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>

                            {{-- Acciones adicionales del grupo --}}
                            <td class="text-end">
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye"></i> Detalles
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection
