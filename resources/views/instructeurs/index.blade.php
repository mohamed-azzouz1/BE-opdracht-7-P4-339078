@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Instructeurs in dienst</div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Naam</th>
                                <th>Datum in dienst</th>
                                <th>Aantal sterren</th>
                                <th>Voertuigen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instructeurs as $instructeur)
                            <tr>
                                <td>{{ $instructeur->Voornaam }} {{ $instructeur->Tussenvoegsel }} {{ $instructeur->Achternaam }}</td>
                                <td>{{ \Carbon\Carbon::parse($instructeur->DatumInDienst)->format('d-m-Y') }}</td>
                                <td>{{ $instructeur->AantalSterren }}</td>
                                <td>
                                    <a href="{{ route('instructeur.voertuigen', $instructeur->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-car"></i> Voertuigen
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
