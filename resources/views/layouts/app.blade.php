<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de Horarios - Instituto Tecnológico de Ciudad Victoria">
    <meta name="author" content="Instituto Tecnológico de Ciudad Victoria">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎓</text></svg>"> <!-- Favicon básico; reemplaza con uno real -->
    <title>@yield('title', 'Sistema de Horarios')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> <!-- Agregado para íconos -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .navbar-brand i {
            margin-right: 10px;
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            margin-top: auto;
        }
        footer a {
            color: #adb5bd;
            text-decoration: none;
        }
        footer a:hover {
            color: white;
        }
        .container {
            min-height: calc(100vh - 200px); /* Asegura que el footer esté al fondo */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary" role="navigation" aria-label="Navegación principal">
  <div class="container-fluid">
    <a class="navbar-brand" href="/" aria-label="Ir al inicio">
        <i class="fas fa-university"></i> Tecnológico Ciudad Victoria
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        @yield('nav')
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link btn btn-danger text-white ms-2" href="/logout" aria-label="Cerrar sesión" onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?')">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main class="container mt-4" role="main">
    @yield('content')
</main>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
