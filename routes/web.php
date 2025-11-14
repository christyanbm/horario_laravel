<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckRole;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect('/login'));

Route::get('/login', fn() => view('auth.login'))->name('login');

Route::post('/login', function (Request $request) {
    $user = strtolower($request->input('user'));
    session()->flush();

    switch ($user) {
        case 'coordinador':
            session(['role' => 'coordinador']);
            return redirect('/coordinador');
        case 'maestro':
            session(['role' => 'maestro']);
            return redirect('/maestro');
        case 'alumno':
            session(['role' => 'alumno']);
            return redirect('/alumno');
        default:
            return redirect('/login')->with('error', 'Usuario no válido');
    }
});

Route::get('/logout', function () {
    session()->flush();
    return redirect('/login');
});


/*
|--------------------------------------------------------------------------
| Rutas del Alumno
|--------------------------------------------------------------------------
*/
Route::middleware([CheckRole::class])->prefix('alumno')->group(function () {
    Route::get('/', fn() => view('alumno.dashboard'));
    Route::get('/elegir_materias', fn() => view('alumno.elegir_materias'));
    Route::get('/promedios', fn() => view('alumno.promedios'));
    Route::get('/materias_semestre', fn() => view('alumno.materias_semestre'));
});


/*
|--------------------------------------------------------------------------
| Rutas del Maestro
|--------------------------------------------------------------------------
*/
Route::middleware([CheckRole::class])->prefix('maestro')->group(function () {
    Route::get('/', fn() => view('maestro.dashboard'));
    Route::get('/materias', fn() => view('maestro.materias'));
    
    Route::get('/asistencias', function() {
        $materiasISC = ['Matemáticas', 'Programación', 'Historia', 'Física', 'Inglés'];
        $alumnos = ['Juan Pérez', 'Ana Gómez', 'Luis Hernández', 'María Torres', 'Pedro Ramírez'];
        return view('maestro.asistencias', compact('materiasISC', 'alumnos'));
    });
});


/*
|--------------------------------------------------------------------------
| Rutas del Coordinador
|--------------------------------------------------------------------------
*/
Route::middleware([CheckRole::class])->prefix('coordinador')->group(function () {
    Route::get('/', fn() => view('coordinador.dashboard'));
    Route::get('/asignar_materias', fn() => view('coordinador.asignar_materias'));
    // Route::get('/agregar_materias', fn() => view('coordinador.agregar_materias')); // Eliminada
    Route::get('/asignar_materias_maestros', fn() => view('coordinador.asignar_materias_maestros'));
});
