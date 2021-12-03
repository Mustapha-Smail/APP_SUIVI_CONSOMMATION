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
                <form action="#" method="post" class="w-100">
                    <div class="form-group">
                        <label for="identifiant" class=" w-50">Identifiant</label>
                        <input type="text" readonly name="identifiant" id="identifiant" class="form-control w-50" value="{{$user->identifiant}}" >
                    </div>

                    <div class="form-group">
                        <label for="nom" class=" w-50">Nom</label>
                        <input type="text" name="nom" id="nom" class="form-control w-50" value="{{$user->nom}}" >
                    </div>

                    <div class="form-group">
                        <label for="prenom" class=" w-50">Prénom</label>
                        <input type="text" name="prenom" id="prenom" class="form-control w-50" value="{{$user->prenom}}" >
                    </div>

                    <div class="form-group">
                        <label for="date_naissance" class=" w-50">Date de naissance</label>
                        <input type="date" name="date_naissance" id="date_naissance" class="form-control w-50" value="{{$user->date_naissance->format('Y-m-d')}}" >
                    </div>

                    <div class="form-group">
                        <label for="email" class=" w-50">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control w-50" value="{{$user->email}}" >
                    </div>

                    <div class="form-group">
                        <label for="num_tel" class=" w-50">N° Téléphone</label>
                        <input type="tel" name="num_tel" id="num_tel" class="form-control w-50" pattern="[0]{1}[0-9]{9}"
                            value="{{$user->num_tel}}">
                    </div>

                </form>
            @endif
        </div>
    </div>

@endsection