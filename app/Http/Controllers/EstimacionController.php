<?php

namespace App\Http\Controllers;

use App\Models\Estimacion;
use Illuminate\Http\Request;

class EstimacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->persona->rol->nom_rol !== 'Administrador' && Auth::user()->persona->rol->nom_rol !== 'Tecnico') {
                // Redirige a la vista 'denegado' con un código HTTP 403 (Forbidden)
                return response()->view('denegado', [], 403);
                
                // Opcional: Si prefieres usar abort (mostrará la vista 403 personalizada)
                // abort(403, 'No tienes permisos de administrador');
            }
            return $next($request);
        });
    }
    public function index()
    {
        $estimaciones = Estimacion::all();
        return view('CRUDs.estimaciones.index', compact('estimaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Estimacion $estimacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estimacion $estimacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estimacion $estimacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estimacion $estimacion)
    {
        //
    }
}
