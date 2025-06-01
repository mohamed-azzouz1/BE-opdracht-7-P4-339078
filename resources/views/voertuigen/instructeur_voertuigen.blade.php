@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Door instructeur gebruikte voertuigen - {{ $instructeur->Voornaam }} {{ $instructeur->Tussenvoegsel }} {{ $instructeur->Achternaam }}
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Type Voertuig</th>
                                <th>Type</th>
                                <th>Kenteken</th>
                                <th>Bouwjaar</th>
                                <th>Brandstof</th>
                                <th>Rijbewijscategorie</th>
                                <th>Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($voertuigen as $voertuig)
                            <tr>
                                <td>{{ $voertuig->TypeVoertuig }}</td>
                                <td>{{ $voertuig->Type }}</td>
                                <td>{{ $voertuig->Kenteken }}</td>
                                <td>{{ \Carbon\Carbon::parse($voertuig->Bouwjaar)->format('d-m-Y') }}</td>
                                <td>{{ $voertuig->Brandstof }}</td>
                                <td>{{ $voertuig->Rijbewijscategorie }}</td>
                                <td>
                                    <a href="{{ route('voertuigen.edit', $voertuig->id) }}" class="btn btn-sm btn-primary">Wijzigen</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="mt-3">
                        <a href="{{ route('instructeurs.index') }}" class="btn btn-secondary">Terug naar instructeurs</a>
                        <a href="{{ route('voertuigen.available', $instructeur->id) }}" class="btn btn-primary">Toevoegen Voertuig</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
