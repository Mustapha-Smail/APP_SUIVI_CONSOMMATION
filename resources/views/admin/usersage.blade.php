@extends('layouts/dashboard-app')

@section('content')
    <div class="container">
        <div class="container-body">
            <div class="row">
                <div class="col-sm-3">
                    <form action="{{route('admin.usersage')}}" method="post" class="form w-100">
                        @csrf
                        <input type="number" min="1900" max="2099" step="1" name="date_naissance" id="date_naissance" class="form-control">
                        <button type="submit" class="m-2 btn btn-sm btn-primary">Search</button>
                    </form>
                </div>
            </div>
                <div class="row d-flex justify-content-center align-items-center">
                @if (Session::get('chart'))
                    <div class="col-sm-6 offset-sm-3 rounded shadow">
                        {{ (Session::get('chart'))->container() }}
                    </div>
                @else
                    <div class="card">
                      <div class="card-body">
                        <p class="card-text">
                            Sélectionnez une année afin de voir le nombre d'utilisateurs nés à cette année là :)
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