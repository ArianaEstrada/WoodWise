<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PersonaController extends Controller
{
    /**
     * Asegurar que solo el administrador puede acceder a este controlador
     */
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

    /**
     * Mostrar la lista de usuarios
     */
    public function index()
    {
        $personas = Persona::with('rol')->get(); // Traer personas con sus roles
        $roles = Rol::all(); // Obtener roles disponibles

        return view('usuarios.index', compact('personas', 'roles'));
    }

    /**
     * Guardar un nuevo usuario
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom'       => 'required|string|max:100',
            'ap'        => 'required|string|max:100',
            'am'        => 'nullable|string|max:100',
            'telefono'  => 'required|string|max:15',
            'correo'    => 'required|email|unique:personas,correo',
            'contrasena'=> 'required|string|min:6|confirmed',
            'id_rol'    => 'required|exists:roles,id_rol',
        ]);

        $validatedData['contrasena'] = Hash::make($request->contrasena);

        Persona::create($validatedData);

        return redirect()->route('usuarios.index')->with('register', 'Usuario creado exitosamente.');
    }

    /**
     * Actualizar un usuario
     */
    public function update(Request $request, string $id)
    {
        $persona = Persona::findOrFail($id);

        $validatedData = $request->validate([
            'nom'       => 'required|string|max:100',
            'ap'        => 'required|string|max:100',
            'am'        => 'nullable|string|max:100',
            'telefono'  => 'required|string|max:15',
            'correo'    => 'required|email|unique:personas,correo,' . $persona->id_persona . ',id_persona',
            'id_rol'    => 'required|exists:roles,id_rol',
        ]);

        if ($request->filled('contrasena')) {
            $validatedData['contrasena'] = Hash::make($request->contrasena);
        }

        $persona->update($validatedData);

        return redirect()->route('usuarios.index')->with('modify', 'Usuario actualizado exitosamente.');
    }

    /**
     * Eliminar un usuario
     */
    public function destroy(string $id)
    {
        $persona = Persona::findOrFail($id);

        // Prevenir eliminación del usuario autenticado
        if ($persona->id_persona === Auth::id()) {
            return redirect()->route('usuarios.index')->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $persona->delete();

        return redirect()->route('usuarios.index')->with('destroy', 'Usuario eliminado exitosamente.');
    }
}
