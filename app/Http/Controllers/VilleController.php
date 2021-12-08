<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    public function index(){
        $villes = Ville::take(10)->get(); 
        // dd(uniqid()); 
        return view('villes', compact('villes')); 
    }
}
