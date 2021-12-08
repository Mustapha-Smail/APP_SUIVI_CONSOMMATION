<?php

namespace App\Charts;

use App\Models\Consommation;
use App\Models\Locataire;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class LocataireConsommationChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $user_id = Auth::user()->id;
        $locataires = Locataire::where([
                                    ['user_id', $user_id], 
                                    ['fin_location', '>', Carbon::now()]
                                ])
                                ->get();
        
        $consommations = []; 
        $ressources = []; 
        $emissions = []; 
        $substances = []; 
        foreach ($locataires as $locataire) {
            
            $appartement = $locataire->appartement; 
            $pieces = $appartement->pieces; 
            
            foreach ($pieces as $piece) {

                $appareils = $piece->appareils; 
                $ressources_int = []; 
                $substances_int = []; 
                foreach ($appareils as $appareil) {

                    $consommations_actuelles = Consommation::where([
                                                    ['appareil_id', $appareil->id],
                                                    ['created_at', 'LIKE', '%'.Carbon::now()->month.'%']
                                                ])->get(); 

                    
                    foreach ($consommations_actuelles as $consommation ) {
                        if($consommation->matiere->ressource){
                            // array_push($ressources_int, $consommation->matiere);
                            if(! isset($ressources_int[$consommation->matiere->libelle])){
                                $ressources_int[$consommation->matiere->libelle] = $consommation->consommation;
                            } 
                            else{
                                $ressources_int[$consommation->matiere->libelle] = $ressources_int[$consommation->matiere->libelle] + $consommation->consommation;
                            }
                        }else{
                            if(! isset($substances_int[$consommation->matiere->libelle])){
                                $substances_int[$consommation->matiere->libelle] = $consommation->consommation;
                            } 
                            else{
                                $substances_int[$consommation->matiere->libelle] = $substances_int[$consommation->matiere->libelle] + $consommation->consommation;
                            }
                        }

                        // $ressources = $ressources + $ressources_int;
                        $ressources = array_merge($ressources, $ressources_int); 
                        $substances = array_merge($substances, $substances_int); 
                        
                    }
                    
                }
                // dd($ressources_int);
            }
        }

        $ressources = array_unique($ressources);
        $substances = array_unique($substances);

        // dd($ressources, $substances);
        

        return $this->chart->barChart()
            ->setTitle('Consommations du mois de '.Carbon::now()->format('F'))
            ->addData('', array_values($ressources))
            ->setXAxis(array_keys($ressources));
    }
}
