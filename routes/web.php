<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\FormulaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrozaController;
use App\Http\Controllers\EstimacionController;
use App\Http\Controllers\ParcelaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\TipoEstimacionController;

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

// Ruta de perfil

Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');
    Route::put('/perfil/password', [PerfilController::class, 'updatePassword'])->name('perfil.updatePassword');
});   

Route::get('/dashboard1', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard1');

    Route::resource('formulas', FormulaController::class);
    Route::resource('especies', EspecieController::class);
    Route::resource('usuarios', PersonaController::class);
    Route::resource('tipo_estimaciones', TipoEstimacionController::class);


    Route::get('/catalogo-especies', [EspecieController::class, 'catalogo'])->name('especies.catalogo');
