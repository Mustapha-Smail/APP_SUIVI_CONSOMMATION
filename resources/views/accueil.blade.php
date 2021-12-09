@extends('layouts/app')

@section('content')

    <div class="header">
        <div class="header-content">
            <center>
                <h1 class="title">CONTRÔLE DE QUALITE ET DE CITOYENNETE</h1>
                <p class="subtitle">Pour suivre votre consommation en temps réel, être écolo et bien plus encore</p>
                <a class="btn btn-sm connecter" href="{{route('login')}}">Se connecter</a>
                <a href="{{route('register')}}" class="btn btn-lg  inscrire">S'inscrire</a>
            </center>
        </div>
    </div>

    <div class="row m-0">
        <div class="col-md-4 text-center">
            <div class="card">
                <div class="card-header bg-light">
                    <img src="/images/mustapha.png" alt="Mustapha" width="100" height="100">
                </div>
                <div class="card-body">
                    <h4 class="card-title">Mustapha SMAIL</h4>
                    <p class="card-text">
                        mustapha.smail@parisnanterre.fr
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card">
                <div class="card-header bg-light">
                    <img src="/images/amalia.png" alt="amalia" width="100" height="100">
                </div>
                <div class="card-body">
                    <h4 class="card-title">Amalia BENNAÏ</h4>
                    <p class="card-text">
                        amalia.bennai@parisnanterre.fr
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card">
                <div class="card-header bg-light">
                    <img src="/images/justine.png" alt="justine" width="100" height="100">
                </div>
                <div class="card-body">
                    <h4 class="card-title">Justine FREY</h4>
                    <p class="card-text">
                        j.frey@parisnanterre.fr
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection