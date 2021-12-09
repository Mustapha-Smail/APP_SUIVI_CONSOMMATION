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
                    <h4>Ajouter une maison</h4>
                    <form action="{{route('proprietaire.ajout-maison')}}" method="post">
                        @csrf
                        <div class="card-group d-block">
                            <div class="card">
                                <div class="card-header">
                                    Header
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nom">Nom maison</label>
                                        <input type="text" name="nom" id="nom" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="adresse">Adresse</label>
                                        <input list="adresses-list" id="adresse" name="adresse" class="form-control" autocomplete="off" />
                                        <datalist id="adresses-list">
                                        </datalist>
                                    </div>

                                    <div class="form-group">
                                        <label for="num_rue">N° rue</label>
                                        <input type="number" name="num_rue" class="form-control" id="num_rue" readonly required>
                                    </div>

                                    <div class="form-group">
                                        <label for="rue">Rue</label>
                                        <input type="text" name="rue" class="form-control" id="rue" readonly required>
                                    </div>

                                    <div class="form-group">
                                        <label for="code_postal">Code Postal</label>
                                        <input type="number" name="code_postal" class="form-control" id="code_postal" readonly required>
                                    </div>

                                    <div class="form-group">
                                        <label for="ville">Ville</label>
                                        <input type="text" name="ville" class="form-control" id="ville" readonly required>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="fixe">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Adresse fixe</label>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Header
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                      <label for="debut_possession">Date de début de possession</label>
                                      <input type="date" name="debut_possession" id="debut_possession" class="form-control"  required>
                                    </div>
                                    
                                    <div class="form-group">
                                      <label for="fin_possession">Date de fin de possession</label>
                                      <input type="date" name="fin_possession" id="fin_possession" class="form-control"  required>
                                    </div>

                                    <div class="form-group">
                                      <label for="nombre_habitants">Nombre d'habitants</label>
                                      <input type="number" name="nombre_habitants" id="nombre_habitants" class="form-control"  required>
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
                                        <label for="degres_isolation">Degrès d'isolation</label>
                                        <select name="degres_isolation" id="degres_isolation" class="form-control">
                                            @forelse ($degres_isolation as $isolation)
                                                <option value={{$isolation->id}}>{{$isolation->libelle}}</option>
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

                                    <div class="form-group">
                                        <label for="status_ecologique">Status ecologique</label>
                                        <select name="status_ecologique" id="status_ecologique" class="form-control">
                                            @forelse ($status_ecologique as $status)
                                                <option value={{$status->id}}>{{$status->libelle}}</option>
                                            @empty
                                                <option></option>
                                            @endforelse
                                        </select>
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
            <footer class="text-center">
                <small>&copy; 2021 - Le trio</small>
            </footer>
        </div>
    </div>

@endsection
@section('js')
    
    <script>
        $(document).ready(function(){

            let api_url = "https://api-adresse.data.gouv.fr/search/?q="
            let autocomplete = "&type=housenumber&autocomplete=1"
            
            let adresse = $('#adresse');

            $(adresse).on('input', function(){
                let code = $(this).val();
                let url = api_url + code + autocomplete; 

                // console.log(url); 
                fetch(url, {method: 'get'}).then(response => response.json()).then(results => {
                    let adresses = results.features;
                    // console.log(typeof adresses);
                    
                    Array.from(adresses).forEach(adresse => {
                        // console.log(adresse.properties.label);

                        let label = adresse.properties.label; 
                        $('#adresses-list').append('<option value="'+label+'">'+label+'</option>'); 

                    });

                }).catch(err => {
                    console.log(err);
                });
            }); 

            $("input[name=adresse]").focusout(function(){
                if ($(this).val()) {

                    // let adresse = $(this).val(); 

                    let adresse = $(this).val().split(' '); 

                    let num_rue = parseInt(adresse[0]);  
                    let rue = ""; 
                    for (let index = 1; index < adresse.length - 2; index++) {
                        rue = rue + adresse[index] + " ";    
                    }

                    let code_postal = parseInt(adresse[adresse.length - 2]); 
                    // console.log(parseInt(adresse[adresse.length - 2]));
                    let ville = adresse[adresse.length - 1]; 
                    
                    $('#num_rue').val(num_rue); 
                    $('#rue').val(rue); 
                    $('#code_postal').val(code_postal); 
                    $('#ville').val(ville); 

                }


            });

            
        });
    </script>

@endsection