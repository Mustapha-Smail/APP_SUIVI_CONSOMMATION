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
                        <div class="col-4 pr-3">
                            <a href="{{route('proprietaire.ajout-maison')}}" class="btn btn-lg btn-primary float-right">Ajouter une maison</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    @forelse ($maisons as $maison)
                        <div class="card w-100 shadow">
                        <div class="card-header">
                            {{$maison->nom}}
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <h6>{{$maison->num_rue}}, {{$maison->nom_rue}}</h6>
                                <p>{{$maison->nom_ville}}, {{$maison->code_postal}}</p>
                            </div>
                            <p class="card-text">
                                Depuis, {{ Carbon\Carbon::parse($maison->debut_possession)->format('Y-m-d') }}
                            </p>
                            <p class="card-text">
                                Degrès d'isolation: {{
                                    App\Models\Isolation::find($maison->isolation_id)->libelle
                                }}
                            </p>
                            <p class="card-text">
                                Status écologique: {{
                                    App\Models\Statusecologique::find($maison->statusecologique_id)->libelle
                                }}
                            </p>
                            <a href="{{route('proprietaire.appartements', [$maison->id])}}" class="btn btn-primary float-right">
                                <span class="material-icons">
                                    forward
                                </span>
                            </a>
                        </div>
                    </div><br>
                    @empty
                        <center>
                        <a href="{{route('proprietaire.ajout-maison')}}" class="btn btn-lg btn-success">Ajouter une maison</a>
                        </center>
                    @endforelse
                </div>
                <div class="col-sm-3">
                    <div class="card w-100 shadow">
                        <div class="card-header">
                            Right Side
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">
                                With supporting text below as a natural lead-in to additional content..
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt a, unde aspernatur assumenda dicta ad quod repudiandae, explicabo dolorum minus libero molestias ipsam cupiditate omnis porro modi delectus. Voluptates, suscipit.
                                Commodi nobis, eligendi fugiat ad perferendis officia sed corrupti atque impedit deleniti culpa ut sequi asperiores nemo iure sapiente nesciunt quia aut id dolore corporis dolorem? At magni minima dolor!
                                Facere, officia harum beatae et maxime debitis eligendi expedita iure optio, molestias asperiores nemo magnam nam ea quasi ipsa quam, suscipit mollitia! Quidem, eligendi exercitationem itaque reiciendis praesentium corrupti iure!
                                Eos tempore aliquid officia dolor dolore facilis ipsum voluptatum ad beatae, sunt nulla recusandae mollitia excepturi, ex, explicabo sequi voluptate neque similique quisquam cum animi vitae quibusdam eaque nihil? Cumque?
                                Dolorum nisi odio cum unde reiciendis sunt architecto voluptates quisquam ipsa, provident placeat totam culpa illo, eveniet rem, maiores delectus? Assumenda corporis praesentium, rerum dolore ullam quae iure veritatis amet!
                            </p>
                            <a href="#" class="btn btn-primary float-right">Go somewhere</a>
                        </div>
                    </div> <br>
                </div>
            </div>
            <footer class="text-center">
                <small>&copy; 2021 - Le trio</small>
            </footer>
        </div>
    </div>

@endsection