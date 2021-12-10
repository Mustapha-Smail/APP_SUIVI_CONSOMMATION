<?php

namespace App\Http\Controllers;

use App\Models\Piece;
use App\Models\Ville;
use App\Models\Maison;
use App\Models\Securite;
use App\Models\Isolation;
use App\Models\Locataire;
use App\Models\Typepiece;
use App\Models\Appartement;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Typeappartement;
use App\Models\Statusecologique;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProprietaireController extends Controller
{
    public function index(){
        $user = Auth::user(); 
        
        if(Gate::allows('admin')){ //Admin ne peut pas gerer des proprietes
            abort(403); 
        }

        $proprietes = Proprietaire::where([
            ['user_id', $user->id],
            ['fin_possession', '>', Carbon::now()]
        ])->get(); 

        // dd($proprietes);

        return view('proprietaire.maisons', compact('user', 'proprietes'));
    }

    public function appartements($maison_id){
        
        $maison = Maison::findOrFail($maison_id); 

        if ((! Gate::allows('get-proprietaire-appartements', $maison)) || (Gate::allows('admin'))) {
            abort(403); 
        }

        $appartements = $maison->appartements; 
        // dd($appartements); 


        return view('proprietaire.appartements', compact('appartements')); 
        

    }

    public function ajoutMaison(){

        if(Gate::allows('admin')){ //Admin ne peut pas gerer des proprietes
            abort(403); 
        }

        $status_ecologique = Statusecologique::all(); 
        $degres_isolation = Isolation::all(); 
        $types_appartement = Typeappartement::all();
        $degres_securite = Securite::all(); 


        return view('proprietaire.ajout-maison', compact(
            'status_ecologique',
            'degres_isolation',
            'types_appartement',
            'degres_securite',
        )); 
    }

    public function storeMaison(Request $request){

        if(Gate::allows('admin')){ //Admin ne peut pas gerer des proprietes
            abort(403); 
        }

        // dd($request->fixe && 1 ); 
        $ville = Ville::where([
            ['nom', $request->ville],
            ['code_postal', $request->code_postal],
        ])->first(); 

        // dd($ville->nom); 
        if(! $ville){
            return redirect()->route('proprietaire.ajout-maison')
                             ->withErrors(['error' => 'adresse incorrecte']); 
        }

        $maison = Maison::where([
            ['num_rue', $request->num_rue], 
            ['nom_rue', $request->rue], 
            ['ville_id', $ville->id], 
        ])->first();
        
        // dd($maison ? true : false);

        if($maison){
            $proprietaire = Proprietaire::where([
                ['maison_id', $maison->id],
                ['fin_possession', '>', $request->debut_possession],
            ])->first(); 

            if($proprietaire){
                return back()->withInput($request->all())
                            ->withErrors(["error" => "Cette maison a deja un proprietaire!"]); 
            }else{
                $proprietaire = Proprietaire::create([
                    'user_id' => Auth::user()->id,
                    'maison_id' => $maison->id,
                    'debut_possession' => $request->debut_possession,
                    'fin_possession' => $request->fin_possession,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]); 

                return redirect()->route('proprietaire.maisons'); 
            }
        }else{
            
            $maison = new Maison; 
            $maison-> nom = $request->nom; 
            $maison-> num_rue = $request->num_rue; 
            $maison-> nom_rue = $request->rue; 
            $maison-> ville_id = $ville->id; 
            $maison-> statusecologique_id = $request->status_ecologique; 
            $maison-> isolation_id = $request->degres_isolation; 
            $maison-> created_at = Carbon::now(); 
            $maison-> updated_at = Carbon::now();

            $maison->save(); 

            // dd('arrivée ici');

            $appartement = new Appartement;
            $appartement->num_boite = 1;
            $appartement->nombre_habitants = $request->nombre_habitants;
            $appartement->maison_id = $maison->id;
            $appartement->typeappartement_id = $request->type_appartement;
            $appartement->securite_id = $request->degres_securite;
            $appartement->created_at = Carbon::now();
            $appartement->updated_at = Carbon::now();

            $appartement->save(); 

            //locataire et proprietaire
            $proprietaire = Proprietaire::create([
                'user_id' => Auth::user()->id,
                'maison_id' => $maison->id,
                'debut_possession' => $request->debut_possession,
                'fin_possession' => $request->fin_possession,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]); 

            $fixe = $request->fixe ? true : false; 

            // dd($fixe); 
            if ($fixe) {
                $ancien_appart = Locataire::where([
                        ['user_id', $proprietaire->user_id],
                        ['fixe', true]
                ])->delete();
            

                $locataire = Locataire::create([
                    'user_id' => Auth::user()->id,
                    'appartement_id' => $appartement->id,
                    'debut_location' => $request->debut_possession,
                    'fin_location' => $request->fin_possession,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'fixe' => $fixe,
                ]);
            }

            return redirect()->route('proprietaire.maisons'); 

        }
    }

    public function ajoutAppartementProprietaire($maison_id){

        $maison = Maison::find($maison_id); 

        // dd($maison); 

        if ((! Gate::allows('get-proprietaire-appartements', $maison)) || (Gate::allows('admin'))) {
            abort(403); 
        }

        $degres_isolation = Isolation::all(); 
        $types_appartement = Typeappartement::all();
        $degres_securite = Securite::all(); 
        $types_piece = Typepiece::all(); 


        return view('proprietaire.ajout-appartement', compact(
            'degres_isolation',
            'types_appartement',
            'degres_securite',
            'types_piece'
        )); 
    }

    public function storeAppartementProprietaire(Request $request, $maison_id){

        // dd($request->nb_pieces); 

        $maison = Maison::find($maison_id); 

        // dd($maison); 

        if ((! Gate::allows('get-proprietaire-appartements', $maison)) || (Gate::allows('admin'))) {
            abort(403); 
        }


        $appartement = Appartement::firstOrCreate(
            [
                'num_boite' => $request->num_boite,
                'maison_id' => $maison->id
            ],
            [
                'nombre_habitants' => $request->nombre_habitants,
                'typeappartement_id' => $request->type_appartement,
                'securite_id' => $request->degres_securite,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ); 


        $fixe = $request->fixe ? true : false; 

        // dd($maison->proprietaires);
        $proprietaire = Proprietaire::where([
                ['user_id', Auth::user()->id],
                ['maison_id', $maison->id]
        ])->orderBy('fin_possession', 'desc')
        ->first(); 

        // dd($proprietaire); 
        if ($fixe) {
            $ancien_appart = Locataire::where([
                    ['user_id', Auth::user()->id],
                    ['fixe', true]
            ])->delete();
        

            $locataire = Locataire::create([
                'user_id' => Auth::user()->id,
                'appartement_id' => $appartement->id,
                'debut_location' => $proprietaire->debut_possession,
                'fin_location' => $proprietaire->fin_possession,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'fixe' => $fixe,
            ]);
        }

        for ($i=0; $i < $request->nb_pieces; $i++) { 
    
            $k = $i+1; 
            $type_piece = 'type_piece_'.$k; 
            $piece = 'piece_'.$k; 
        
            // dd($request->$type_piece); 

            $nouvelle_piece = Piece::create([
                                'libelle' => $request->$piece,
                                'typepiece_id' => $request->$type_piece,
                                'appartement_id' => $appartement->id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]); 
        }

        return redirect()->route('proprietaire.appartements', $maison_id); 
    }
}
