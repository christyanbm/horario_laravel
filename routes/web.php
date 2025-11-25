<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\JefeController;
use App\Http\Controllers\MaestroController;
use App\Http\Controllers\CoordinadorController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Redirección automática según rol
Route::get('/home', function () {
    $role = Auth::user()->getRoleNames()->first();
    return redirect("/$role/dashboard");
})->middleware('auth')->name('home');


// ===========================
//  DASHBOARDS POR ROL
// ===========================

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // El admin puede ver pantallas de TODOS
    Route::get('/admin/alumnos', [AlumnoController::class, 'adminList'])->name('admin.alumnos');
    Route::get('/admin/maestros', [MaestroController::class, 'adminList'])->name('admin.maestros');
    Route::get('/admin/jefes', [JefeController::class, 'adminList'])->name('admin.jefes');
    Route::get('/admin/coordinadores', [CoordinadorController::class, 'adminList'])->name('admin.coordinadores');
});



// ===========================
//  ALUMNO
// ===========================
Route::prefix('alumno')
    ->middleware(['auth', 'role:alumno'])
    ->name('alumno.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [AlumnoController::class, 'index'])->name('dashboard');

    // Selección de horario
    Route::get('/horario', [AlumnoController::class, 'seleccionarHorario'])->name('horario.seleccion');

    // Progreso del alumno
    Route::get('/progreso', [AlumnoController::class, 'progreso'])->name('progreso');

    // Materias (ejemplo adicional)
    Route::get('/materias', [AlumnoController::class, 'materias'])->name('materias');
});

// ===========================
//  MAESTRO
// ===========================
Route::prefix('maestro')
    ->middleware(['auth', 'role:maestro'])
    ->name('maestro.')
    ->group(function () {

        Route::get('/dashboard', [MaestroController::class, 'index'])->name('dashboard');
        Route::get('/asistencias', [MaestroController::class, 'asistencias'])->name('asistencias');
        Route::get('/calificaciones-finales', [MaestroController::class, 'calificacionesFinales'])->name('calificaciones.finales');
});

// ===========================
//  JEFE DE CARRERA
// ===========================
Route::prefix('jefe')
    ->middleware(['auth', 'role:jefe'])
    ->name('jefe.')
    ->group(function () {

    Route::get('/dashboard', [JefeController::class, 'index'])->name('dashboard');
    Route::get('/grupos', [JefeController::class, 'grupos'])->name('grupos');
    Route::get('/reportes', [JefeController::class, 'reportes'])->name('reportes');
});


// ===========================
//  COORDINADOR
// ===========================
Route::prefix('coordinador')
    ->middleware(['auth', 'role:coordinador'])
    ->name('coordinador.')
    ->group(function () {

    Route::get('/dashboard', [CoordinadorController::class, 'index'])->name('dashboard');
    Route::get('/horarios', [CoordinadorController::class, 'horarios'])->name('horarios');
    Route::get('/asignaciones', [CoordinadorController::class, 'asignaciones'])->name('asignaciones');
});
//ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/usuarios', [AdminController::class, 'listUsers'])->name('admin.usuarios');

    Route::get('/admin/alumnos', [AdminController::class, 'listAlumnos'])->name('admin.alumnos');
    Route::get('/admin/maestros', [AdminController::class, 'listMaestros'])->name('admin.maestros');
    Route::get('/admin/jefes', [AdminController::class, 'listJefes'])->name('admin.jefes');
    Route::get('/admin/coordinadores', [AdminController::class, 'listCoordinadores'])->name('admin.coordinadores');

    // Formulario crear usuario
    Route::get('/admin/usuarios/create', [AdminController::class, 'create'])->name('admin.usuarios.create');
    Route::post('/admin/usuarios', [AdminController::class, 'store'])->name('admin.usuarios.store');

    // Editar y eliminar
    Route::get('/admin/usuarios/{id}/edit', [AdminController::class, 'edit'])->name('admin.usuarios.edit');
    Route::put('/admin/usuarios/{id}', [AdminController::class, 'update'])->name('admin.usuarios.update');
    Route::delete('/admin/usuarios/{id}', [AdminController::class, 'destroy'])->name('admin.usuarios.destroy');
});
