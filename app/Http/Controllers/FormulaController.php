<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formula;

class FormulaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->persona->rol->nom_rol !== 'Administrador') {
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
        $formulas = Formula::all();
        return view('formulas.index', compact('formulas'));
    }

    public function create()
    {
        // No se necesita porque todo se maneja en index
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_formula' => 'required|string|max:255',
            'expresion' => 'required|string',
        ]);

        Formula::create($validatedData);

        return redirect()->route('formulas.index')->with('register', ' ');
    }

    public function show(string $id)
    {
        // No se necesita porque todo se maneja en index
    }

    public function edit(string $id)
    {
        // No se necesita porque todo se maneja en index
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nom_formula' => 'required|string|max:255',
            'expresion' => 'required|string',
        ]);

        $formula = Formula::findOrFail($id);
        $formula->update($validatedData);

        return redirect()->route('formulas.index')->with('modify', ' ');
    }

    public function destroy(string $id)
    {
        $formula = Formula::findOrFail($id);
        $formula->delete();

        return redirect()->route('formulas.index')->with('destroy', ' ');
    }
}
