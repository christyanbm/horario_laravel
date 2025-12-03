<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <span class="badge bg-light text-primary me-2 rounded-circle"
                style="width:50px;height:50px;display:inline-flex;align-items:center;justify-content:center;font-weight:800;">
                Tecnm
            </span>
            <span class="ms-1 fw-bold">Sistema de horarios</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto nav-pills">
                <li class="nav-item px-1">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        Inicio
                    </a>
                </li>

                @if (auth()->check() && auth()->user()->hasRole('admin'))
                    <li class="nav-item px-1">
                        <a class="nav-link {{ request()->routeIs('admin.alumnos') ? 'active' : '' }}"
                            href="{{ route('admin.alumnos') }}">
                            Gestionar Alumnos
                        </a>
                    </li>

                    <li class="nav-item px-1">
                        <a class="nav-link {{ request()->routeIs('admin.maestros') ? 'active' : '' }}"
                            href="{{ route('admin.maestros') }}">
                            Gestionar Maestros
                        </a>
                    </li>

                    <li class="nav-item px-1">
                        <a class="nav-link {{ request()->routeIs('admin.jefes') ? 'active' : '' }}"
                            href="{{ route('admin.jefes') }}">
                            Gestionar Jefes
                        </a>
                    </li>

                    <li class="nav-item px-1">
                        <a class="nav-link {{ request()->routeIs('admin.coordinadores') ? 'active' : '' }}"
                            href="{{ route('admin.coordinadores') }}">
                            Gestionar Coordinadores
                        </a>
                    </li>
                @endif
                {{-- Alumno --}}
                @if (auth()->check() && auth()->user()->hasRole('alumno'))
                    <li class="nav-item px-1">
                        <a class="nav-link {{ request()->routeIs('alumno.dashboard') ? 'active' : '' }}"
                            href="{{ route('alumno.dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link {{ request()->routeIs('alumno.horario.seleccion') ? 'active' : '' }}"
                            href="{{ route('alumno.horario.seleccion') }}">
                            Selección de Horario
                        </a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link {{ request()->routeIs('alumno.progreso') ? 'active' : '' }}"
                            href="{{ route('alumno.progreso') }}">
                            Progreso
                        </a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link {{ request()->routeIs('alumno.materias') ? 'active' : '' }}"
                            href="{{ route('alumno.materias') }}">
                            Mis Materias
                        </a>
                    </li>
                @endif
                {{-- Fin Alumno --}}

                {{-- Maestro --}}
                @if (auth()->check() && auth()->user()->hasRole('maestro'))
                    <li class="nav-item px-1">
                        <a class="nav-link {{ request()->routeIs('maestro.dashboard') ? 'active' : '' }}"
                            href="{{ route('maestro.dashboard') }}">
                            Dashboard Maestro
                        </a>
                    </li>
                @endif
                {{-- Fin Maestro --}}
                {{-- Jefe de Departamento --}}
                @if (auth()->check() && auth()->user()->hasRole('jefe'))
                    <li class="nav-item px-1">
                        <a class="nav-link {{ request()->routeIs('jefe.grupos') ? 'active' : '' }}"
                            href="{{ route('jefe.dashboard') }}">
                            Gestion de Grupos
                        </a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link {{ request()->routeIs('jefe.reportes') ? 'active' : '' }}"
                            href="{{ route('jefe.reportes') }}">
                            Reportes Académicos
                        </a>
                    </li>
                @endif
                {{-- Fin Jefe de Departamento --}}
                {{-- Coordinador --}}
                @if (auth()->check() && auth()->user()->hasRole('coordinador'))
                    <li class="nav-item px-1">
                        <a class="nav-link {{ request()->routeIs('coordinador.dashboard') ? 'active' : '' }}"
                            href="{{ route('coordinador.dashboard') }}">
                            Dashboard Coordinador
                        </a>
                    </li>
                @endif
                {{-- Fin Coordinador --}}


            </ul>
            </ul>

            @if (auth()->check())
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item px-1">
                        <span class="nav-link text-white">
                            {{ auth()->user()->name }}
                        </span>
                    </li>
                    <li class="nav-item px-1">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-white text-decoration-none">
                                Cerrar Sesión
                            </button>
                        </form>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>
