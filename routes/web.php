<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\ParcelaController;
use App\Http\Controllers\FormulaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrozaController;
use App\Http\Controllers\EstimacionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\TipoEstimacionController;
use App\Http\Controllers\ProductorController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\TurnoCortaController;
use App\Http\Controllers\AsignaParcelaController;



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
    Route::resource('productores', ProductorController::class);
    Route::resource('tecnicos', TecnicoController::class);
    Route::resource('parcelas', ParcelaController::class);
    Route::resource('trozas', TrozaController::class);
    Route::resource('turno_cortas', TurnoCortaController::class);
    Route::resource('asigna_parcelas', AsignaParcelaController::class);
    Route::resource('estimaciones', EstimacionController::class);
    Route::get('/estimaciones/formulas-por-tipo/{tipoId}', [EstimacionController::class, 'getFormulasByTipo']);
    Route::get('/catalogo-especies', [EspecieController::class, 'catalogo'])->name('especies.catalogo');
