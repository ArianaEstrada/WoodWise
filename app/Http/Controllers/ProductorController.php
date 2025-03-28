<?php

namespace App\Http\Controllers;

use App\Models\Productor;
use App\Models\Persona;
use Illuminate\Http\Request;

class ProductorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productores = Productor::all(); // Obtener todos los productores
        $personas = Persona::all();  // Obtener todas las personas para asignarlas al productor
        return view('productores.index', compact('productores', 'personas')); // Vista con productores y personas
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_persona' => 'required|exists:personas,id_persona', // Validación de persona
        ]);

        Productor::create([
            'id_persona' => $request->id_persona, // Guardar la relación con persona
        ]);

        return redirect()->route('productores.index')->with('success', 'Productor creado con éxito.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_persona' => 'required|exists:personas,id_persona',
        ]);

        $productor = Productor::findOrFail($id);
        $productor->update([
            'id_persona' => $request->id_persona,
        ]);

        return redirect()->route('productores.index')->with('success', 'Productor actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $productor = Productor::findOrFail($id);
        $productor->delete();

        return redirect()->route('productores.index')->with('success', 'Productor eliminado con éxito.');
    }
}
