@extends('layouts.app')
@extends('partials.menu')
@section('title', 'Dashboard Maestro')

<div class="container mt-4">

    <h2 class="fw-bold mb-3">
        Asistencias – {{ $grupo->nombre }} ({{ $grupo->materia->nombre }})
    </h2>

    <p class="text-muted mb-4">
        Maestro: {{ Auth::user()->name }}  
        • Horario: {{ $grupo->hora_inicio }} - {{ $grupo->hora_fin }}
    </p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($grupo->alumnos->isEmpty())
        <div class="alert alert-warning">
            Este grupo aún no tiene alumnos registrados.
        </div>

    @else

    
    <form action="{{ route('maestro.asistencias.registrar') }}" method="POST">
        @csrf

       
        <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">

       
        <label class="fw-bold mt-3">Fecha de Asistencia:</label>
        <input type="date" name="fecha" class="form-control w-25 mb-3" required>

        <table class="table table-bordered table-striped align-middle mt-3">
            <thead class="table-light">
                <tr>
                    <th>Alumno</th>
                    <th>Matrícula</th>
                    <th>Asistencia</th>
                </tr>
            </thead>

            <tbody>
                @foreach($grupo->alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->nombre }}</td>
                    <td>{{ $alumno->matricula }}</td>

                    <td>
                      
                        <input type="hidden" 
                               name="asistencias[{{ $alumno->id }}][alumno_id]" 
                               value="{{ $alumno->id }}">

                   
                        <select 
                            class="form-select" 
                            name="asistencias[{{ $alumno->id }}][estado]">
                            
                            <option value="asistió">Asistió</option>
                            <option value="falta">Faltó</option>
                            <option value="retardo">Retardo</option>
                            <option value="justificado">Justificado</option>
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary mt-3">
            Guardar Asistencias
        </button>
    </form>

    @endif

</div>
@endsection
