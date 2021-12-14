@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container-body p-5">
            <div class="row">
                <div class="col-6 offset-3" id="profile">
                    <form action="mailto:cqc.letrio@gmail.com" method="get" class="w-100">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3>Contact</h3>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="nom">Nom <span class="text-danger">*</span> </label>
                                    <input type="text" name="nom" id="nom" class="form-control"  required>
                                </div>

                                <div class="form-group">
                                    <label for="prenom">Prénom <span class="text-danger">*</span> </label>
                                    <input type="text" name="prenom" id="prenom" class="form-control"  required>
                                </div>

                                <div class="form-group">
                                    <label for="email">E-mail <span class="text-danger">*</span> </label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="message">Commentaire <span class="text-danger">*</span> </label>
                                    <textarea name="message" cols="30" rows="10" class="form-control" placeholder="écrivez votre message ici..." required></textarea>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-lg inscrire float-right">Envoyer</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection