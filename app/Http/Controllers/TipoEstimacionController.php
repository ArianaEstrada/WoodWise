<?php

namespace App\Http\Controllers;


// Controlador: TipoEstimacionController.php

use Illuminate\Http\Request;
use App\Models\Tipo_Estimacion;

class TipoEstimacionController extends Controller
{
    public function index()
    {
        $tipo_estimaciones = Tipo_Estimacion::all();
        return view('tipo_estimaciones.index', compact('tipo_estimaciones'));
    }

    public function store(Request $request)
    {
        $request->validate(['desc_estimacion' => 'required|string|max:255']);
        Tipo_Estimacion::create($request->all());
        return redirect()->route('tipo_estimaciones.index')->with('success', 'Tipo de estimación creado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['desc_estimacion' => 'required|string|max:255']);
        $tipo = Tipo_Estimacion::findOrFail($id);
        $tipo->update($request->all());
        return redirect()->route('tipo_estimaciones.index')->with('success', 'Tipo de estimación actualizado.');
    }

    public function destroy($id)
    {
        Tipo_Estimacion::findOrFail($id)->delete();
        return response()->json(['success' => 'Eliminado correctamente.']);
    }
}


