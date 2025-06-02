<?php

namespace App\Http\Controllers;

use App\Models\Estimacion1;
use App\Models\Tipo_Estimacion;
use App\Models\Formula;
use App\Models\Arbol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Estimacion1Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->persona->rol->nom_rol !== 'Administrador' && 
                Auth::user()->persona->rol->nom_rol !== 'Tecnico') {
                return response()->view('denegado', [], 403);
            }
            return $next($request);
        });
    }

    /**
     * Mostrar listado de estimaciones con paginación
     */
    public function index(Request $request)
    {
        $query = Estimacion1::with(['tipoEstimacion', 'formula', 'arbol.especie', 'arbol.parcela']);
        
        // Búsqueda
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('calculo', 'like', "%$search%")
                  ->orWhereHas('tipoEstimacion', function($q) use ($search) {
                      $q->where('desc_estimacion', 'like', "%$search%");
                  })
                  ->orWhereHas('formula', function($q) use ($search) {
                      $q->where('nom_formula', 'like', "%$search%");
                  })
                  ->orWhereHas('arbol', function($q) use ($search) {
                      $q->where('id_arbol', 'like', "%$search%")
                        ->orWhereHas('especie', function($q) use ($search) {
                            $q->where('nom_cientifico', 'like', "%$search%");
                        })
                        ->orWhereHas('parcela', function($q) use ($search) {
                            $q->where('nom_parcela', 'like', "%$search%");
                        });
                  });
            });
        }
        
        // Ordenación
        $sortField = $request->get('sort', 'id_estimacion1');
        $sortDirection = $request->get('direction', 'asc');
        $query->orderBy($sortField, $sortDirection);
        
        $estimaciones = $query->paginate(10);
        $tiposEstimacion = Tipo_Estimacion::all();
        $formulas = Formula::all();
        $arboles = Arbol::with(['especie', 'parcela'])->get();
        
        return view('estimaciones1.index', compact('estimaciones', 'tiposEstimacion', 'formulas', 'arboles'));
    }

    /**
     * Obtener fórmulas por tipo (para AJAX)
     */
    public function getFormulasByTipo($tipoId)
    {
        $formulas = Formula::where('id_tipo_e', $tipoId)->get();
        return response()->json($formulas);
    }

    /**
     * Almacenar nueva estimación
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_tipo_e' => 'required|exists:tipo_estimaciones,id_tipo_e',
            'id_formula' => [
                'required',
                'exists:formulas,id_formula',
                Rule::unique('estimaciones1')->where(function ($query) use ($request) {
                    return $query->where('id_arbol', $request->id_arbol)
                               ->where('id_tipo_e', $request->id_tipo_e);
                })
            ],
            'id_arbol' => 'required|exists:arboles,id_arbol',
            'calculo' => 'nullable|numeric'
        ]);

        // Calcular automáticamente si no se proporciona
        if (empty($validatedData['calculo'])) {
            $validatedData['calculo'] = $this->calcularEstimacion(
                $validatedData['id_formula'],
                $validatedData['id_arbol']
            );
        }

        Estimacion1::create($validatedData);

        return redirect()->route('estimaciones1.index')
               ->with('success', 'Estimación creada correctamente');
    }

    /**
     * Actualizar estimación existente
     */
    public function update(Request $request, $id)
    {
        $estimacion = Estimacion1::findOrFail($id);
        
        $validatedData = $request->validate([
            'id_tipo_e' => 'required|exists:tipo_estimaciones,id_tipo_e',
            'id_formula' => [
                'required',
                'exists:formulas,id_formula',
                Rule::unique('estimaciones1')->where(function ($query) use ($request, $estimacion) {
                    return $query->where('id_arbol', $request->id_arbol)
                               ->where('id_tipo_e', $request->id_tipo_e)
                               ->where('id_estimacion1', '!=', $estimacion->id_estimacion1);
                })
            ],
            'id_arbol' => 'required|exists:arboles,id_arbol',
            'calculo' => 'nullable|numeric'
        ]);

        // Recalcular si no se proporciona
        if (empty($validatedData['calculo'])) {
            $validatedData['calculo'] = $this->calcularEstimacion(
                $validatedData['id_formula'],
                $validatedData['id_arbol']
            );
        }

        $estimacion->update($validatedData);

        return redirect()->route('estimaciones1.index')
               ->with('success', 'Estimación actualizada correctamente');
    }

    /**
     * Eliminar estimación
     */
    public function destroy($id)
    {
        $estimacion = Estimacion1::findOrFail($id);
        $estimacion->delete();

        return redirect()->route('estimaciones1.index')
               ->with('success', 'Estimación eliminada correctamente');
    }

    /**
     * Calcular estimación basada en fórmula y árbol
     */
    private function calcularEstimacion($formulaId, $arbolId)
    {
        $formula = Formula::findOrFail($formulaId);
        $arbol = Arbol::with('especie')->findOrFail($arbolId);
        
        // Extraer variables necesarias del árbol
        $variables = [
            'DAP' => $arbol->diametro_pecho,
            'ALTURA' => $arbol->altura_total,
            'FACTOR_ESPECIE' => $arbol->especie->factor_forma ?? 0.5,
            'DENSIDAD' => $arbol->especie->densidad_madera ?? 0.7
        ];
        
        // Reemplazar variables en la expresión
        $expresion = $formula->expresion;
        foreach ($variables as $key => $value) {
            $expresion = str_replace($key, $value, $expresion);
        }
        
        // Evaluar la expresión matemática
        try {
            return eval("return $expresion;");
        } catch (\Throwable $th) {
            return 0; // O manejar el error apropiadamente
        }
    }
}