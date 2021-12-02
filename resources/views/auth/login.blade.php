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
        <form action="{{route('login')}}" method="POST" class="w-50 shadow form">

            @csrf

            <!-- Connexion -->

            <div class="card text-left">
                <div class="card-header">
                    <h3>
                        Connexion
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" name="login" id="login" class="form-control" placeholder="Identifiant / email" value="{{ old('username') ?: old('email') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe"
                            required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Remember me
                        </label>
                    </div>
                    <div class="form-group text-right login-div">
                        @if (Route::has('password.request')) 
                            <small class="forgot-password"> <a href="{{ route('password.request') }}"> forgot password ?</a></small>
                        @endif
                        <button type="submit" class="btn btn-lg btn-connexion">Login</button>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>

@endsection