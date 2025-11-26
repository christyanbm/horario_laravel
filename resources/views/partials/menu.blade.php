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
