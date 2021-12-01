<?php

namespace App\Http\Controllers;

use App\Models\Maison;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProprietaireController extends Controller
{
    public function index(){
        $user = Auth::user(); 
        $maisons = DB::table('proprietaires')
                            ->join('maisons', 'proprietaires.maison_id', 'maisons.id')
                            ->join('villes', 'maisons.ville_id', 'villes.id')
                            ->select(
                                'maisons.*', 
                                'proprietaires.debut_possession', 
                                'proprietaires.fin_possession', 
                                'villes.nom AS nom_ville',
                                'villes.code_postal'
                            )
                            ->where([
                                ['proprietaires.user_id', '=', $user->id],
                                ['proprietaires.fin_possession', '>', Carbon::now()],
                            ])
                            ->get(); 

        // dd(gettype($maisons[0]));

        return view('proprietaire.maisons', compact('user', 'maisons'));
    }

    public function appartements($maison_id){
        
        $maison = Maison::whereIn('id', array($maison_id))->first(); 

        if (! Gate::allows('get-proprietaire-appartements', $maison)) {
            abort(403); 
        }

        $appartements = $maison->appartements; 
        // dd($appartements); 


        return view('proprietaire.appartements', compact('appartements')); 
        

    }
}
