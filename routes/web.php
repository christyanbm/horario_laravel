<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Importar controladores
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\JefeController;
use App\Http\Controllers\MaestroController;
use App\Http\Controllers\CoordinadorController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// DASHBOARD ADMIN
Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

// DASHBOARD ALUMNO
Route::get('/alumno/dashboard', [AlumnoController::class, 'index'])
    ->middleware(['auth', 'role:alumno'])
    ->name('alumno.dashboard');

// DASHBOARD JEFE
Route::get('/jefe/dashboard', [JefeController::class, 'index'])
    ->middleware(['auth', 'role:jefe'])
    ->name('jefe.dashboard');

// DASHBOARD MAESTRO
Route::get('/maestro/dashboard', [MaestroController::class, 'index'])
    ->middleware(['auth', 'role:maestro'])
    ->name('maestro.dashboard');

// DASHBOARD COORDINADOR
Route::get('/coordinador/dashboard', [CoordinadorController::class, 'index'])
    ->middleware(['auth', 'role:coordinador'])
    ->name('coordinador.dashboard');
