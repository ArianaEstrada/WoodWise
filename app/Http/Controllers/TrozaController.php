<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Troza;
use App\Models\Especie;
use App\Models\Parcela;
use Illuminate\Support\Facades\Auth;

class TrozaController extends Controller
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
     * Listar trozas.
     */
    public function index()
    {
        $trozas = Troza::with(['especie', 'parcela'])->get();
        $especies = Especie::all();
        $parcelas = Parcela::all();
        return view('trozas.index', compact('trozas', 'especies', 'parcelas'));
    }

    /**
     * Guardar una nueva troza.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'longitud'  => 'required|numeric|min:0',
            'diametro'  => 'required|numeric|min:0',
            'densidad'  => 'required|numeric|min:0',
            'id_especie' => 'required|exists:especies,id_especie',
            'id_parcela' => 'required|exists:parcelas,id_parcela',
        ]);

        Troza::create($validatedData);

        return redirect()->route('trozas.index')->with('register', 'Troza agregada exitosamente.');
    }

    /**
     * Actualizar troza.
     */
    public function update(Request $request, int $id_troza)
    {
        $troza = Troza::findOrFail($id_troza);

        $validatedData = $request->validate([
            'longitud'  => 'required|numeric|min:0',
            'diametro'  => 'required|numeric|min:0',
            'densidad'  => 'required|numeric|min:0',
            'id_especie' => 'required|exists:especies,id_especie',
            'id_parcela' => 'required|exists:parcelas,id_parcela',
        ]);

        $troza->update($validatedData);

        return redirect()->route('trozas.index')->with('modify', 'Troza actualizada exitosamente.');
    }

    /**
     * Eliminar troza.
     */
    public function destroy(int $id_troza)
    {
        $troza = Troza::findOrFail($id_troza);
        $troza->delete();

        return redirect()->route('trozas.index')->with('destroy', 'Troza eliminada exitosamente.');
    }
}
