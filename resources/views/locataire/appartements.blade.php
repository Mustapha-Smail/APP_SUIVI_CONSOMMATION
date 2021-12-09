@extends('layouts/dashboard-app')

@section('content')
    
<div class="container">
        <div class="container-body">
            <div class="row">
                <div class="col-12">
                    <a href="{{ url()->previous() }}" class="text-dark">
                        <span class="material-icons">
                            arrow_back
                        </span>
                    </a>
                </div>
            </div>
            <div class="row">
                
                <div class="col-sm-12 pb-3">
                    <div class="row justify-content-end">
                        <div class="col-4 pr-3">
                            <a href="{{route('locataire.ajout-appartement')}}" class="btn btn-lg btn-primary float-right">Ajouter un appartement</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-9">
                    @forelse ($locations as $location)
                        <div class="card w-100 shadow">
                        <div class="card-header">
                            {{$location->appartement->maison->num_rue}}
                            {{$location->appartement->maison->nom_rue.','}}
                            appartement
                            {{$location->appartement->num_boite.','}}
                            {{$location->appartement->maison->ville->code_postal}}
                            {{$location->appartement->maison->ville->nom}}
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <h6>{{$location->appartement->typeappartement->libelle}}</h6>
                                <p>{{$location->appartement->nombre_habitants}} habitants</p>
                            </div>
                            <p class="card-text">
                                Location: {{$location->debut_location->format('d/m/Y') }} jusqu'à {{$location->fin_location->format('d/m/Y') }}
                            </p>
                            <a href="{{route('locataire.pieces', [$location->appartement->id])}}" class="btn btn-primary float-right">
                                Pièces
                                <span class="material-icons">
                                    forward
                                </span>
                            </a>
                        </div>
                    </div><br>
                    @empty
                        <center>
                        <a href="{{route('locataire.ajout-appartement')}}" class="btn btn-lg btn-success">Ajouter un appartement</a>
                        </center>
                    @endforelse
                </div>

            </div>
            <footer class="text-center">
                <small>&copy; 2021 - Le trio</small>
            </footer>
        </div>
    </div>
    

@endsection