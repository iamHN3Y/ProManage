<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProyectoController;

// Ruta para la página de inicio
Route::get('/', [HomeController::class, 'index'])->name('index');

// Rutas de autenticación
Auth::routes();

// Rutas de recursos para proyectos, tareas, y usuarios
Route::resource('proyectos', ProyectoController::class);
Route::resource('tareas', TareaController::class);
Route::resource('users', UserController::class);

// Ruta de HomeController para /home, si es necesario
// Asegúrate de que no esté duplicada si es la misma que la ruta de inicio ('/')
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rutas adicionales para crear tareas en un proyecto específico
Route::get('/proyectos/{proyecto}', [ProyectoController::class, 'show'])->name('proyectos.show');
Route::get('proyectos/{proyecto}/tareas/create', [TareaController::class, 'create'])->name('tareas.create');
Route::post('tareas', [TareaController::class, 'store'])->name('tareas.store');
