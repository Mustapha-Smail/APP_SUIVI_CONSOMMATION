@extends('layouts/dashboard-app')

@section('content')
    <div class="container">
        <div class="container-body">
            <div class="row">
                <div class="col-sm-3">
                    <form action="{{route('locataire.consommations', [Request::segment(2)])}}" method="POST" class="form w-100">
                        @csrf
                        <select name="ressource" id="ressource">
                            @forelse ($ressources as $ressource)
                                <option value="{{$ressource->id}}">{{$ressource->libelle}}</option>
                            @empty
                                <option value=""></option>
                            @endforelse
                        </select>
                        <button type="submit" class="m-2 btn btn-sm btn-primary">Search</button>
                    </form>
                </div>
            </div>
                <div class="row d-flex justify-content-center align-items-center">
                @if (Session::get('chart'))
                    <div class="col-sm-6 rounded shadow">
                        {{ (Session::get('chart'))->container() }}
                    </div>
                @else
                    <div class="card">
                      <div class="card-body">
                        <p class="card-text">
                            Sélectionnez une ressource afin de voir les stats de sa conso :)
                        </p>
                      </div>
                    </div>
                @endif
                </div>
            
        </div>

    </div>

    @if (Session::get('chart'))

        <script src="{{ (Session::get('chart'))->cdn() }}"></script>

        {{ (Session::get('chart'))->script() }}        
    @endif

@endsection