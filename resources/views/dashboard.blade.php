@extends('layouts/dashboard-app')

@section('content')
    
    <div class="container">
        <div class="container-body">
            <div class="row">
                <div class="col-sm-12 pb-3">
                    <h1>Hello {{$user->prenom}} !</h1>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-3">
                            <a href="{{route('proprietaire.maisons')}}" class="btn btn-lg btn-success">
                                Mes propriétés
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{route('locataire.appartements')}}" class="btn btn-lg btn-success">
                                Mes locations
                            </a>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-12 text-center card-header mb-5">
                            <h1>Mes proprietés</h1>
                        </div>
                        <div class="col-sm-4 rounded shadow w-auto">
                            {!! $proprietaireConsommationChart->container() !!}
                        </div>
                        <div class="col-sm-4 offset-sm-4 rounded shadow w-auto">
                            {!! $proprietaireEmissionChart->container() !!}
                        </div> 
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-12 text-center card-header mb-5">
                            <h1>Mes locations</h1>
                        </div>
                        <div class="col-sm-4 rounded shadow w-auto">
                            {!! $locataireConsommationChart->container() !!}
                        </div>
                        <div class="col-sm-4 offset-sm-4 rounded shadow w-auto">
                            {!! $locataireEmissionChart->container() !!}
                        </div> 
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <script src="{{ $locataireConsommationChart->cdn() }}"></script>
    <script src="{{ $locataireEmissionChart->cdn() }}"></script>
    <script src="{{ $proprietaireConsommationChart->cdn() }}"></script>
    <script src="{{ $proprietaireEmissionChart->cdn() }}"></script>

    {{ $locataireConsommationChart->script() }}
    {{ $locataireEmissionChart->script() }}
    {{ $proprietaireConsommationChart->script() }}
    {{ $proprietaireEmissionChart->script() }}

@endsection