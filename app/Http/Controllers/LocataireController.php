<?php

namespace App\Http\Controllers;

use App\Charts\LocataireSuiviConsommationParMois;
use App\Models\Piece;
use App\Models\Ville;
use App\Models\Maison;
use App\Models\Securite;
use App\Models\Isolation;
use App\Models\Typepiece;
use App\Models\Appartement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Typeappartement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Appareil;
use App\Models\Appareilmatiere;
use App\Models\Consommation;
use App\Models\Locataire;
use App\Models\Matiere;
use App\Models\Typeappareil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LocataireController extends Controller
{
    public function index(){
        $user = Auth::user(); 

        if(Gate::allows('admin')){ //Admin ne peut pas gerer des locations
            abort(403); 
        }

        $locations = Locataire::where([
            ['user_id', $user->id],
            ['fin_location', '>', Carbon::now()],
        ])->get();

        // dd($locataires); 

        return view('locataire.appartements', compact('user', 'locations'));
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

    public function piece($piece_id){
        $piece = Piece::findOrFail($piece_id); 
        if((! Gate::allows('get-locataire-pieces', $piece->appartement) || (Gate::allows('admin')))){
            abort(403); 
        }

        return view('locataire.piece', compact('piece'));

    }

    public function ajoutAppartementLocataire(){

        if(Gate::allows('admin')){ //Admin ne peut pas gerer des proprietes
            abort(403); 
        }

        $degres_isolation = Isolation::all(); 
        $types_appartement = Typeappartement::all();
        $degres_securite = Securite::all(); 
        $types_piece = Typepiece::all(); 


        return view('locataire.ajout-appartement', compact(
            'degres_isolation',
            'types_appartement',
            'degres_securite',
            'types_piece'
        )); 
    } 
    
    public function storeAppartementLocataire(Request $request){
        // dd($request->nb_pieces);

        if(Gate::allows('admin')){ //Admin ne peut pas gerer des proprietes
            abort(403); 
        }

        // ajout appart 
        /**
         * verifier l'adresse
         * verifier si c'est pas déjà loué 
         * lier l'appart au user 
         * verifier si les pieces existent pas 
         * ajouter les pieces 
         * les lier a l'appart 
         */

        $ville = Ville::where([
                ['code_postal', $request->code_postal],
                ['nom', $request->ville]
            ])->first(); 

        // dd($ville);

        if(!$ville){
            return redirect()->route('locataire.ajout-appartement')
                            ->withErrors(['error' => 'ville non valide']); 
        }

        // dd($request->rue); 

        $maison = Maison::where([
            ['num_rue', $request->num_rue],
            ['nom_rue', $request->rue],
            ['ville_id', $ville->id],
        ])->first(); 
        

        if(! $maison){
            return redirect()->route('locataire.ajout-appartement')
                             ->withErrors(['error' => 'La maison reliee a cette adresse n\'existe pas, merci de demander a votre proprietaire de la renseigner']); 
        }

        $appartement = Appartement::firstOrCreate(
            [
                'num_boite' => $request->num_boite, 
                'maison_id' => $maison->id,
            ], 
            [
                'nombre_habitants' => $request->nombre_habitants,
                'typeappartement_id' => $request->type_appartement,
                'securite_id' => $request->degres_securite,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ); 

        // dd($appartement); 
        $location = Locataire::where([
            ['fin_location', '>', $request->debut_location], 
            ['appartement_id', $appartement->id], 
        ])->first();  

        // dd($location); 
        if($location){
            return redirect()->route('locataire.ajout-appartement')
                            ->withErrors(['error' => 'appartement deja loue']); 
        }

        $fixe = $request->fixe ? true : false; 

        // dd($fixe); 
        if ($fixe) {
            $ancienne_location = Locataire::where([
                    ['user_id', Auth::user()->id],
                    ['fixe', true]
            ])->delete();
        }

        $locataire = Locataire::create([
                'user_id' => Auth::user()->id,
                'appartement_id' => $appartement->id,
                'debut_location' => $request->debut_location,
                'fin_location' => $request->fin_location,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'fixe' => $fixe,
            ]);

        

        return redirect()->route('locataire.appartements'); 
    }

    public function ajoutPieceLocataire($id_appartement){

        $appartement = Appartement::whereIn('id', array($id_appartement))->first();
        
        if((! Gate::allows('get-locataire-pieces', $appartement) || (Gate::allows('admin')))){
            abort(403); 
        }

        $types_piece = Typepiece::all(); 
        
        return view('locataire.ajout-piece', compact('types_piece')); 
    }

    public function storePieceLocataire(Request $request, $id_appartement){

        for ($i=0; $i < $request->nb_pieces; $i++) { 
    
            $k = $i+1; 
            $type_piece = 'type_piece_'.$k; 
            $piece = 'piece_'.$k; 
        
            // dd($request->$type_piece); 

            $nouvelle_piece = Piece::firstOrCreate(
                            [
                                'libelle' => $request->$piece,
                                'typepiece_id' => $request->$type_piece,
                                'appartement_id' => $id_appartement
                            ],
                            [
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]
                        ); 
        }

        return redirect()->route('locataire.pieces', $id_appartement); 
    }

    public function ajoutAppareilLocataire($id_piece){

        $piece = Piece::find($id_piece); 

        if((! Gate::allows('get-locataire-pieces', $piece->appartement) || (Gate::allows('admin')))){
            abort(403); 
        }

        $types_appareil = Typeappareil::all(); 
        $ressources = Matiere::where('ressource', true)->get(); 
        $substances = Matiere::where('ressource', false)->get(); 
        
        return view('locataire.ajout-appareil', compact('types_appareil', 'ressources', 'substances')); 
    }

    public function storeAppareilLocataire(Request $request, $id_piece){
        $piece = Piece::findOrFail($id_piece); 

        if((! Gate::allows('get-locataire-pieces', $piece->appartement) || (Gate::allows('admin')))){
            abort(403); 
        }

        $appareil = Appareil::create([
            'libelle' => $request->appareil,
            'description' => $request->description,
            'typeappareil_id' => $request->type_appareil,
            'piece_id' => $piece->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); 

        $nb_ressources = $request->nb_ressources; 
        $nb_substances = $request->nb_substances; 
        
        for ($i=0; $i < $nb_ressources; $i++) { 
            $k = $i+1;  
            $ressource = 'ressource_'.$k; 
            $consommation = 'conso_heure_ressource_'.$k;

            $nouvelle_ressource = Appareilmatiere::create([
                'appareil_id' => $appareil->id,
                'matiere_id' => $request->$ressource,
                'conso_emission_heure' => $request->$consommation,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]); 
        }

        for ($i=0; $i < $nb_substances; $i++) { 
            $k = $i+1;  
            $substance = 'substance_'.$k; 
            $emission = 'conso_heure_substance_'.$k;

            $nouvelle_substance = Appareilmatiere::create([
                'appareil_id' => $appareil->id,
                'matiere_id' => $request->$substance,
                'conso_emission_heure' => $request->$emission,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]); 
        }

        return redirect()->route('locataire.piece', $piece->id); 

    }

    public function consommation(Request $request){
        
        $appareil = Appareil::findOrFail($request->appareil); 


        // dd($appareil->appareilmatieres);

        // if((! Gate::allows('get-locataire-pieces', $appareil->piece->appartement) || (Gate::allows('admin')))){
        //     abort(403); 
        // }
        
        $consommation = Consommation::create([
            'appareil_id' => $request->appareil,
            'matiere_id' => $request->ressource,
            'consommation' => $request->conso_heure,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); 

        $appareilmatieres = $appareil->appareilmatieres; 
        
        foreach ($appareilmatieres as $appareilmatiere) {
            $matiere = Matiere::where([
                ['id', $appareilmatiere->matiere_id],
                ['ressource', false]
            ])->first(); 
            
            if($matiere){
                // dd($matiere->id); 
                
                $substance = Consommation::create([
                    'appareil_id' => $appareil->id,
                    'matiere_id' => $matiere->id,
                    'consommation' => $appareilmatiere->conso_emission_heure,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                
            }
        }
    }

    public function getConsommations($id_appartement){
        $appartement = Appartement::findOrFail($id_appartement);
        
        if(Gate::allows('admin')){
            abort(403); 
        }

        
        $ressources = Matiere::where('ressource', true)->get();
        // dd($ressources);

        return view('locataire.consommations', compact('ressources'));
    }

    public function postConsommations(Request $request, $id_appartement, LocataireSuiviConsommationParMois $chart){
        $appartement = Appartement::findOrFail($id_appartement);
        
        if(Gate::allows('admin')){
            abort(403); 
        }

        $chart = $chart->build($appartement->id, $request->ressource); 
        return redirect()->route('locataire.consommations', [$appartement->id])->with(['chart' => $chart]); 
    }

    public function getEmissions($id_appartement){
        $appartement = Appartement::findOrFail($id_appartement);
        
        if(Gate::allows('admin')){
            abort(403); 
        }

        
        $substances = Matiere::where('ressource', false)->get();
        // dd($substances);

        return view('locataire.emissions', compact('substances'));
    }

    public function postEmissions(Request $request, $id_appartement, LocataireSuiviConsommationParMois $chart){
        $appartement = Appartement::findOrFail($id_appartement);
        
        if(Gate::allows('admin')){
            abort(403); 
        }

        $chart = $chart->build($appartement->id, $request->substance); 
        return redirect()->route('locataire.emissions', [$appartement->id])->with(['chart' => $chart]); 
    }


}
