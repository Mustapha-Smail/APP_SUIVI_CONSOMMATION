<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Consommation;
use App\Models\Proprietaire;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ProprietaireConsommationChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $user_id = Auth::user()->id;
        $proprietaires = Proprietaire::where([
                                    ['user_id', $user_id], 
                                    ['fin_possession', '>', Carbon::now()]
                                ])
                                ->get();
    
        $ressources = []; 

        foreach ($proprietaires as $proprietaire) {
            $appartements = $proprietaire->maison->appartements; 
            foreach ($appartements as $appartement) {
                $pieces = $appartement->pieces;
                $pieces = $appartement->pieces;
                
                foreach ($pieces as $piece) {
                    $appareils = $piece->appareils;
                    $ressources_int = [];
                    foreach ($appareils as $appareil) {
                        $consommations_actuelles = Consommation::where([
                                                        ['appareil_id', $appareil->id],
                                                        ['created_at', 'LIKE', '%'.Carbon::now()->month.'%']
                                                    ])->get();

                        
                        foreach ($consommations_actuelles as $consommation) {
                            if ($consommation->matiere->ressource) {
                                if (! isset($ressources_int[$consommation->matiere->libelle])) {
                                    $ressources_int[$consommation->matiere->libelle] = $consommation->consommation;
                                } else {
                                    $ressources_int[$consommation->matiere->libelle] = $ressources_int[$consommation->matiere->libelle] + $consommation->consommation;
                                }
                            }
                            $ressources = array_merge($ressources, $ressources_int);
                        }
                    }
                }
            }
        }

        $ressources = array_unique($ressources);

        // dd($ressources); 

        return $this->chart->barChart()
            ->setTitle('Consommations de mes proprietes: '.Carbon::now()->format('F'))
            ->addData('', array_values($ressources))
            ->setXAxis(array_keys($ressources));
    }
}
