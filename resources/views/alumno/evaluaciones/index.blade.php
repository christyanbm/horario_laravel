@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Evaluar Maestros</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($maestros as $maestro)
                <tr>
                    <td>{{ $maestro->name }}</td>
                    <td>{{ $maestro->email }}</td>
                    <td>
                        <a href="{{ route('alumno.evaluaciones.create', $maestro->id) }}" class="btn btn-primary">Evaluar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection