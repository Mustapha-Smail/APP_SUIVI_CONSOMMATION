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
        <form method="POST" action="{{ route('password.update') }}" class="w-75 shadow form">
            @csrf
            
            <!-- Connexion -->

            <div class="card text-left">
                <div class="card-header">
                    <h3>
                        Réinitialisation mot de passe
                    </h3>
                </div>
                <div class="card-body">
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    
                    <div class="form-group">
                        <input type="email" name="email" value="{{ $request->email }}" id="email" class="form-control"
                            placeholder="Email">
                    </div>
                    
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Mot de passe" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                            placeholder="Confirmer mot de passe" required>
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