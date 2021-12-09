@extends('layouts/dashboard-app')

@section('content')
    <div class="container">
        <div class="container-body">
            <div class="row">
                <div class="col-12">
                    <a href="{{ url()->previous() }}" class="text-dark">
                        <span class="material-icons">
                            arrow_back
                        </span>
                    </a>
                </div>
            </div>
            @if ($user)
            <div class="row">
                <div class="col-6 offset-3" id="profile">
                    <form action="#" method="post" class="w-100">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="identifiant">Identifiant</label>
                                        <input type="text" readonly name="identifiant" id="identifiant" class="form-control" value="{{$user->identifiant}}" >
                                    </div>
    
                                    <div class="form-group">
                                        <label for="nom">Nom</label>
                                        <input type="text" name="nom" id="nom" class="form-control" value="{{$user->nom}}" >
                                    </div>
    
                                    <div class="form-group">
                                        <label for="prenom">Prénom</label>
                                        <input type="text" name="prenom" id="prenom" class="form-control" value="{{$user->prenom}}" >
                                    </div>
    
                                    <div class="form-group">
                                        <label for="date_naissance">Date de naissance</label>
                                        <input type="date" name="date_naissance" id="date_naissance" class="form-control" value="{{$user->date_naissance->format('Y-m-d')}}" >
                                    </div>
    
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}" >
                                    </div>
    
                                    <div class="form-group">
                                        <label for="num_tel">N° Téléphone</label>
                                        <input type="tel" name="num_tel" id="num_tel" class="form-control" pattern="[0]{1}[0-9]{9}"
                                            value="{{$user->num_tel}}">
                                    </div>
                                </div>
                            </div>
                            @if ($adresse_fixe)
                                
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="num_rue">N° rue</label>
                                            <input type="number" name="num_rue" class="form-control" value={{$adresse_fixe->appartement->maison->num_rue}} id="num_rue" readonly>
                                        </div>
        
                                        <div class="form-group">
                                            <label for="rue">Rue</label>
                                            <input type="text" name="rue" class="form-control" value={{$adresse_fixe->appartement->maison->nom_rue}} id="rue" readonly>
                                        </div>
        
                                        <div class="form-group">
                                            <label for="code_postal">Code Postal</label>
                                            <input type="number" name="code_postal" class="form-control" value={{$adresse_fixe->appartement->maison->ville->code_postal}} id="code_postal" readonly>
                                        </div>
        
                                        <div class="form-group">
                                            <label for="ville">Ville</label>
                                            <input type="text" name="ville" class="form-control" value={{$adresse_fixe->appartement->maison->ville->nom}} id="ville" readonly>
                                        </div>
                                    </div>
                                </div>
                            
                            @endif
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>

@endsection

@section('js')
    <script>
        if (window.matchMedia("(max-width: 768px)").matches) {
            // console.log('hello');
            $('#profile').removeClass('col-6 offset-3'); 
            $('#profile').addClass('col-12'); 
            
        } 
    </script>
@endsection