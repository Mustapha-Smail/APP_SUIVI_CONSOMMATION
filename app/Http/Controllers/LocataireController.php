<?php

namespace App\Http\Controllers;

use App\Models\Appartement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LocataireController extends Controller
{
    public function index(){
        $user = Auth::user(); 

        if(Gate::allows('admin')){ //Admin ne peut pas gerer des locations
            abort(403); 
        }

        $appartements = DB::table('locataires')
                            ->join('appartements', 'locataires.appartement_id', 'appartements.id')
                            ->select(
                                'appartements.*', 
                                'locataires.debut_location', 
                                'locataires.fin_location', 
                            )
                            ->where([
                                ['locataires.user_id', '=', $user->id], 
                                ['locataires.fin_location', '>', Carbon::now()],
                            ])
                            ->get(); 

        // dd($appartements->typeappartement); 

        return view('locataire.appartements', compact('user', 'appartements'));
    }

    public function pieces($appartement_id){
        $appartement = Appartement::find($appartement_id); 

        if((! Gate::allows('get-locataire-pieces', $appartement) || (Gate::allows('admin')))){
            abort(403); 
        }

        $pieces = $appartement->pieces; 

        // dd($pieces); 

        return view('locataire.pieces', compact('pieces'));
    }
}
