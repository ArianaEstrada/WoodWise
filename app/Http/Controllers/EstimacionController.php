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
    switch ($tipo->desc_estimacion) {
        case 'Volumen Maderable':
            $formulas = Formula::whereIn('nom_formula', [
                'Formula de HUMBER',
                'Formula de SMALIAN',
                'Formula de NEWTON'
            ])->get();
            break;
            
        case 'Carbono':
            $formulas = Formula::whereIn('nom_formula', [
                'Formula de Carbono 1',
                'Formula de Carbono 2'
                // Agrega aquí las fórmulas reales para carbono
            ])->get();
            break;
            
        case 'Biomasa':
            $formulas = Formula::whereIn('nom_formula', [
                'Formula de Biomasa 1',
                'Formula de Biomasa 2'
                // Agrega aquí las fórmulas reales para biomasa
            ])->get();
            break;
            
        case 'Área Basal':
            $formulas = Formula::whereIn('nom_formula', [
                'Formula de Área Basal 1',
                'Formula de Área Basal 2'
                // Agrega aquí las fórmulas reales para área basal
            ])->get();
            break;
            
        default:
            $formulas = Formula::all();
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
    
    // Validar campos requeridos según la fórmula
    $errors = [];
    
    switch ($formula->nom_formula) {
        case 'Formula de HUMBER':
            if (!$troza->diametro || !$troza->longitud) {
                $errors[] = 'La fórmula HUMBER requiere diámetro y longitud';
            }
            break;
            
        case 'Formula de SMALIAN':
            if (!$troza->diametro || !$troza->longitud || !$troza->diametro_otro_extremo) {
                $errors[] = 'La fórmula SMALIAN requiere diámetro, diámetro otro extremo y longitud';
            }
            break;
            
        case 'Formula de NEWTON':
            if (!$troza->diametro || !$troza->longitud || !$troza->diametro_otro_extremo || !$troza->diametro_medio) {
                $errors[] = 'La fórmula NEWTON requiere diámetro, diámetro medio, diámetro otro extremo y longitud';
            }
            break;
    }
    
    if (!empty($errors)) {
        return back()->withErrors($errors);
    }
    
    // Resto del código para calcular y guardar...
}
private function getUnidadMedida($tipo)
{
    switch ($tipo) {
        case 'Volumen Maderable': return 'm³';
        case 'Carbono': return 'kg CO₂';
        case 'Biomasa': return 'kg';
        case 'Área Basal': return 'm²';
        default: return '';
    }
}
    
public function update(Request $request, $id)
{
    $request->validate([
        'id_tipo_e' => 'required|exists:tipo_estimaciones,id_tipo_e',
        'id_formula' => 'required|exists:formulas,id_formula',
        'id_troza' => 'required|exists:trozas,id_troza',
    ]);

    $estimacion = Estimacion::findOrFail($id);
    $troza = Troza::find($request->id_troza);
    $formula = Formula::find($request->id_formula);
    $tipoEstimacion = Tipo_Estimacion::find($request->id_tipo_e);
    
    $calculo = null;
    
    // Misma lógica de cálculo que en el método store
    switch ($tipoEstimacion->desc_estimacion) {
        // ... (igual que en el método store)
    }
    
    if ($calculo === null) {
        return back()->with('error', 'No se pudo recalcular la estimación. Verifique los datos de la troza.');
    }
    
    $estimacion->update([
        'id_tipo_e' => $request->id_tipo_e,
        'id_formula' => $request->id_formula,
        'calculo' => $calculo,
        'id_troza' => $request->id_troza,
    ]);
    
    return redirect()->route('estimaciones.index')
           ->with('success', "Estimación de {$tipoEstimacion->desc_estimacion} recalculada: $calculo " . $this->getUnidadMedida($tipoEstimacion->desc_estimacion));
}

   

    public function destroy($id)
    {
        $estimacion = Estimacion::findOrFail($id);
        $estimacion->delete();

        return redirect()->route('estimaciones.index')->with('success', 'Estimación eliminada con éxito.');
    }
}