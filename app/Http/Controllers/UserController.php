<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function perfil()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        return view('components.perfil', compact('user')); // Pasar el usuario a la vista
    }
}
