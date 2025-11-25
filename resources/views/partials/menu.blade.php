<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <span class="badge bg-light text-primary me-2 rounded-circle"
                  style="width:40px;height:40px;display:inline-flex;align-items:center;justify-content:center;font-weight:800;">
                CGBM
            </span>
            <span class="ms-1 fw-bold">Christian laravel</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Mover las rutas hacia la izquierda -->
            <ul class="navbar-nav me-auto nav-pills">
                <li class="nav-item px-1">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        Inicio
                    </a>
                </li>

                <li class="nav-item px-1">
                    <a class="nav-link {{ request()->routeIs('tarea.index') ? 'active' : '' }}" href="{{ route('tarea.index') }}">
                        Tareas
                    </a>
                </li>

                <li class="nav-item px-1">
                    <a class="nav-link {{ request()->routeIs('tarea.create') ? 'active' : '' }}" href="{{ route('tarea.create') }}">
                        Crear
                    </a>
                </li>
            </ul>


        </div>
    </div>
</nav>
