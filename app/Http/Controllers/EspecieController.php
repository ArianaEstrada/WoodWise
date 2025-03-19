<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especie;
use Illuminate\Support\Facades\Storage;

class EspecieController extends Controller
{
    
    public function index()
    {
        $especies = Especie::all();
       

        return view('CRUDs.especies.index', compact('especies'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_cientifico' => 'required|string|max:255',
            'nom_comun' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagenPath = $request->hasFile('imagen')
            ? $request->file('imagen')->store('especies', 'public')
            : null;

        Especie::create(array_merge($validatedData, ['imagen' => $imagenPath]));

        return redirect()->route('especies.index')->with('success', 'Especie registrada correctamente.');
    }

    public function update(Request $request, Especie $especie)
    {
        $validatedData = $request->validate([
            'nom_cientifico' => 'required|string|max:255',
            'nom_comun' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($especie->imagen) {
                Storage::delete('public/' . $especie->imagen);
            }
            $validatedData['imagen'] = $request->file('imagen')->store('especies', 'public');
        }

        $especie->update($validatedData);

        return redirect()->route('especies.index')->with('success', 'Especie actualizada correctamente.');
    }

    public function destroy(Especie $especie)
    {
        if ($especie->imagen) {
            Storage::delete('public/' . $especie->imagen);
        }
        $especie->delete();

        return redirect()->route('especies.index')->with('success', 'Especie eliminada correctamente.');
    }
}
