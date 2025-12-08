@extends('layouts.app')
@include('partials.menu')

@section('title', 'Evaluar Maestros')

@section('content')
    <div class="container mt-4">
        <h2>Evaluar Maestros</h2>

        {{-- Mensajes --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif

        @if ($maestros->isEmpty())
            <div class="alert alert-info">
                No tienes maestros activos para evaluar en este momento.
            </div>
        @else
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($maestros as $maestro)
                        <tr>
                            <td>{{ $maestro->name }}</td>
                            <td>{{ $maestro->email }}</td>
                            <td>
                                @if ($maestro->evaluaciones->isNotEmpty())
                                    <span class="badge bg-warning">Ya evaluado</span>
                                @else
                                    <a href="{{ route('alumno.evaluaciones.create', $maestro->id) }}"
                                        class="btn btn-primary btn-sm">Evaluar</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @endif
    </div>
@endsection
