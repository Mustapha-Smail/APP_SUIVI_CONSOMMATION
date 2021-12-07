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
                @if (count($appartements))
                    <div class="col-sm-12 pb-3">
                        <div class="row justify-content-end">
                            <div class="col-4 pr-3">
                                <a href="{{route('proprietaire.ajout-appartement', [$appartements[0]->maison->id])}}" class="btn btn-lg btn-primary float-right">Ajouter un appartement</a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-sm-9">
                    @forelse ($appartements as $appartement)
                        <div class="card w-100 shadow">
                        <div class="card-header">
                            {{$appartement->num_boite}}
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <h6>{{$appartement->typeappartement->libelle}}</h6>
                                <p>{{$appartement->nombre_habitants}} habitants</p>
                            </div>
                            <p class="card-text">
                                Depuis, {{ Carbon\Carbon::parse($appartement->created_at)->format('Y-m-d') }}
                                {{$appartement->securite->libelle}}
                            </p>
                            <a href="#" class="btn btn-primary float-right">
                                <span>
                                    Consommation 
                                </span>
                                <span class="material-icons">
                                    forward
                                </span>
                            </a>
                        </div>
                    </div><br>
                    @empty
                        <center>
                        <a href="{{route('proprietaire.ajout-appartement', [Request::segment(2)])}}" class="btn btn-lg btn-success">Ajouter un appartement</a>
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