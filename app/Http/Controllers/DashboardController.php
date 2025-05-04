<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tecnico;
use App\Models\Parcela;
use App\Models\Tipo_Estimacion;
use App\Models\Formula;
use App\Models\Troza;

class DashboardController extends Controller
{
    public function index()
    {
        // Verificar autenticación
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Verificar relación con Persona
        if (!$user->persona) {
            abort(403, 'Usuario no tiene perfil de persona asociado');
        }

        // Obtener rol
        $rol = $user->persona->rol->nom_rol;

        // Redirigir según rol
        switch ($rol) {
            case 'Tecnico':
                return $this->handleTecnico($user->persona);
            case 'Administrador':
                return view('dashboard', ['user' => $user]);
            default:
                abort(403, 'Rol no reconocido');
        }
    }

    protected function handleTecnico($persona)
    {
        $tecnico = Tecnico::where('id_persona', $persona->id_persona)->first();

        if (!$tecnico) {
            abort(404, 'Perfil de técnico no encontrado');
        }

        // Obtener parcelas asignadas con información relevante
        $parcelas = $tecnico->parcelas()
        ->withCount('trozas')
        ->orderBy('nom_parcela')
        ->paginate(10); // O el número de ítems por página que desees
    

        // Calcular el total de trozas en todas las parcelas
        $totalTrozas = 0;
        foreach ($parcelas as $parcela) {
            $totalTrozas += $parcela->trozas_count;
        }

        // Obtener tipos de estimación y fórmulas para los modales
        $tiposEstimacion = Tipo_Estimacion::all();
        $formulas = Formula::all();

        return view('tecnicos.dashboard', [
            'user' => Auth::user(),
            'tecnico' => $tecnico,
            'parcelas' => $parcelas,
            'totalTrozas' => $totalTrozas,
            'tiposEstimacion' => $tiposEstimacion,
            'formulas' => $formulas
        ]);
    }
}