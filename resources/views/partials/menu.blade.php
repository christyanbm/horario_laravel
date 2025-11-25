<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <span class="badge bg-light text-primary me-2 rounded-circle"
                  style="width:40px;height:40px;display:inline-flex;align-items:center;justify-content:center;font-weight:800;">
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

                @if(auth()->check() && auth()->user()->is_admin)
                <li class="nav-item px-1">
                    <a class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                        Panel Administrador
                    </a>
                </li>

                <li class="nav-item px-1">
                    <a class="nav-link {{ request()->routeIs('admin.alumnos.index') ? 'active' : '' }}" href="{{ route('admin.alumnos.index') }}">
                        Gestionar Alumnos
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
