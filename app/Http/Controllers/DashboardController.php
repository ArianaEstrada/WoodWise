<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tecnico;
use App\Models\Parcela;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->persona->rol->nom_rol == 'Tecnico') {
            // Obtener el técnico relacionado con el usuario
            $tecnico = Tecnico::with(['parcelas' => function($query) {
                $query->withCount('trozas');
            }])->where('id_persona', $user->persona->id_persona)->first();

            if (!$tecnico) {
                abort(404, 'Técnico no encontrado');
            }

            // Obtener parcelas asignadas a este técnico
            $parcelas = $tecnico->parcelas;

            // Debugging (puedes eliminar esto después)
            \Log::info('Parcelas del técnico:', [
                'tecnico_id' => $tecnico->id_tecnico,
                'parcelas_count' => $parcelas->count(),
                'parcelas' => $parcelas->pluck('nom_parcela')
            ]);

            return view('tecnicos.dashboard', compact('user', 'parcelas', 'tecnico'));
        }

        return view('dashboard', compact('user'));
    }
}
