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
                    <h4>Ajouter un appareil</h4>
                    <form action="{{route('locataire.ajout-appareil', [Request::segment(2)])}}" method="post">
                        @csrf
                        <div class="card-group d-block">
                            <div class="card">
                                <div class="card-header">
                                    Appareil
                                </div>
                                <div class="card-body" id="form-appareil">
                                    <div class="form-group" id="form-group-appareil">
                                        <div class="form-group">
                                            <label for="appareil">Appareil</label>
                                            <input type="text" name="appareil" id="appareil" class="form-control" placeholder="libelle" required> <br>
                                            <input type="text" name="description" id="description" class="form-control" placeholder="description" required> <br>
                                            <select name="type_appareil" id="type_appareil" class="form-control">
                                                @forelse ($types_appareil as $type_appareil)
                                                    <option value={{$type_appareil->id}}>{{$type_appareil->libelle}}</option>
                                                @empty
                                                    <option></option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <hr>
                                        <label>Ressources consommées</label>
                                        <div class="form-group" id="form-group-ressources">
                                            <div class="form-group-ressource_1">
                                                <select name="ressource_1" id="ressource_1" class="form-control">
                                                @forelse ($ressources as $ressource)
                                                    <option value={{$ressource->id}}>{{$ressource->libelle}}</option>
                                                @empty
                                                    <option></option>
                                                @endforelse
                                                </select>
                                                <br>
                                                <input type="number" name="conso_heure_ressource_1" id="conso_heure_ressource_1" class="form-control" placeholder="consommation/heure" required>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="form-group d-inline-block" id="buttons-ressources">
                                            <input type="number" name="nb_ressources" id="nb_ressources" class="form-control" value="1" hidden>
                                            <button type="button" id="add-ressource" class="p-2 m-2 btn btn-sm btn-primary">
                                                Ajouter une ressource
                                            </button>
                                        </div> 
                                        <hr>

                                        <label>Substances émises</label>
                                        <div class="form-group" id="form-group-substances">
                                        </div>
                                        <div class="form-group d-inline-block" id="buttons-substances">
                                            <input type="number" name="nb_substances" id="nb_substances" class="form-control" value="0" hidden>
                                            <button type="button" id="add-substance" class="m-2 p-2 btn btn-sm btn-primary ">
                                                Ajouter une substance
                                            </button>
                                        </div>
                                    </div>
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

            let nbressources = 1; 

            $('#add-ressource').on('click', ()=>{
                nbressources++; 

                $('#form-group-ressources').append('<div class="form-group" id="form-group-ressource_'+nbressources+'"><select name="ressource_'+nbressources+'" id="ressource_'+nbressources+'" class="form-control">@forelse ($ressources as $ressource)<option value={{$ressource->id}}>{{$ressource->libelle}}</option>@empty<option></option>@endforelse</select><br><input type="number" name="conso_heure_ressource_'+nbressources+'" id="conso_heure_ressource_'+nbressources+'" class="form-control" placeholder="consommation/heure" required></div><br>'); 


                if($('#delete-ressource').length < 1){
                    $('#buttons-ressources').append('<button type="button" class="p-2 m-2 btn btn-sm  btn-danger" id="delete-ressource">supprimer une ressource</button>');
                    $('#delete-ressource').on('click', ()=>{
                        if (nbressources > 1) {
                            $('#form-group-ressource_'+nbressources).remove();
                            nbressources--;
                            // $('#nb_ressources').val(nbressources);
                            if (nbressources < 2) {
                                $('#delete-ressource').remove(); 
                            }
                        }
                    });
                }
                $('#nb_ressources').val(nbressources); 
                console.log('ressources: '+$('#nb_ressources').val());
            }); 

            let nbsubstances = 0; 

            $('#add-substance').on('click', ()=>{
                nbsubstances++; 

                $('#form-group-substances').append('<div class="form-group" id="form-group-substance_'+nbsubstances+'"><select name="substance_'+nbsubstances+'" id="substance_'+nbsubstances+'" class="form-control">@forelse ($substances as $substance)<option value={{$substance->id}}>{{$substance->libelle}}</option>@empty<option></option>@endforelse</select><br><input type="number" name="conso_heure_substance_'+nbsubstances+'" id="conso_heure_substance_'+nbsubstances+'" class="form-control" placeholder="emission/heure" required></div><br>'); 


                if($('#delete-substance').length < 1){
                    $('#buttons-substances').append('<button type="button" class="p-2 m-2 btn btn-sm  btn-danger" id="delete-substance">supprimer une substance</button>');
                    $('#delete-substance').on('click', ()=>{
                        $('#form-group-substance_'+nbsubstances).remove();
                        nbsubstances--;
                        // $('#nb_substances').val(nbsubstances);
                        if (nbsubstances < 1) {
                            $('#delete-substance').remove(); 
                        }
                    });
                }
                $('#nb_substances').val(nbsubstances); 
                console.log('substances: '+$('#nb_substances').val());
            }); 
        }); 
    </script>
@endsection