<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tecnico;
use App\Models\Parcela;
use App\Models\Tipo_Estimacion;
use App\Models\Formula;
use App\Models\Troza;

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
            ->withCount('trozas')
            ->orderBy('nom_parcela')
            ->paginate(10);

        // Calcular el total de trozas en todas las parcelas
        $totalTrozas = $parcelas->sum('trozas_count');

        // Obtener tipos de estimación y fórmulas para los modales
        $tiposEstimacion = Tipo_Estimacion::all();
        $formulas = Formula::all();

        return view('T.index', [
            'user' => Auth::user(),
            'tecnico' => $tecnico,
            'parcelas' => $parcelas,
            'totalTrozas' => $totalTrozas,
            'tiposEstimacion' => $tiposEstimacion,
            'formulas' => $formulas
        ]);
    }
}