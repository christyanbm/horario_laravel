<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- Tailwind por CDN para evitar errores de Vite --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900 antialiased">

    <div class="min-h-screen flex flex-col items-center justify-center px-6">

        <h1 class="text-4xl font-bold text-indigo-600 mb-6">
            {{ config('app.name', 'Sistema de Horarios') }}
        </h1>

        <div class="bg-white rounded-xl shadow-md p-8 w-full max-w-2xl">

            <h2 class="text-2xl font-semibold mb-4">
                Bienvenido al Sistema de Gestión de Horarios
            </h2>

            <p class="text-gray-600 leading-relaxed">
                Desde esta plataforma podrás administrar grupos, asignaturas,
                maestros y horarios de manera centralizada.
            </p>

            <div class="mt-6">
                <a href="{{ route('login') }}"
                   class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Iniciar sesión
                </a>
            </div>

        </div>

    </div>

</body>
</html>
