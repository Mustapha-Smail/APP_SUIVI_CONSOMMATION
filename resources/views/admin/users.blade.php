@extends('layouts/dashboard-app')

@section('content')
    
    <div class="container">
        <div class="container-body">
            <div class="row">
                <div class="col-12 justify-content-center">
                    <table class="table table-striped table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Genre</th>
                                <th>Date de naissance</th>
                                <th>Adresse mail</th>
                                <th>N° Téléphone</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)    
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->nom}}</td>
                                    <td>{{$user->prenom}}</td>
                                    <td>{{$user->genre === 'M' ? 'Homme' : 'Femme'}}</td>
                                    <td>{{$user->date_naissance->format('d-m-Y')}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->num_tel}}</td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection