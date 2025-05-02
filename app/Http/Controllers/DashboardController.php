<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tecnico;
use App\Models\Parcela;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!$user->persona) {
            Log::error('Usuario no tiene persona asociada', ['user_id' => $user->id]);
            abort(403, 'Usuario no tiene perfil de persona asociado');
        }

        if (!$user->persona->rol) {
            Log::error('Usuario no tiene rol asignado', ['user_id' => $user->id]);
            abort(403, 'Usuario no tiene rol asignado');
        }

        if ($user->persona->rol->nom_rol == 'Tecnico') {
            $tecnico = Tecnico::with(['parcelas' => function($query) {
                $query->withCount('trozas');
            }])->where('id_persona', $user->persona->id_persona)->first();

            if (!$tecnico) {
                Log::error('Técnico no encontrado para persona', ['persona_id' => $user->persona->id_persona]);
                abort(404, 'Perfil de técnico no encontrado');
            }

            return view('tecnicos.dashboard', [
                'user' => $user,
                'tecnico' => $tecnico,
                'parcelas' => $tecnico->parcelas ?? collect(),
                'showParcelas' => request()->has('show_parcelas')
            ]);
        }

        return view('dashboard', ['user' => $user]);
    }
}
