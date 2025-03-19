<?php

namespace App\Http\Controllers;

use App\Models\Parcela;
use Illuminate\Http\Request;

class ParcelaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parcelas = Parcela::all();
            return view('CRUDs.parcelas.index', compact('parcelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Parcelas $parcelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parcelas $parcelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parcelas $parcelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parcelas $parcelas)
    {
        //
    }
}
