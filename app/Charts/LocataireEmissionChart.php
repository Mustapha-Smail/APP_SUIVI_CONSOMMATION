<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Locataire;
use App\Models\Consommation;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class LocataireEmissionChart
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
    
        $substances = []; 
        foreach ($locataires as $locataire) {
            
            $appartement = $locataire->appartement; 
            $pieces = $appartement->pieces; 
            
            foreach ($pieces as $piece) {

                $appareils = $piece->appareils; 
                $substances_int = []; 
                foreach ($appareils as $appareil) {

                    $consommations_actuelles = Consommation::where([
                                                    ['appareil_id', $appareil->id],
                                                    ['created_at', 'LIKE', '%'.Carbon::now()->month.'%']
                                                ])->get(); 

                    
                    foreach ($consommations_actuelles as $consommation ) {
                        if(!$consommation->matiere->ressource){
                            if(! isset($substances_int[$consommation->matiere->libelle])){
                                $substances_int[$consommation->matiere->libelle] = $consommation->consommation;
                            } 
                            else{
                                $substances_int[$consommation->matiere->libelle] = $substances_int[$consommation->matiere->libelle] + $consommation->consommation;
                            }
                        }
                        $substances = array_merge($substances, $substances_int); 
                        
                    }
                    
                }
            }
        }

        $substances = array_unique($substances);

        return $this->chart->barChart()
            ->setTitle('Emissions de mes locations: '.Carbon::now()->format('F'))
            ->addData('', array_values($substances))
            ->setXAxis(array_keys($substances));
    }
}
