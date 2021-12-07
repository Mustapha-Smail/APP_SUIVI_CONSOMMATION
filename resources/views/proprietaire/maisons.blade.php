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
                    @forelse ($maisons as $maison)
                        <div class="card w-100 shadow">
                        <div class="card-header">
                            {{$maison->nom}}
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <h6>{{$maison->num_rue}}, {{$maison->nom_rue}}</h6>
                                <p>{{$maison->nom_ville}}, {{$maison->code_postal}}</p>
                            </div>
                            <p class="card-text">
                                Depuis, {{ Carbon\Carbon::parse($maison->debut_possession)->format('Y-m-d') }}
                            </p>
                            <p class="card-text">
                                Degrès d'isolation: {{
                                    App\Models\Isolation::find($maison->isolation_id)->libelle
                                }}
                            </p>
                            <p class="card-text">
                                Status écologique: {{
                                    App\Models\Statusecologique::find($maison->statusecologique_id)->libelle
                                }}
                            </p>
                            <a href="{{route('proprietaire.appartements', [$maison->id])}}" class="btn btn-primary float-right">
                                <span class="material-icons">
                                    forward
                                </span>
                            </a>
                        </div>
                    </div><br>
                    @empty
                        <center>
                        <a href="{{route('proprietaire.ajout-maison')}}" class="btn btn-lg btn-success">Ajouter une maison</a>
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