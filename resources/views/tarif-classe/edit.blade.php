@extends('layouts.app')

@section('title', 'Modifier un Tarif-Classe')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-edit"></i> Modifier le Tarif-Classe
                    </h5>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/tarif-classe/update/' . $tarifClasse->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="id_classe" class="form-label">
                                <i class="fas fa-chalkboard"></i> Classe <span class="text-danger">*</span>
                            </label>
                            <select name="id_classe" 
                                    id="id_classe" 
                                    class="form-select @error('id_classe') is-invalid @enderror"
                                    required>
                                <option value="">-- Sélectionner une classe --</option>
                                @foreach($classes as $classe)
                                    <option value="{{ $classe->id_classe }}"
                                        {{ old('id_classe', $tarifClasse->id_classe) == $classe->id_classe ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_classe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_tarif" class="form-label">
                                <i class="fas fa-dollar-sign"></i> Tarif <span class="text-danger">*</span>
                            </label>
                            <select name="id_tarif" 
                                    id="id_tarif" 
                                    class="form-select @error('id_tarif') is-invalid @enderror"
                                    required>
                                <option value="">-- Sélectionner un tarif --</option>
                                @foreach($tarifs as $tarif)
                                    <option value="{{ $tarif->id_tarif }}"
                                        {{ old('id_tarif', $tarifClasse->id_tarif) == $tarif->id_tarif ? 'selected' : '' }}>
                                        Inscription: {{ number_format($tarif->inscription, 0, ',', ' ') }} FCFA - 
                                        Mensualité: {{ number_format($tarif->mensualite, 0, ',', ' ') }} FCFA
                                    </option>
                                @endforeach
                            </select>
                            @error('id_tarif')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="statut" class="form-label">
                                <i class="fas fa-toggle-on"></i> Statut <span class="text-danger">*</span>
                            </label>
                            <select name="statut" 
                                    id="statut" 
                                    class="form-select @error('statut') is-invalid @enderror"
                                    required>
                                <option value="1" {{ old('statut', $tarifClasse->statut) == 1 ? 'selected' : '' }}>
                                    Actif
                                </option>
                                <option value="0" {{ old('statut', $tarifClasse->statut) == 0 ? 'selected' : '' }}>
                                    Inactif
                                </option>
                            </select>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            <small>Modifiez l'association entre un tarif et une classe</small>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ url('/tarif-classe/create') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Modifier
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection