@extends('layouts/dashboard-app')

@section('content')
    <div class="container">
        <div class="container-body">
            <div class="row p-3">
                <div class="col-sm-3">
                    <a href="{{route('admin.usersage')}}" class="btn btn-lg btn-success">
                        Utilisateurs par année de naissance
                    </a>
                </div>
            </div>
            <div class="row p-3">
                <div class="col-sm-4 rounded shadow">
                    {!! $chart->container() !!}
                </div>
            </div>
            <div class="row p-3">   
                <div class="col-sm-4 offset-sm-8 rounded shadow">
                     {!! $usersbyage->container() !!}
                </div>
            </div>
        </div>

    </div>

    <script src="{{ $chart->cdn() }}"></script>
    <script src="{{ $usersbyage->cdn() }}"></script>

    {{ $chart->script() }}
    {{ $usersbyage->script() }}

@endsection