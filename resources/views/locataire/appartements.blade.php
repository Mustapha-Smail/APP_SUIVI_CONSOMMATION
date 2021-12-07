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
                    @forelse ($appartements as $appartement)
                        <div class="card w-100 shadow">
                        <div class="card-header">
                            {{$appartement->num_boite}}
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <h6>{{App\Models\Typeappartement::find($appartement->typeappartement_id)->libelle}}</h6>
                                <p>{{$appartement->nombre_habitants}} habitants</p>
                            </div>
                            <p class="card-text">
                                Loué depuis, {{ Carbon\Carbon::parse($appartement->debut_location)->format('Y-m-d') }}
                            </p>
                            <a href="{{route('locataire.pieces', [$appartement->id])}}" class="btn btn-primary float-right">
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