@extends('layouts/app')

@section('content')
    
    <div class="container auth">
        <form method="POST" action="{{ route('verification.send') }}" class="w-75 shadow form">
            @csrf
            <!-- Connexion -->

            <div class="card text-left">
                <div class="card-header">
                    <h3>
                        Verification email
                    </h3>
                </div>
                <div class="card-body">                  
                    @if (session('status') == 'verification-link-sent')
                        <small class="p-2 text-success font-weight-bold">
                            Un nouveau lien de vérification a été envoyé à l'adresse e-mail que vous avez fournie lors de
                            l'inscription.
                        </small>
                    @endif
                    <div class="form-group">
                        Merci pour votre inscription! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en
                        cliquant sur le lien que nous venons de vous envoyer par e-mail ? 
                        <br> Si vous n'avez pas reçu
                        l'e-mail, nous nous ferons un plaisir de vous en envoyer un autre.
                    </div>
                    <div class="form-group text-right login-div">
                        <small class="forgot-password">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a type="submit">Log out</a>
                            </form>
                        </small>
                        <button type="submit" class="btn btn-connexion">
                            RENVOYER L'E-MAIL DE VÉRIFICATION
                        </button>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>

@endsection