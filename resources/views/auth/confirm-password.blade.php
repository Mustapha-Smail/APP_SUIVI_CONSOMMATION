@extends('layouts/app')

@section('content')

    @if ($errors->any())
        <div class="container auth pd-3">
            <ul class="text-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container auth">
        <form method="POST" action="{{ route('password.confirm') }}" class="w-75 shadow form">
            @csrf
            <!-- Connexion -->

            <div class="card text-left">
                <div class="card-header">
                    <h3>
                        Confirmation mot de passe
                    </h3>
                </div>
                <div class="card-body">   
                    <div class="form-group">
                        Il s'agit d'une zone sécurisée de l'application.
                        <br> Veuillez confirmer votre mot de passe avant de
                        continuer.
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe actuel">
                    </div>
                    <div class="form-group text-right login-div">
                        <button type="submit" class="btn btn-connexion">
                            CONFIRMER
                        </button>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
@endsection