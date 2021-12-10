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
                    <h4>Ajouter des pieces</h4>
                    <form action="{{route('locataire.ajout-piece', [Request::segment(2)])}}" method="post">
                        @csrf
                        {{--
                            les pieces  
                        --}}
                        <div class="card-group d-block">
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
                    $('#buttons-pieces').append('<button type="button" class="m-2 btn btn-md btn-danger float-right justify-content-center align-items-center" id="delete-piece" onClick="deletePiece()"><span class="material-icons">delete</span></button>');
                    $('#delete-piece').on('click', ()=>{
                        if (nbPieces > 1) {
                            $('#form-group-piece_'+nbPieces).remove();
                            nbPieces--;
                            // $('#nb_pieces').val(nbPieces);
                            if (nbPieces < 2) {
                                $('#delete-piece').remove(); 
                            }
                        }
                        $('#nb_pieces').val(nbPieces); 

                    });
                }
                $('#nb_pieces').val(nbPieces); 
            }); 
        }); 
    </script>
@endsection