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

    /**
     * Listar técnicos.
     */
    public function index()
    {
        $tecnicos = Tecnico::with('persona')->get();
        return view('tecnicos.index', compact('tecnicos'));
    }

    /**
     * Guardar un nuevo técnico.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_persona'  => 'required|exists:personas,id_persona|unique:tecnicos,id_persona',
            'cedula_p'    => 'required|string|max:50|unique:tecnicos,cedula_p',
            'clave_tecnico' => 'required|string|max:50|unique:tecnicos,clave_tecnico',
        ]);

        Tecnico::create($validatedData);

        return redirect()->route('tecnicos.index')->with('register', 'Técnico agregado exitosamente.');
    }

    /**
     * Actualizar técnico.
     */
    public function update(Request $request, string $id)
    {
        $tecnico = Tecnico::findOrFail($id);

        $validatedData = $request->validate([
            'cedula_p'    => 'required|string|max:50|unique:tecnicos,cedula_p,' . $tecnico->id_tecnico . ',id_tecnico',
            'clave_tecnico' => 'required|string|max:50|unique:tecnicos,clave_tecnico,' . $tecnico->id_tecnico . ',id_tecnico',
        ]);

        $tecnico->update($validatedData);

        return redirect()->route('tecnicos.index')->with('modify', 'Técnico actualizado exitosamente.');
    }

    /**
     * Eliminar técnico.
     */
    public function destroy(string $id)
    {
        $tecnico = Tecnico::findOrFail($id);
        $tecnico->delete();

        return redirect()->route('tecnicos.index')->with('destroy', 'Técnico eliminado exitosamente.');
    }
}
