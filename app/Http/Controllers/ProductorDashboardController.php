<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProductorDashboardController extends Controller
{


    public function index()
    {
        return view('P.index');
    }
}
