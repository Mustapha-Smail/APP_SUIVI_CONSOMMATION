<?php

namespace App\Charts;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class UsersByAgeChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $users = User::where('admin', '<>', true)->get(); 
        $x = ['[18 ,24]', ']24 ,45]', ']45 ,65]', '+65']; 
        $y = [0, 0, 0, 0]; 
        foreach ($users as $user) {
            $age = Carbon::now()->year - $user->date_naissance->year ; 
            // dd($age);  
            switch ($age) {
                case ($age >= 18 && $age <= 24):
                    $y[0] += 1; 
                    break;
                case ($age > 24 && $age <= 45):
                    $y[1] += 1; 
                    break; 
                case ($age > 45 && $age <= 65):
                    $y[2] += 1; 
                    break; 
                default:
                    $y[3] += 1; 
                    break;
            }
        }
        
        return $this->chart->barChart()
            ->setTitle('Users by age')
            ->addData('', $y)
            ->setXAxis($x);
    }
}
