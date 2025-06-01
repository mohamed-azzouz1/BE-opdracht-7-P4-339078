@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Wijzigen voertuiggegevens</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('voertuigen.update', $voertuig->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Hidden field to store original instructor ID for redirect -->
                        <input type="hidden" name="OriginalInstructeurId" value="{{ $originalInstructeurId }}">

                        <div class="form-group row mb-3">
                            <label for="Kenteken" class="col-md-4 col-form-label text-md-right">Kenteken</label>
                            <div class="col-md-6">
                                <input id="Kenteken" type="text" class="form-control @error('Kenteken') is-invalid @enderror" name="Kenteken" value="{{ old('Kenteken', $voertuig->Kenteken) }}" required>
                                @error('Kenteken')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="Type" class="col-md-4 col-form-label text-md-right">Type</label>
                            <div class="col-md-6">
                                <input id="Type" type="text" class="form-control @error('Type') is-invalid @enderror" name="Type" value="{{ old('Type', $voertuig->Type) }}" required>
                                @error('Type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="Bouwjaar" class="col-md-4 col-form-label text-md-right">Bouwjaar</label>
                            <div class="col-md-6">
                                <input id="Bouwjaar" type="date" class="form-control @error('Bouwjaar') is-invalid @enderror" name="Bouwjaar" value="{{ old('Bouwjaar', $voertuig->Bouwjaar) }}" required>
                                @error('Bouwjaar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="Brandstof" class="col-md-4 col-form-label text-md-right">Brandstof</label>
                            <div class="col-md-6">
                                <select id="Brandstof" class="form-control @error('Brandstof') is-invalid @enderror" name="Brandstof" required>
                                    <option value="Benzine" {{ (old('Brandstof', $voertuig->Brandstof) == 'Benzine') ? 'selected' : '' }}>Benzine</option>
                                    <option value="Diesel" {{ (old('Brandstof', $voertuig->Brandstof) == 'Diesel') ? 'selected' : '' }}>Diesel</option>
                                    <option value="Elektrisch" {{ (old('Brandstof', $voertuig->Brandstof) == 'Elektrisch') ? 'selected' : '' }}>Elektrisch</option>
                                </select>
                                @error('Brandstof')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="TypeVoertuigId" class="col-md-4 col-form-label text-md-right">Type Voertuig</label>
                            <div class="col-md-6">
                                <select id="TypeVoertuigId" class="form-control @error('TypeVoertuigId') is-invalid @enderror" name="TypeVoertuigId" required>
                                    @foreach($typeVoertuigen as $typeVoertuig)
                                        <option value="{{ $typeVoertuig->id }}" {{ (old('TypeVoertuigId', $voertuig->TypeVoertuigId) == $typeVoertuig->id) ? 'selected' : '' }}>
                                            {{ $typeVoertuig->TypeVoertuig }} ({{ $typeVoertuig->Rijbewijscategorie }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('TypeVoertuigId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="InstructeurId" class="col-md-4 col-form-label text-md-right">Instructeur</label>
                            <div class="col-md-6">
                                <select id="InstructeurId" class="form-control @error('InstructeurId') is-invalid @enderror" name="InstructeurId" required>
                                    @foreach($instructeurs as $instructeur)
                                        <option value="{{ $instructeur->id }}" {{ (old('InstructeurId', $currentInstructeurId) == $instructeur->id) ? 'selected' : '' }}>
                                            {{ $instructeur->Voornaam }} {{ $instructeur->Tussenvoegsel ? $instructeur->Tussenvoegsel . ' ' : '' }}{{ $instructeur->Achternaam }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('InstructeurId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Wijzig
                                </button>
                                <a href="{{ route('instructeur.voertuigen', $originalInstructeurId) }}" class="btn btn-secondary">
                                    Annuleren
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
