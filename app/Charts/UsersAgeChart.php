<?php

namespace App\Charts;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class UsersAgeChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($annee_naissance): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $users = User::where('date_naissance', 'LIKE', $annee_naissance.'%')->get(); 
        // dd($users); 
        $u = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; 
        $months = ['Jan.', 'Fev.', 'Mar', 'Avr.', 'Mai', 'Jui.', 'Juil.', 'Aou.', 'Sep.', 'Oct.', 'Nov.', 'Dec.']; 
        foreach ($users as $user) {

            $u[$user->date_naissance->month - 1] += 1;  
        }

        // dd($u);

        return $this->chart->lineChart()
            ->setTitle('Users de '.$annee_naissance)
            ->addData('Users', $u)
            ->setXAxis($months);
    }
}
