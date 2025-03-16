<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use Illuminate\Http\Request;
use App\Models\User;
class EspecieController extends Controller
{
    
    public function index()
    {
        $especies = Especie::all();
        $user = auth()->user();
        return view('CRUDs.especies.index', compact('especies','user'));
    }
}


