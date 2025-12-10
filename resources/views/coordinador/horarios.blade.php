@extends('layouts.app')
@extends('partials.menu')

@section('title', 'Gestión de Horarios y Calificaciones')

@section('content')
    <div class="container mt-4">

        <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 border-bottom pb-3">
            <div>
                <h2 class="fw-bold text-primary mb-1">Gestión de Horarios y Calificaciones</h2>
                <p class="text-muted mb-0">Administra los grupos, los alumnos inscritos y los horarios registrados.</p>
            </div>
        </div>

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
                                <td class="fw-semibold">{{ $grupo->nombre }}</td>

                                <td>{{ $grupo->materia->nombre ?? 'Sin asignar' }}</td>

                                <td>{{ $grupo->maestro->name ?? 'Sin asignar' }}</td>

                                <td>{{ $grupo->horario ?? '-' }}</td>

                                <td>
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($grupo->alumnos as $alumno)
                                            <li class="mb-2">
                                                <div class="d-flex justify-content-between align-items-center">

                                                    <div>
                                                        <strong>{{ $alumno->name }}</strong><br>
                                                        <span class="text-muted">
                                                            Calificación: {{ $alumno->calificacion ?? '-' }}
                                                        </span>

                                                        @if (isset($alumno->calificacion) && $alumno->calificacion < 60)
                                                            <span class="badge bg-danger ms-1">Reprobado</span>
                                                        @endif
                                                    </div>

                                                    <form
                                                        action="{{ route('coordinador.grupos.alumnos.eliminar', [$grupo->id, $alumno->id]) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('¿Eliminar este alumno del grupo?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">Eliminar</button>
                                                    </form>


                                            
                                                    </form>

                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('coordinador.grupos.alumnos', $grupo->id) }}"
                                        class="btn btn-success btn-sm">
                                        <i class="bi bi-person-plus"></i> Agregar Alumno
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
