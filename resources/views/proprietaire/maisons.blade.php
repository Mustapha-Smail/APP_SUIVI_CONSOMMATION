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
                            <a href="{{route('proprietaire.ajout-maison')}}" class="btn btn-lg btn-primary float-right">Ajouter une maison</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    @forelse ($proprietes as $propriete)
                        <div class="card w-100 shadow">
                        <div class="card-header">
                            {{$propriete->maison->num_rue}}
                            {{$propriete->maison->nom_rue.','}}
                            {{$propriete->maison->ville->code_postal}}
                            {{$propriete->maison->ville->nom}}
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <h6>{{count($propriete->maison->appartements)}} Appartement(s)</h6>
                            </div>
                            <p class="card-text">
                                Proprieté: {{$propriete->debut_possession->format('d/m/Y') }} jusqu'à {{$propriete->fin_possession->format('d/m/Y') }}
                            </p>
                            <p class="card-text">
                                Degrés d'isolation: {{$propriete->maison->isolation->libelle}}
                            </p>
                            <p class="card-text">
                                Status ecologique: {{$propriete->maison->statusecologique->libelle}}
                            </p>
                            <a href="{{route('proprietaire.appartements', [$propriete->maison->id])}}" class="btn btn-primary float-right">
                                Appartements
                                <span class="material-icons">
                                    forward
                                </span>
                            </a>
                        </div>
                    </div><br>
                    @empty
                        <center>
                        <a href="{{route('proprietaire.ajout-maison')}}" class="btn btn-lg btn-success">Ajouter un appartement</a>
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