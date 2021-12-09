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
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    @if (count($errors)>0)
                        <div class="text-danger">
                            {{$errors}}
                        </div>
                    @endif
                    <h4>Ajouter un appartement</h4>
                    <form action="{{route('proprietaire.ajout-appartement', [Request::segment(2)])}}" method="post">
                        @csrf
                        <div class="card-group d-block">
                                <div class="card">
                                    <div class="card-header">
                                        Adresse
                                    </div>
                                    <div class="card-body">

                                        <div class="form-group">
                                          <label for="num_boite">N° Boîte</label>
                                          <input type="number" name="num_boite" id="num_boite" class="form-control" required>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="fixe">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Adresse fixe</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Détails appartement
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="form-group">
                                            <label for="nombre_habitants">Nombre d'habitants</label>
                                            <input type="number" name="nombre_habitants" id="nombre_habitants" class="form-control" required >
                                        </div>

                                        <div class="form-group">
                                            <label for="type_appartement">Type</label>
                                            <select name="type_appartement" id="type_appartement" class="form-control">
                                                @forelse ($types_appartement as $typeappartement)
                                                    <option value={{$typeappartement->id}}>{{$typeappartement->libelle}}</option>
                                                @empty
                                                    <option></option>
                                                @endforelse
                                            </select>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="degres_securite">Degrès de sécurité</label>
                                            <select name="degres_securite" id="degres_securite" class="form-control">
                                                @forelse ($degres_securite as $securite)
                                                    <option value={{$securite->id}}>{{$securite->libelle}}</option>
                                                @empty
                                                    <option></option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Pieces
                                    </div>
                                    <div class="card-body" id="form-pieces">
                                        <div class="form-group" id="form-group-piece_1">
                                            <label for="piece_1">Piece 1</label>
                                            <input type="text" name="piece_1" id="piece_1" class="form-control" placeholder="" required> <br>
                                            <select name="type_piece_1" id="type_piece_1" class="form-control">
                                                @forelse ($types_piece as $type_piece)
                                                    <option value={{$type_piece->id}}>{{$type_piece->libelle}}</option>
                                                @empty
                                                    <option></option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer" id="buttons-pieces">
                                        <input type="number" name="nb_pieces" id="nb_pieces" class="form-control" value="1" hidden>
                                        <button type="button" id="add-piece" class="m-2 btn btn-md btn-primary float-right d-flex justify-content-center align-items-center">
                                            <span class="material-icons">
                                                add
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-lg btn-success float-right">
                                            Ajouter
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
            <footer class="text-center">
                <small>&copy; 2021 - Le trio</small>
            </footer>
        </div>
    </div>


@endsection

@section('js')
    <script>
        $(document).ready(function(){

            let nbPieces = 1; 

            $('#add-piece').on('click', ()=>{
                nbPieces++; 

                $('#form-pieces').append('<div class="form-group" id="form-group-piece_'+nbPieces+'"><label for="piece_'+nbPieces+'">Piece '+nbPieces+'</label><input type="text" name="piece_'+nbPieces+'" id="piece_'+nbPieces+'" class="form-control" placeholder="" required><br><select name="type_piece_'+nbPieces+'" id="type_piece_'+nbPieces+'" class="form-control">@forelse ($types_piece as $type_piece)<option value={{$type_piece->id}}>{{$type_piece->libelle}}</option>@empty<option></option>@endforelse</select></div>'); 


                if($('#delete-piece').length < 1){
                    $('#buttons-pieces').append('<button type="button" class="m-2 btn btn-md btn-danger float-right justify-content-center align-items-center" id="delete-piece"><span class="material-icons">delete</span></button>');
                    $('#delete-piece').on('click', ()=>{
                        if (nbPieces > 1) {
                            $('#form-group-piece_'+nbPieces).remove();
                            nbPieces--;
                            // $('#nb_pieces').val(nbPieces);
                            if (nbPieces < 2) {
                                $('#delete-piece').remove(); 
                            }
                        }
                    });
                }
                $('#nb_pieces').val(nbPieces); 
            }); 
        }); 
    </script>
@endsection