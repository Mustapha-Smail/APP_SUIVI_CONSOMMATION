@extends('layouts/app')

@section('content')

    <div class="container-sm">
        <form class="form-signin" method="POST" action="">
            @csrf
            <h1 class="h3 mb-3 font-weight-normal text-center">Inscription</h1>
            
            {{-- Coordonnées --}}

            <label for="nom" class="sr-only">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" required autofocus>
            <br>

            <label for="prenom" class="sr-only">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom" required autofocus>
            <br>

            <label for="date_naissance" class="sr-only">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" class="form-control" placeholder="Date de naissance" required autofocus>
            <br>

            <label class="checkbox mb-3 sr-only">Genre</label>
            <select name="genre" id="genre" class="form-select" aria-label="Default select example" required autofocus>
                <option value="M">Homme</option>
                <option value="F">Femme</option>
                <option value="O">Autre</option>
            </select>
            <br>

            <label for="num_tel" class="sr-only">Numéro de téléphone</label>
            <input type="tel" name="num_tel" id="num_tel" class="form-control" placeholder="Numéro de téléphone" pattern="[0]{1}[0-9]{9}" required autofocus>
            <small>Format: 0XXXXXXXXX</small>
            <br>

            {{-- Adresse --}}
            <hr><br>

            <label for="num_maison" class="sr-only">N°</label>
            <input type="number" name="num_maison" id="num_maison" class="form-control" placeholder="N°" required autofocus>
            <br>

            <label for="nom_rue" class="sr-only">Nom de rue</label>
            <input type="text" name="nom_rue" id="nom_rue" class="form-control" placeholder="Nom de rue" required autofocus>
            <br>

            <label for="code_postal" class="sr-only">Code postal</label>
            <input type="number" name="code_postal" id="code_postal" class="form-control" placeholder="Code postal" pattern="[0-9]{5}" required autofocus onchange="hun()">
            <br>

            <input type="text" id="ville" class="form-control" placeholder="ville" name="ville"  disabled>
            
            {{-- <label for="ville" class="sr-only">Ville</label>
            <input type="text" name="ville" id="ville" class="form-control" placeholder="Ville" required autofocus>
            <br>

            <label class="checkbox mb-3 sr-only">Departement</label>
            <select name="departement" id="departement" class="form-select" aria-label="Default select example" required autofocus>
                @forelse ($departements as $departement)
                    <option value={{$departement->id}}>
                        {{$departement->code}} - {{$departement->name}}
                    </option>
                @empty
                    <option value="none">aucun</option>
                @endforelse
            </select> --}}
            <br>


            {{-- IDs --}}
            <hr><br>

            <label for="email" class="sr-only">Adresse mail</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Adresse mail" required autofocus>
            <br>

            <label for="password" class="sr-only">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" required>
            <br>


            <button class="btn btn-lg inscrire" type="submit">S'inscrire</button>
        </form>
        <br>
    </div>
    <script>
        // var villes = {{json_encode($villes)}}; 
        var villes = {!! json_encode($villes->toArray(), JSON_HEX_TAG) !!};
        function hun(){
            // var v = {{json_encode($villes)}}
            console.log('Hello');
            villes.forEach(element => {
                    console.log('inner hello');

                if (element.code_postal === document.getElementById('code_postal').value) {
                    document.getElementById("ville").value = "My value";
                }
            });
        }
    </script>

@endsection
