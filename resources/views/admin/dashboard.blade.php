@extends('layouts/dashboard-app')

@section('content')
    <div class="container">
        <div class="container-body">
            <div class="row">
                <div class="col-sm-4 rounded shadow">
                    {!! $chart->container() !!}
                </div>
            </div>
        </div>

    </div>

    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}

@endsection