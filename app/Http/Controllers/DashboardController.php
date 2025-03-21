<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    /**
     * Muestra la vista del dashboard.
     */
    public function index()
    {
        $user = Auth::user(); // Obtener el usuario autenticado

        return view('dashboard', compact('user')); // Asegúrate de que la vista exista en resources/views/dashboard.blade.php
    }
}
