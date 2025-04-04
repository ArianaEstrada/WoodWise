<?php

namespace App\Http\Controllers;

use App\Models\Estimacion;
use App\Models\Tipo_Estimacion;
use App\Models\Formula;
use App\Models\Troza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstimacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->persona->rol->nom_rol !== 'Administrador') {
                return response()->view('denegado', [], 403);
            }
            return $next($request);
        });
    }

    public function index()
{
    $estimaciones = Estimacion::with(['tipoEstimacion', 'formula', 'troza.especie', 'troza.parcela'])->get();
    $tiposEstimacion = Tipo_Estimacion::all();
    $trozas = Troza::with(['especie', 'parcela'])->get();
    
    // Obtener todas las fórmulas (para el filtrado inicial)
    $formulas = Formula::all();
    
    return view('estimaciones.index', compact('estimaciones', 'tiposEstimacion', 'formulas', 'trozas'));
}

public function getFormulasByTipo($tipoId)
{
    $tipo = Tipo_Estimacion::findOrFail($tipoId);
    
    // Definir qué fórmulas mostrar para cada tipo
    if ($tipo->desc_estimacion == 'Volumen Maderable') {
        $formulas = Formula::whereIn('nom_formula', [
            'Formula de HUMBER',
            'Formula de SMALIAN',
            'Formula de NEWTON'
        ])->get();
    } else {
        // Fórmulas por defecto para otros tipos
        $formulas = Formula::whereNotIn('nom_formula', [
          
        ])->get();
    }
    
    return response()->json($formulas);
}
public function store(Request $request)
{
    $request->validate([
        'id_tipo_e' => 'required|exists:tipo_estimaciones,id_tipo_e',
        'id_formula' => 'required|exists:formulas,id_formula',
        'id_troza' => 'required|exists:trozas,id_troza',
    ]);

    $troza = Troza::find($request->id_troza);
    $formula = Formula::find($request->id_formula);
    
    $calculo = null;
    
    switch ($formula->nom_formula) {
        case 'Formula de HUMBER':
            $calculo = Estimacion::calcularHumber($troza);
            break;
        case 'Formula de SMALIAN':
            $calculo = Estimacion::calcularSmalian($troza);
            break;
        case 'Formula de NEWTON':
            $calculo = Estimacion::calcularNewton($troza);
            break;
    }
    
    if ($calculo === null) {
        return back()->with('error', 'No se pudo calcular la estimación. Verifique los datos de la troza.');
    }
    
    Estimacion::create([
        'id_tipo_e' => $request->id_tipo_e,
        'id_formula' => $request->id_formula,
        'calculo' => $calculo,
        'id_troza' => $request->id_troza,
    ]);
    
    return redirect()->route('estimaciones.index')
           ->with('success', "Estimación calculada: $calculo m³");
}
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_tipo_e' => 'required|exists:tipo_estimaciones,id_tipo_e',
            'id_formula' => 'required|exists:formulas,id_formula',
            'id_troza' => 'required|exists:trozas,id_troza',
        ]);
    
        $calculo = Estimacion::calcularEstimacion($request->id_formula, $request->id_troza);
    
        if ($calculo === null) {
            return back()->with('error', 'No se pudo calcular la estimación. Verifique los datos de la troza.');
        }
    
        $estimacion = Estimacion::findOrFail($id);
        $estimacion->update([
            'id_tipo_e' => $request->id_tipo_e,
            'id_formula' => $request->id_formula,
            'calculo' => $calculo,
            'id_troza' => $request->id_troza,
        ]);
    
        return redirect()->route('estimaciones.index')->with('success', 'Estimación recalculada y actualizada con éxito.');
    }

   

    public function destroy($id)
    {
        $estimacion = Estimacion::findOrFail($id);
        $estimacion->delete();

        return redirect()->route('estimaciones.index')->with('success', 'Estimación eliminada con éxito.');
    }
}