@extends('layouts/app')

@section('content')

    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif

    <div class="container auth">
        <form action="{{route('register')}}" method="POST" class="w-50 shadow form">
            <!-- Coordonnées -->
            @csrf
            <div class="card text-left">
                <div class="card-header">
                    <h3>
                        1- Coordonnées
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" name="nom" id="nom_register" class="form-control" placeholder="Votre nom" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="prenom" id="prenom_register" class="form-control" placeholder="Votre prenom"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="date" name="date_naissance" id="date_naissance_register" class="form-control"
                            placeholder="Votre date de naissance" required aria-describedby="HelpDateNaisance">
                        <small id="helpDateNaissance" class="text-muted">Votre date de naissance</small>
                    </div>
                    <div class="form-group">
                        <small class="text-muted">
                            Genre: 
                        </small>
                        <select name="genre" id="genre" class="form-select" aria-label="Default select example" required
                            autofocus="">
                            <option value="M">Homme</option>
                            <option value="F">Femme</option>
                            <option value="O">Autre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="num_tel" id="num_tel_register" class="form-control" pattern="[0]{1}[0-9]{9}"
                            required placeholder="Votre numéro de téléphone" aria-describedby="helpNumTel">
                        <small id="helpNumTel" class="text-muted">Format: 0XXXXXXXXX</small>
                    </div>

                </div>
            </div>

             <!-- Identifiants -->

             <div class="card text-left">
                 <div class="card-header">
                     <div class="d-inline float-left">
                         <h3>2- Identifiants</h3>
                     </div>
                 </div>
                 <div class="card-body d-none" id="identifiants-card-register">
                     <div class="form-group">
                         <input type="email" name="email" id="email" class="form-control" placeholder="Votre email"
                             required>
                     </div>
                     <div class="form-group">
                         <input type="password" name="password" id="password" class="form-control"
                             placeholder="Votre mot de passe" required>
                     </div>
                     <div class="form-group">
                         <input type="password" name="password_confirmation" id="password_confirmation"
                             class="form-control" placeholder="Confirmez votre mot de passe" required>
                     </div>
                     <br>
                     <div class="form-group d-inline float-right">
                         <button type="submit" class="btn btn-lg btn-connexion">Créer</button>
                     </div>
                 </div>
             </div>
        </form>
    </div>

@endsection
