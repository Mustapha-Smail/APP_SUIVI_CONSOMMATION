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
                        @if (count($pieces)>0)
                            <div class="col-4 pr-3">
                                <a href="{{route('locataire.ajout-piece', [$pieces[0]->appartement->id])}}" class="btn btn-lg btn-primary float-right">Ajouter une piece</a>
                            </div>   
                        @endif
                    </div>
                </div>
                <div class="col-sm-9">
                    @forelse ($pieces as $piece)
                        <div class="card w-100 shadow">
                            <div class="card-header">
                                {{$piece->libelle}}
                            </div>
                            <div class="card-body">
                                <div class="card-title">
                                    <h6>{{App\Models\Typepiece::find($piece->typepiece_id)->libelle}}</h6>
                                </div>
                                <p class="card-text">
                                    {{App\Models\Appartement::find($piece->appartement_id)->num_boite}}
                                </p>
                                <a href="{{route('locataire.piece', [$piece->id])}}" class="btn btn-primary float-right">
                                    <span class="material-icons">
                                        forward
                                    </span>
                                </a>
                            </div>
                        </div><br>
                    @empty
                        <center>
                            <a href="{{route('locataire.ajout-piece', [Request::segment(2)])}}" class="btn btn-lg btn-success">Ajouter une pièce</a>
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