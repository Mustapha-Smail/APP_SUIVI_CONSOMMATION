<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Matiere;
use App\Models\Appartement;
use App\Models\Consommation;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class LocataireSuiviConsommationParMois
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($appartement_id, $ressource_id): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $appartement = Appartement::find($appartement_id);
        $pieces = $appartement->pieces;  
        $matiere = Matiere::find($ressource_id); 
        $conso = []; 
        foreach ($pieces as $piece) {
            $appareils = $piece->appareils; 
            foreach ($appareils as $appareil) {

                for ($i=1; $i <= 12; $i++) { 
                    // dd(01);
                    if($i<10){
                        $consommations = Consommation::where([
                                    ['appareil_id', $appareil->id],
                                    ['matiere_id', $matiere->id],
                                    ['created_at', 'LIKE', Carbon::now()->year.'-0'.$i.'%']
                                ])->get();
                    }else{
                        $consommations = Consommation::where([
                                    ['appareil_id', $appareil->id],
                                    ['matiere_id', $matiere->id],
                                    ['created_at', 'LIKE', Carbon::now()->year.'-'.$i.'%']
                                ])->get();
                        
                    }
                    // dd(count($consommations));
                    $val = 0;
                    if (count($consommations)>0) {
                        $val = $consommations[0]->consommation * count($consommations);
                    }
                    // dd($val);
                    
                    if(! isset($conso[$i])){
                        $conso[$i] = $val;
                    } 
                    else{
                        $conso[$i] = $conso[$i] + $val;
                    }

                }
            }
        }

        // dd(count($conso)); 

        return $this->chart->lineChart()
            ->setTitle($matiere->libelle.' '.Carbon::now()->year)
            ->setSubtitle($appartement->maison->num_rue.' '.$appartement->maison->nom_rue.' '.$appartement->maison->ville->code_postal.'\n'.$appartement->maison->ville->nom)
            ->addData('',array_values($conso))
            ->setXAxis(['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre']);
    }
}
