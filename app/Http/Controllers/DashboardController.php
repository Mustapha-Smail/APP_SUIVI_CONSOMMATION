<?php

namespace App\Http\Controllers;

use App\Charts\HommesFemmesUsersChart;
use App\Charts\MonthlyUsersChart;
use App\Charts\UsersAgeChart;
use App\Charts\UsersByAgeChart;
use App\Models\Maison;
use App\Models\Appartement;
use App\Models\Locataire;
use App\Models\Proprietaire;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Khill\Lavacharts\Lavacharts as Lava; 
// use Khill\Lavacharts\Laravel\LavachartsFacade as lavaL

class DashboardController extends Controller
{

    public function index(
        HommesFemmesUsersChart $chart, 
        UsersByAgeChart $usersbyage
    )
    {
        $user = Auth::user(); 

        if(Gate::allows('admin')){

            return view('admin.dashboard', [
                'chart' => $chart->build(),
                'usersbyage' => $usersbyage->build()
            ]); 
        }

        else{
            return view('dashboard', compact('user'));
        }
    }

    public function profile(){
        $user = Auth::user(); 
        $adresse_fixe = Locataire::where([['user_id', $user->id], ['fixe', true]])->orderBy('updated_at', 'desc')->first(); 
        return view('profile', compact('user', 'adresse_fixe'));
    }

    

    public function usersage(){
        if(! Gate::allows('admin')){
            abort(403); 
        }
        return view('admin.usersage'); 
    }

    public function searchusersage(Request $request, UsersAgeChart $chart){
        // $date = 'date_naissance'; 
        // dd($request->$date); 
        $chart = $chart->build($request->date_naissance); 
        return redirect()->route('admin.usersage')->with(['chart' => $chart]); 
    }
}
