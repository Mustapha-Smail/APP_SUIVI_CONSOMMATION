<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Maison;
use App\Models\Appartement;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('get-proprietaire-appartements', function(User $user, Maison $maison){
            $proprietaire = DB::table('proprietaires')
                                ->select('proprietaires.user_id')
                                ->where([
                                    ['proprietaires.maison_id', '=', $maison->id], 
                                    ['proprietaires.fin_possession', '>', Carbon::now()]
                                ])
                                ->first();
            return $user->id === $proprietaire->user_id; 
        }); 

        Gate::define('get-locataire-pieces', function(User $user, Appartement $appartement){
            $locataire = DB::table('locataires')
                            ->select('locataires.user_id')
                            ->where([
                                ['locataires.appartement_id', '=', $appartement->id], 
                                ['locataires.fin_location', '>', Carbon::now()]
                            ])
                            ->first();
            return $user->id === $locataire->user_id; 
        }); 
    }
}
