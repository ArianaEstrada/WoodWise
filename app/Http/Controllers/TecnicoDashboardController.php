<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tecnico;
use App\Models\Parcela;
use App\Models\Tipo_Estimacion;
use App\Models\Formula;
use App\Models\Troza;
use App\Models\Especie;
use App\Models\Productor;
use App\Models\Estimacion;

class TecnicoDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->persona->rol->nom_rol !== 'Tecnico') {
                return response()->view('denegado', [], 403);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $persona = Auth::user()->persona;
        $tecnico = Tecnico::where('id_persona', $persona->id_persona)->firstOrFail();

        // Obtener parcelas asignadas con información relevante
        $parcelas = $tecnico->parcelas()
            ->with(['productor.persona', 'trozas', 'estimaciones.tipoEstimacion', 'estimaciones.formula'])
            ->withCount(['trozas', 'estimaciones'])
            ->withSum('estimaciones', 'calculo') // Volumen maderable total
            ->orderBy('nom_parcela')
            ->paginate(10);

        // Calcular el total de trozas en todas las parcelas
        $totalTrozas = $parcelas->sum('trozas_count');

        // Calcular el total de estimaciones
        $totalEstimaciones = $parcelas->sum('estimaciones_count');

        // Calcular el volumen maderable total de todas las parcelas
        $totalVolumenMaderable = 0;
        foreach ($parcelas as $parcela) {
            $totalVolumenMaderable += $parcela->estimaciones_sum_calculo ?? 0;
        }

        // Obtener datos para los modales
        $tiposEstimacion = Tipo_Estimacion::all();
        $formulas = Formula::all();
        $especies = Especie::all();
        $productores = Productor::with('persona')->get();

        return view('T.index', [
            'user' => Auth::user(),
            'tecnico' => $tecnico,
            'parcelas' => $parcelas,
            'totalTrozas' => $totalTrozas,
            'totalEstimaciones' => $totalEstimaciones,
            'totalVolumenMaderable' => $totalVolumenMaderable,
            'tiposEstimacion' => $tiposEstimacion,
            'formulas' => $formulas,
            'especies' => $especies,
            'productores' => $productores
        ]);
    }

    public function storeEstimacion(Request $request)
    {
        $validated = $request->validate([
            'id_parcela' => 'required|exists:parcelas,id_parcela',
            'id_troza' => 'required|exists:trozas,id_troza',
            'id_tipo_e' => 'required|exists:tipo_estimacion,id_tipo_e',
            'id_formula' => 'required|exists:formulas,id_formula',
            'calculo' => 'required|numeric|min:0' // Asegurar que calculo es numérico
        ]);

        // Verificar que la troza pertenece a la parcela
        $troza = Troza::find($request->id_troza);
        if ($troza->id_parcela != $request->id_parcela) {
            return back()->with('error', 'La troza seleccionada no pertenece a esta parcela');
        }

        // Crear la estimación
        $estimacion = Estimacion::create($validated);

        return back()->with('success', 'Estimación registrada correctamente');
    }

    // Método adicional para obtener el volumen por parcela
    public function getVolumenPorParcela($id_parcela)
    {
        $parcela = Parcela::with('estimaciones')->findOrFail($id_parcela);
        $volumenTotal = $parcela->estimaciones->sum('calculo');

        return response()->json([
            'volumen_total' => $volumenTotal,
            'parcela' => $parcela->nom_parcela
        ]);
    }
}
