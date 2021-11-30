@extends('layouts/dashboard-app')

@section('content')
    <div class="container">
    <ul>
        @if ($user)
            <li>{{$user->id}}</li>
            <li>{{$user->nom}}</li>
            <li>{{$user->prenom}}</li>
            <li>{{$user->date_naissance->format('d-m-Y')}}</li>
            <li>
                @if ($user->genre == 'M')
                    Homme
                @else
                    Femme
                @endif
            </li>
            <li>{{$user->email}}</li>
            <li>{{$user->num_tel}}</li>
        @endif
    </ul>
    </div>

@endsection