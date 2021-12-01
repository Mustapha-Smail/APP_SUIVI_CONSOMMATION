@extends('layouts/dashboard-app')

@section('content')
    
    <div class="container">
        <div class="container-body">
            <div class="row">
                <div class="col-sm-9">
                    @forelse ($appartements as $appartement)
                        <div class="card w-100 shadow">
                        <div class="card-header">
                            {{$appartement->num_boite}}
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <h6>{{$appartement->typeappartement->libelle}}</h6>
                                <p>{{$appartement->nombre_habitants}} habitants</p>
                            </div>
                            <p class="card-text">
                                Depuis, {{ Carbon\Carbon::parse($appartement->created_at)->format('Y-m-d') }}
                                {{$appartement->securite->libelle}}
                            </p>
                            <a href="#" class="btn btn-primary float-right">
                                <span>
                                    Consommation 
                                </span>
                                <span class="material-icons">
                                    forward
                                </span>
                            </a>
                        </div>
                    </div><br>
                    @empty
                        <center>
                        <button class="btn btn-lg btn-success">Ajouter un appartement</button>
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