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
                        {{$ville->name}}
                    </td>
                    <td>
                        {{$ville->code_postal}}
                    </td>
                    
                    @forelse ($ville->departement()->get() as $departement)
                        <td>
                            {{$departement->name}}
                        </td>
                        @forelse ($departement->region()->get() as $region)
                            <td>
                            {{$region->name}}
                            </td>
                        @empty
                        @endforelse
                    @empty
                    @endforelse
                
                </tr>
            @empty
            @endforelse
            </tbody>
        </table>
    </div>
@endsection