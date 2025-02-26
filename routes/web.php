<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/acerca-de', function () {return view('acerca_nosotros');})->name('acerca');

Route::get('/contactos', function () {return view('contactos');})->name('contacto');
