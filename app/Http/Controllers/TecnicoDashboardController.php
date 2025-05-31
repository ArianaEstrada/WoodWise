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
use Illuminate\Support\Facades\DB;
use PDF;

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
            ->with([
                'productor.persona',
                'trozas.estimacion' // Cargamos las trozas con sus estimaciones
            ])
            ->withCount(['trozas'])
            ->orderBy('nom_parcela')
            ->paginate(10);

        // Calcular totales
        $totalTrozas = $parcelas->sum('trozas_count');
        $totalVolumenMaderable = 0;
        $totalEstimaciones = 0;

        foreach ($parcelas as $parcela) {
            // Reiniciamos los acumuladores para cada parcela
            $volumenParcela = 0;
            $estimacionesParcela = 0;

            // Verificamos cada troza de la parcela
            foreach ($parcela->trozas as $troza) {
                // Solo consideramos trozas con estimación válida
                if ($troza->estimacion && is_numeric($troza->estimacion->calculo)) {
                    $volumenParcela += (float)$troza->estimacion->calculo;
                    $estimacionesParcela++;
                }
            }

            // Asignamos los valores calculados a la parcela
            $parcela->volumen_maderable = round($volumenParcela, 2); // Redondeamos a 2 decimales
            $parcela->estimaciones_count = $estimacionesParcela;

            // Acumulamos los totales generales
            $totalVolumenMaderable += $parcela->volumen_maderable;
            $totalEstimaciones += $parcela->estimaciones_count;
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
            'totalVolumenMaderable' => round($totalVolumenMaderable, 2),
            'tiposEstimacion' => $tiposEstimacion,
            'formulas' => $formulas,
            'especies' => $especies,
            'productores' => $productores
        ]);
    }

    public function exportParcelaToPdf($id_parcela)
    {
        $parcela = Parcela::with(['productor.persona', 'trozas.estimacion'])
            ->withCount(['trozas'])
            ->findOrFail($id_parcela);

        // Calcular volumen maderable
        $volumen_maderable = 0;
        foreach ($parcela->trozas as $troza) {
            if ($troza->estimacion) {
                $volumen_maderable += (float)$troza->estimacion->calculo;
            }
        }
        $parcela->volumen_maderable = $volumen_maderable;

        $pdf = PDF::loadView('pdf.parcela', compact('parcela'));

        return $pdf->download('reporte_parcela_'.$parcela->nom_parcela.'_'.now()->format('Ymd').'.pdf');
    }

    public function storeEstimacion(Request $request)
    {
        $validated = $this->validateEstimacionRequest($request);

        try {
            DB::beginTransaction();

            $troza = Troza::find($validated['id_troza']);
            $this->createOrUpdateEstimacion($troza, $validated);

            DB::commit();
            return back()->with('success', 'Estimación registrada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al registrar la estimación: ' . $e->getMessage());
        }
    }

    protected function validateEstimacionRequest(Request $request)
    {
        $persona = Auth::user()->persona;
        $tecnico = Tecnico::where('id_persona', $persona->id_persona)->firstOrFail();

        return $request->validate([
            'id_parcela' => [
                'required',
                'exists:parcelas,id_parcela',
                function ($attribute, $value, $fail) use ($tecnico) {
                    if (!$tecnico->parcelas()->where('id_parcela', $value)->exists()) {
                        $fail('La parcela no está asignada a este técnico');
                    }
                }
            ],
            'id_troza' => [
                'required',
                'exists:trozas,id_troza',
                function ($attribute, $value, $fail) use ($request) {
                    if (!Troza::where('id_troza', $value)
                        ->where('id_parcela', $request->id_parcela)
                        ->exists()) {
                        $fail('La troza seleccionada no pertenece a esta parcela');
                    }
                }
            ],
            'id_tipo_e' => 'required|exists:tipo_estimacion,id_tipo_e',
            'id_formula' => 'required|exists:formulas,id_formula',
            'calculo' => 'required|numeric|min:0'
        ]);
    }

    protected function createOrUpdateEstimacion($troza, $data)
    {
        return $troza->estimacion()->updateOrCreate(
            ['id_troza' => $data['id_troza']],
            [
                'id_tipo_e' => $data['id_tipo_e'],
                'id_formula' => $data['id_formula'],
                'calculo' => $data['calculo']
            ]
        );
    }

    public function getVolumenPorParcela($id_parcela)
    {
        try {
            $parcela = Parcela::with(['trozas.estimacion'])
                ->findOrFail($id_parcela);

            $volumenTotal = $this->calculateVolumenMaderable($parcela);

            return response()->json([
                'success' => true,
                'volumen_total' => $volumenTotal,
                'parcela' => $parcela->nom_parcela
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el volumen: ' . $e->getMessage()
            ], 500);
        }
    }

    protected function calculateVolumenMaderable($parcela)
    {
        $volumen = 0;
        foreach ($parcela->trozas as $troza) {
            if ($troza->estimacion) {
                $volumen += (float)$troza->estimacion->calculo;
            }
        }
        return $volumen;
    }

    public function getTrozasPorParcela($id_parcela)
    {
        try {
            $trozas = Troza::with('estimacion')
                ->where('id_parcela', $id_parcela)
                ->get(['id_troza', 'codigo_troza']);

            return response()->json([
                'success' => true,
                'trozas' => $trozas
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las trozas: ' . $e->getMessage()
            ], 500);
        }
    }
}
