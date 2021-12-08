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
                <div class="col-sm-12 pb-3">
                    <div class="row justify-content-end">
                        @if (count($piece->appareils)>0)
                            <div class="col-4 pr-3">
                                <a href="{{route('locataire.ajout-appareil', [$piece->id])}}" class="btn btn-lg btn-primary float-right text-white">Ajouter un appareil</a>
                            </div>   
                        @endif
                    </div>
                </div>
                <div class="col-sm-9">
                    @forelse ($piece->appareils as $appareil)
                        {{-- 
                            Changer la card de appareil 
                            Rajouter la conso (button)
                        --}}
                        <div class="card w-100 shadow">
                            <div class="card-header">
                                {{$appareil->libelle}}
                            </div>
                            <div class="card-body">
                                <div class="card-title">
                                    <h6>{{$appareil->typeappareil->libelle}}</h6>
                                </div>
                                <p class="card-text">
                                    {{$appareil->description}}
                                </p>

                                <p class="card-text">
                                    {{-- {{$appareil->appareilmatieres}} --}}
                                    Ressources: <br>
                                    @forelse ($appareil->appareilmatieres as $appareilmatiere)
                                        @if ($appareilmatiere->matiere->ressource)
                                            {{$appareilmatiere->matiere->libelle}}<br>
                                        @endif    
                                    @empty
                                        -
                                    @endforelse
                                </p>
                                
                                <p class="card-text">
                                    {{-- {{$appareil->appareilmatieres}} --}}
                                    Substances: <br>
                                    @forelse ($appareil->appareilmatieres as $appareilmatiere)
                                    @if (! $appareilmatiere->matiere->ressource)
                                    {{$appareilmatiere->matiere->libelle}}<br>
                                    @endif    
                                    @empty
                                    -
                                    @endforelse
                                </p>
                                
                            </div>
                            <div class="card-footer">
                                @forelse ($appareil->appareilmatieres as $appareilmatiere)
                                    @if ($appareilmatiere->matiere->ressource)
                                        <form action="{{route('locataire.consommation')}}" method="POST" class="form-consommation">
                                            @csrf
                                            <input type="number" name="conso_heure" hidden value="{{$appareilmatiere->conso_emission_heure}}">
                                            <input type="text" name="appareil" hidden value="{{$appareil->id}}">
                                            <input type="text" name="ressource" hidden value="{{$appareilmatiere->matiere->id}}">
                                            <button type="submit" class="mx-2 consommation btn btn-primary float-right">
                                                consommer - {{$appareilmatiere->matiere->libelle}}
                                            </button>
                                        </form>
                                    @endif    
                                @empty
                                @endforelse
                                
                            </div>
                        </div><br>
                    @empty
                        <div class="col-sm-6 offset-sm-3 d-flex justify-content-center align-items-center">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text">
                                        Vous n'avez pas d'appreils :-(
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 offset-sm-4 d-flex justify-content-center align-items-center">
                            <a href="{{route('locataire.ajout-appareil', [Request::segment(2)])}}" class="btn btn-lg btn-success m-5">Ajouter des appreils</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        // console.log($('.consommation'));
        $('.form-consommation').on('submit', function (e) {
            // console.log($(this).entries());
            e.preventDefault();
            $.ajax({
                url: "{{route('locataire.consommation')}}",
                type: "POST",
                data: $(this).serialize(),
                success: function (data) {
                    alert("consommation d'une heure");
                },
                error: function (jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
            // console.log(url);
        });
    </script>
@endsection