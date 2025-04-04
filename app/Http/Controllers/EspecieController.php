<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especie;
use Illuminate\Support\Facades\Auth;

class EspecieController extends Controller
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
    public function catalogo()
    {
        $especies = Especie::all();
        return view('especies.catalogo', compact('especies'));
    }
    public function index()
    {
        $especies = Especie::all();
        return view('especies.index', compact('especies'));
    }

    public function store(Request $request)
    {
    
        $validatedData = $request->validate([
            'nom_cientifico' => 'required|string|max:255',
            'nom_comun' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        // Si hay imagen, almacenarla
        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('imagenes_especies', 'public');
            $validatedData['imagen'] = $imagePath;
    
            // Imprimir la ruta donde se guarda la imagen
        }
    
        Especie::create($validatedData);
    
        return redirect()->route('especies.index')->with('register', ' ');
    }
    
    


    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nom_cientifico' => 'required|string|max:255',
            'nom_comun' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $especie = Especie::findOrFail($id);

        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('imagenes_especies', 'public');
            $validatedData['imagen'] = $imagePath;
        }

        $especie->update($validatedData);

        return redirect()->route('especies.index')->with('modify', 'Especie actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $especie = Especie::findOrFail($id);
        $especie->delete();

        return redirect()->route('especies.index')->with('destroy', 'Especie eliminada correctamente.');
    }
}
