<?php

namespace App\Http\Controllers;

use App\Models\Turno_Corta;
use App\Models\Parcela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TurnoCortaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->persona->rol->nom_rol !== 'Administrador' && Auth::user()->persona->rol->nom_rol !== 'Productor') {
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
        $turnos = Turno_Corta::with('parcela')->get();
        $parcelas = Parcela::all();
        return view('turno_cortas.index', compact('turnos', 'parcelas'));
    }

    /**
     * Guardar un nuevo turno de corta.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_parcela' => 'required|exists:parcelas,id_parcela',
        ]);

        $validatedData = array_merge($validatedData, [
            'codigo_corta' => Str::uuid()->toString(),
            'fecha_corta' => Carbon::now(),
        ]);

        Turno_Corta::create($validatedData);

        return redirect()->route('turno_cortas.index')
            ->with('register', 'Turno de corta agregado exitosamente.');
    }

    /**
     * Actualizar turno de corta.
     */
    public function update(Request $request, int $id_turno)
    {
        $turno = Turno_Corta::findOrFail($id_turno);

        $validatedData = $request->validate([
            'id_parcela' => 'required|exists:parcelas,id_parcela',
        ]);

        $turno->update($validatedData);

        return redirect()->route('turno_cortas.index')
            ->with('modify', 'Turno de corta actualizado exitosamente.');
    }

    /**
     * Eliminar turno de corta.
     */
    public function destroy(int $id_turno)
    {
        $turno = Turno_Corta::findOrFail($id_turno);
        $turno->delete();

        return redirect()->route('turno_cortas.index')
            ->with('destroy', 'Turno de corta eliminado exitosamente.');
    }
}
