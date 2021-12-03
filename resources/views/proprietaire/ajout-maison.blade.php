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
                    <form action="{{route('proprietaire.ajout-maison')}}" method="post">
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input list="adresses-list" id="adresse" name="adresse" class="form-control" autocomplete="off" />
                            <datalist id="adresses-list">
                            </datalist>
                        </div>

                        <div class="form-group">
                            <label for="num_rue">N° rue</label>
                            <input type="number" name="num_rue" class="form-control" id="num_rue" disabled>
                        </div>

                        <div class="form-group">
                            <label for="rue">Rue</label>
                            <input type="text" name="rue" class="form-control" id="rue" disabled>
                        </div>

                        <div class="form-group">
                            <label for="code_postal">Code Postal</label>
                            <input type="number" name="code_postal" class="form-control" id="code_postal" disabled>
                        </div>

                        <div class="form-group">
                            <label for="ville">Ville</label>
                            <input type="text" name="ville" class="form-control" id="ville" disabled>
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