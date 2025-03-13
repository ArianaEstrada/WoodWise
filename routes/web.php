<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/acerca-de', function () {return view('acerca_nosotros');})->name('acerca');

Route::get('/contactos', function () {return view('contactos');})->name('contacto');

Route::get('/validar-cedula', [RegisterController::class, 'confirmarCedula'])->name('validar.cedula');
Route::post('/confirmar-cedula', [RegisterController::class, 'confirmarCedula'])->name('confirmar.cedula');
