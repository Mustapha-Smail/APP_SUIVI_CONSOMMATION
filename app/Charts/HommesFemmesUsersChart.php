<?php

namespace App\Charts;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class HommesFemmesUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $utilisateurs_hommes = User::where([['genre', '=', 'M'], ['admin', '<>', true]])->get(); 
        $utilisateurs_femmes = User::where([['genre', '=', 'F'], ['admin', '<>', true]])->get(); 
        // dd(count($utilisateurs_femmes)); 
        return $this->chart->pieChart()
            ->setTitle('Histogramme du nombre d’hommes et de femmes inscrits sur le site')
            ->addData([count($utilisateurs_femmes), count($utilisateurs_hommes)])
            ->setLabels(['Femmes', 'Hommes'])
            ->setColors(['#D4DC83', '#414230'])
            ->setFontFamily('Dosis, sans-serif');
    }
}
