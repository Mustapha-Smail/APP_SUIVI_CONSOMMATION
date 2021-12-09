<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Consommation;
use App\Models\Proprietaire;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ProprietaireEmissionChart
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
    
        $substances = []; 

        foreach ($proprietaires as $proprietaire) {
            $appartements = $proprietaire->maison->appartements; 
            foreach ($appartements as $appartement) {
                $pieces = $appartement->pieces;
                $pieces = $appartement->pieces;
                
                foreach ($pieces as $piece) {
                    $appareils = $piece->appareils;
                    $substances_int = [];
                    foreach ($appareils as $appareil) {
                        $consommations_actuelles = Consommation::where([
                                                        ['appareil_id', $appareil->id],
                                                        ['created_at', 'LIKE', '%'.Carbon::now()->month.'%']
                                                    ])->get();

                        
                        foreach ($consommations_actuelles as $consommation) {
                            if (!$consommation->matiere->ressource) {
                                if (! isset($substances_int[$consommation->matiere->libelle])) {
                                    $substances_int[$consommation->matiere->libelle] = $consommation->consommation;
                                } else {
                                    $substances_int[$consommation->matiere->libelle] = $substances_int[$consommation->matiere->libelle] + $consommation->consommation;
                                }
                            }
                            $substances = array_merge($substances, $substances_int);
                        }
                    }
                }
            }
        }

        $substances = array_unique($substances);

        // dd($substances); 

        return $this->chart->barChart()
            ->setTitle('Emissions de mes locations: '.Carbon::now()->format('F'))
            ->addData('', array_values($substances))
            ->setXAxis(array_keys($substances));
    }
}
