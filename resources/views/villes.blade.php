@extends('layouts/app')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <th>Ville</th>
                <th>Code Postal</th>
                <th>Département</th>
                <th>Région</th>
            </thead>
            <tbody>
                 @forelse ($villes as $ville)
                <tr>
                    <td>
                        {{$ville->nom}}
                    </td>
                    <td>
                        {{$ville->code_postal}}
                    </td>
                    <td>
                        {{$ville->departement->nom}}
                    </td>
                    <td>
                        {{$ville->departement->region->nom}}
                    </td>
                </tr>
            @empty
            @endforelse
            </tbody>
        </table>
    </div>
@endsection