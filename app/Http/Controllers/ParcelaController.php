<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcela;
use App\Models\Productor;
use Illuminate\Support\Facades\Auth;

class ParcelaController extends Controller
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
    /**
     * Listar parcelas.
     */
    public function index()
    {
        $parcelas = Parcela::with('productor')->get();
        $productores = Productor::all(); // Obtener todos los productores para el select
        return view('parcelas.index1', compact('parcelas', 'productores'));
    }

    /**
     * Guardar una nueva parcela.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_parcela'  => 'required|string|max:255|unique:parcelas,nom_parcela',
            'ubicacion'    => 'required|string|max:255',
            'id_productor' => 'required|exists:productores,id_productor',
            'extension'    => 'required|string|max:50',
            'direccion'    => 'required|string|max:255',
            'CP'           => 'required|integer|min:10000|max:99999',
        ]);

        Parcela::create($validatedData);

        return redirect()->route('parcelas.index')->with('register', 'Parcela agregada exitosamente.');
    }

    /**
     * Actualizar parcela.
     */
    public function update(Request $request, int $id_parcela)
    {
        $parcela = Parcela::findOrFail($id_parcela);

        $validatedData = $request->validate([
            'nom_parcela'  => 'required|string|max:255|unique:parcelas,nom_parcela,' . $parcela->id_parcela . ',id_parcela',
            'ubicacion'    => 'required|string|max:255',
            'id_productor' => 'required|exists:productores,id_productor',
            'extension'    => 'required|string|max:50',
            'direccion'    => 'required|string|max:255',
            'CP'           => 'required|integer|min:10000|max:99999',
        ]);

        $parcela->update($validatedData);

        return redirect()->route('parcelas.index')->with('modify', 'Parcela actualizada exitosamente.');
    }

    /**
     * Eliminar parcela.
     */
    public function destroy(int $id_parcela)
    {
        $parcela = Parcela::findOrFail($id_parcela);
        $parcela->delete();

        return redirect()->route('parcelas.index')->with('destroy', 'Parcela eliminada exitosamente.');
    }
}
