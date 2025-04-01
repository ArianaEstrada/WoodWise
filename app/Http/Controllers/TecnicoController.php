<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tecnico;
use App\Models\Persona;
use Illuminate\Support\Facades\Auth;

class TecnicoController extends Controller
{
    /**
     * Restringir acceso a administradores.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->persona->rol->nom_rol !== 'Administrador') {
                return redirect()->route('home')->with('error', 'Acceso denegado.');
            }
            return $next($request);
        });
    }
    public function getNombreCompletoAttribute()
    {
        return "{$this->nom} {$this->ap} {$this->am}";
    }
    
    /**
     * Listar técnicos.
     */
    public function index()
    {
        $tecnicos = Tecnico::with('persona')->get();
        $personas = Persona::all(); // Obtener todas las personas para el select
        return view('tecnicos.index', compact('tecnicos', 'personas'));
    }

 
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_persona' => 'required|exists:personas,id_persona|unique:tecnicos,id_persona',
            'cedula_p'   => 'nullable|string|max:50|unique:tecnicos,cedula_p',
        ]);
    
        // Generar una clave única para el técnico
        do {
            $clave_tecnico = strtoupper(str()->random(8)); // Generar clave aleatoria de 8 caracteres
        } while (Tecnico::where('clave_tecnico', $clave_tecnico)->exists());
    
        // Agregar la clave generada al arreglo de datos validados
        $validatedData['clave_tecnico'] = $clave_tecnico;
    
        Tecnico::create($validatedData);
    
        return redirect()->route('tecnicos.index')->with('register', 'Técnico agregado exitosamente.');
    }
    

    /**
     * Actualizar técnico.
     */
    public function update(Request $request, string $id_tecnico)
    {
        $tecnico = Tecnico::findOrFail($id_tecnico);

        $validatedData = $request->validate([
            'cedula_p'      => 'required|string|max:50|unique:tecnicos,cedula_p,' . $tecnico->id_tecnico . ',id_tecnico',
            'clave_tecnico' => 'nullable|string|max:50|unique:tecnicos,clave_tecnico,' . $tecnico->id_tecnico . ',id_tecnico',
        ]);

        $tecnico->update($validatedData);

        return redirect()->route('tecnicos.index')->with('modify', 'Técnico actualizado exitosamente.');
    }

    /**
     * Eliminar técnico.
     */
    public function destroy(string $id_tecnico)
    {
        $tecnico = Tecnico::findOrFail($id_tecnico);
        $tecnico->delete();

        return redirect()->route('tecnicos.index')->with('destroy', 'Técnico eliminado exitosamente.');
    }
}
