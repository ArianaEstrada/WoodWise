<?php

namespace App\Http\Controllers;

use App\Models\Estimacion;
use Illuminate\Http\Request;

class EstimacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estimaciones = Estimacion::all();
        return view('CRUDs.estimaciones.index', compact('estimaciones'));
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
    public function show(Estimacion $estimacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estimacion $estimacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estimacion $estimacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estimacion $estimacion)
    {
        //
    }
}
