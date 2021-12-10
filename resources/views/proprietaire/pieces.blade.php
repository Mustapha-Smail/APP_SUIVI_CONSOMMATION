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
                <div class="col-sm-9 pt-5">
                    @forelse ($pieces as $piece)
                        <div class="card w-100 shadow">
                            <div class="card-header">
                                {{$piece->libelle}}
                            </div>
                            <div class="card-body">
                                <div class="card-title">
                                    <h6>{{$piece->typepiece->libelle}}</h6>
                                </div>
                                <p class="card-text">
                                    {{count($piece->appareils)}} appareil(s)
                                </p>
                            </div>
                        </div><br>
                    @empty
                        <center>
                            Aucune pieces dans cet appartement :(
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