<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="{{route('accueil')}}"><img src="{{URL::asset('images/logo.png')}}" alt="logo" class="logo"></a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto nav-ul">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('accueil')}}">Accueil</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{route('villes')}}">Villes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>
        
        <div class="nav-btn">
            <a class="btn connecter" href="{{route('login')}}">Se connecter</a>
            <a class="btn inscrire" href="{{route('register')}}">S'inscrire</a>    
        </div>

    </div>
</nav>