@extends('layouts.app')

@section('title', 'Modifier une année académique')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-edit"></i> Modifier l'année académique
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

                    <form method="POST" action="{{ url('/annee-academique/update/' . $annee->id_annee) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="libelle" class="form-label">
                                    <i class="fas fa-tag"></i> Libellé <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="libelle" 
                                       id="libelle" 
                                       class="form-control @error('libelle') is-invalid @enderror" 
                                       value="{{ old('libelle', $annee->libelle) }}"
                                       required
                                       {{ !$annee->estBrouillon() ? 'readonly' : '' }}>
                                @error('libelle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="date_debut" class="form-label">
                                    <i class="fas fa-calendar-alt"></i> Date de début <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       name="date_debut" 
                                       id="date_debut" 
                                       class="form-control @error('date_debut') is-invalid @enderror" 
                                       value="{{ old('date_debut', $annee->date_debut->format('Y-m-d')) }}"
                                       required>
                                @error('date_debut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="date_fin" class="form-label">
                                    <i class="fas fa-calendar-check"></i> Date de fin <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       name="date_fin" 
                                       id="date_fin" 
                                       class="form-control @error('date_fin') is-invalid @enderror" 
                                       value="{{ old('date_fin', $annee->date_fin->format('Y-m-d')) }}"
                                       required>
                                @error('date_fin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <h6 class="text-primary"><i class="fas fa-user-plus"></i> Période d'inscription</h6>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_ouverture_inscription" class="form-label">
                                    <i class="fas fa-door-open"></i> Ouverture inscription
                                </label>
                                <input type="date" 
                                       name="date_ouverture_inscription" 
                                       id="date_ouverture_inscription" 
                                       class="form-control @error('date_ouverture_inscription') is-invalid @enderror" 
                                       value="{{ old('date_ouverture_inscription', $annee->date_ouverture_inscription ? $annee->date_ouverture_inscription->format('Y-m-d') : '') }}">
                                @error('date_ouverture_inscription')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Doit être au moins 1 mois avant l'ouverture de l'école</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="date_fermeture_inscription" class="form-label">
                                    <i class="fas fa-door-closed"></i> Fermeture inscription
                                </label>
                                <input type="date" 
                                       name="date_fermeture_inscription" 
                                       id="date_fermeture_inscription" 
                                       class="form-control @error('date_fermeture_inscription') is-invalid @enderror" 
                                       value="{{ old('date_fermeture_inscription', $annee->date_fermeture_inscription ? $annee->date_fermeture_inscription->format('Y-m-d') : '') }}">
                                @error('date_fermeture_inscription')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Doit être après l'ouverture de l'école</small>
                            </div>
                        </div>

                        <hr>
                        <h6 class="text-success"><i class="fas fa-school"></i> Période scolaire</h6>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_ouverture_ecole" class="form-label">
                                    <i class="fas fa-school"></i> Ouverture école
                                </label>
                                <input type="date" 
                                       name="date_ouverture_ecole" 
                                       id="date_ouverture_ecole" 
                                       class="form-control @error('date_ouverture_ecole') is-invalid @enderror" 
                                       value="{{ old('date_ouverture_ecole', $annee->date_ouverture_ecole ? $annee->date_ouverture_ecole->format('Y-m-d') : '') }}">
                                @error('date_ouverture_ecole')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="date_fermeture_classe" class="form-label">
                                    <i class="fas fa-lock"></i> Fermeture classe
                                </label>
                                <input type="date" 
                                       name="date_fermeture_classe" 
                                       id="date_fermeture_classe" 
                                       class="form-control @error('date_fermeture_classe') is-invalid @enderror" 
                                       value="{{ old('date_fermeture_classe', $annee->date_fermeture_classe ? $annee->date_fermeture_classe->format('Y-m-d') : '') }}">
                                @error('date_fermeture_classe')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> 
                            <strong>Statut actuel : </strong> {!! $annee->getBadgeStatut() !!}
                            @if(!$annee->estBrouillon())
                                <br><small>Le statut ne peut plus être modifié après publication.</small>
                            @endif
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ url('/annee-academique/create') }}" class="btn btn-secondary">
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