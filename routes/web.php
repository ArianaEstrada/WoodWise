<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\FormulaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrozaController;
use App\Http\Controllers\EstimacionController;
use App\Http\Controllers\ParcelaController;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Autenticación
Auth::routes();

// Rutas públicas
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/acerca-de', fn() => view('acerca_nosotros'))->name('acerca');
Route::get('/contactos', fn() => view('contactos'))->name('contacto');

// Validación de cédula
Route::controller(RegisterController::class)->group(function () {
    Route::get('/validar-cedula', 'confirmarCedula')->name('validar.cedula');
    Route::post('/confirmar-cedula', 'confirmarCedula')->name('confirmar.cedula');
});

// Rutas del dashboard con prefijo
Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/formulas', [FormulaController::class, 'index'])->name('formulas.index');
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::get('/trozas', [TrozaController::class, 'index'])->name('trozas.index');
    Route::get('/estimaciones', [EstimacionController::class, 'index'])->name('estimaciones.index');
    Route::get('/parcelas', [ParcelaController::class, 'index'])->name('parcelas.index');

    // Resource para especies (incluyendo show, edit, update dentro del dashboard)
    Route::resource('especies', EspecieController::class)->only(['index', 'show', 'edit', 'update']);
});

// Ruta de perfil

    Route::get('/perfil', [UserController::class, 'perfil'])->middleware('auth')->name('perfil');
    Route::resource('dashboard/especies', EspecieController::class);
