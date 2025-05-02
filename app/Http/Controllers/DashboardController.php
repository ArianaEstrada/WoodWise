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
// Verificar si el usuario está autenticado
if (!Auth::check()) {
return redirect()->route('login');
}

$user = Auth::user();

// Verificar si el usuario tiene relación con persona
if (!$user->persona) {
abort(403, 'Usuario no tiene perfil de persona asociado');
}

// Verificar si el usuario tiene rol
if (!$user->persona->rol) {
abort(403, 'Usuario no tiene rol asignado');
}

// Si es técnico
if ($user->persona->rol->nom_rol == 'Tecnico') {
$tecnico = Tecnico::where('id_persona', $user->persona->id_persona)->first();

if (!$tecnico) {
// Si no es técnico pero tiene rol de técnico, mostrar error
abort(404, 'Perfil de técnico no encontrado');
}

$parcelasCount = $tecnico->parcelas()->count();

return view('tecnicos.dashboard', [
'user' => $user,
'tecnico' => $tecnico,
'parcelasCount' => $parcelasCount
]);
}

// Para otros roles (si los hay)
return view('dashboard', [
'user' => $user
]);
}
}
