@extends('layouts/dashboard-app')

@section('content')
    
    <div class="container">
        <div class="container-body">
            <div class="row">
                <div class="col-sm-12 pb-3">
                    <h1>Hello {{$user->prenom}} !</h1>
                </div>
                <div class="col-sm-6 offset-sm-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{route('proprietaire.maisons')}}" class="btn btn-lg btn-success">
                                Mes propriétés
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{route('locataire.appartements')}}" class="btn btn-lg btn-success">
                                Mes locations
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

@endsection