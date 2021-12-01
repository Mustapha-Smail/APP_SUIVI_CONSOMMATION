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
        <form method="POST" action="{{ route('password.email') }}" class="w-75 shadow form">
            @csrf

            <!-- Connexion -->

            <div class="card text-left">
                <div class="card-header">
                    <h3>
                        Réinitialisation mot de passe
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        Mot de passe oublié? Aucun problème.
                        <br> Communiquez-nous simplement votre adresse e-mail et nous
                        vous enverrons par e-mail un lien de réinitialisation de mot de passe qui vous permettra d'en
                        choisir un nouveau.
                    </div>
                    <div class="form-group">
                      <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group text-right login-div">
                        <button type="submit" class="btn btn-connexion">
                            RÉINITIALISER
                        </button>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
    
@endsection