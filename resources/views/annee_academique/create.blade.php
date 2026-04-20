@extends('layouts.app')

@section('title', 'Gestion des Années Académiques')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des Années Académiques</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAnneeModal">
        <i class="fas fa-plus"></i> Créer une année académique
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Liste des années académiques -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Liste des années académiques</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Libellé</th>
                        <th>Période</th>
                        <th>Inscriptions</th>
                        <th>École</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($annees as $annee)
                        <tr class="{{ $annee->estCloture() ? 'table-secondary' : '' }}">
                            <td>{{ $annee->id_annee }}</td>
                            <td><strong>{{ $annee->libelle }}</strong></td>
                            <td>
                                <small>
                                    <i class="fas fa-calendar"></i> 
                                    {{ $annee->date_debut->format('d/m/Y') }} 
                                    <i class="fas fa-arrow-right"></i> 
                                    {{ $annee->date_fin->format('d/m/Y') }}
                                </small>
                            </td>
                            <td>
                                @if($annee->date_ouverture_inscription)
                                    <small>
                                        <i class="fas fa-door-open text-success"></i> 
                                        {{ $annee->date_ouverture_inscription->format('d/m/Y') }}
                                        <br>
                                        <i class="fas fa-door-closed text-danger"></i> 
                                        {{ $annee->date_fermeture_inscription ? $annee->date_fermeture_inscription->format('d/m/Y') : 'N/A' }}
                                    </small>
                                @else
                                    <span class="text-muted">Non défini</span>
                                @endif
                            </td>
                            <td>
                                @if($annee->date_ouverture_ecole)
                                    <small>
                                        <i class="fas fa-school"></i> 
                                        {{ $annee->date_ouverture_ecole->format('d/m/Y') }}
                                        <br>
                                        <i class="fas fa-lock"></i> 
                                        {{ $annee->date_fermeture_classe ? $annee->date_fermeture_classe->format('d/m/Y') : 'N/A' }}
                                    </small>
                                @else
                                    <span class="text-muted">Non défini</span>
                                @endif
                            </td>
                            <td>{!! $annee->getBadgeStatut() !!}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- Boutons de changement de statut -->
                                    @if($annee->peutPublier())
                                        <form action="{{ url('/annee-academique/publier/' . $annee->id_annee) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Publier cette année académique ? Le statut ne pourra plus être modifié.')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary" title="Publier">
                                                <i class="fas fa-paper-plane"></i> Publier
                                            </button>
                                        </form>
                                    @endif

                                    @if($annee->peutOuvrirInscriptions())
                                        <form action="{{ url('/annee-academique/ouvrir-inscriptions/' . $annee->id_annee) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Ouvrir les inscriptions ?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Ouvrir inscriptions">
                                                <i class="fas fa-door-open"></i> Ouvrir Inscr.
                                            </button>
                                        </form>
                                    @endif

                                    @if($annee->peutFermerInscriptions())
                                        <form action="{{ url('/annee-academique/fermer-inscriptions/' . $annee->id_annee) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Fermer les inscriptions ?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning" title="Fermer inscriptions">
                                                <i class="fas fa-door-closed"></i> Fermer Inscr.
                                            </button>
                                        </form>
                                    @endif

                                    @if($annee->peutCloturer())
                                        <form action="{{ url('/annee-academique/cloturer/' . $annee->id_annee) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Clôturer cette année ? Cette action est IRRÉVERSIBLE et mettra l\'année en lecture seule.')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" title="Clôturer">
                                                <i class="fas fa-lock"></i> Clôturer
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Bouton modifier (uniquement si non clôturé) -->
                                    @if(!$annee->estCloture())
                                        <a href="{{ url('/annee-academique/edit/' . $annee->id_annee) }}" 
                                           class="btn btn-sm btn-info" 
                                           title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    <!-- Bouton supprimer (uniquement si brouillon) -->
                                    @if($annee->estBrouillon())
                                        <form action="{{ url('/annee-academique/destroy/' . $annee->id_annee) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Voulez-vous vraiment supprimer cette année ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif

                                    @if($annee->estCloture())
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-lock"></i> Lecture seule
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                <i class="fas fa-inbox"></i> Aucune année académique trouvée
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de création -->
<div class="modal fade" id="createAnneeModal" tabindex="-1" aria-labelledby="createAnneeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ url('/annee-academique/store') }}">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="createAnneeModalLabel">
                        <i class="fas fa-plus-circle"></i> Créer une année académique
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="libelle" class="form-label">
                                <i class="fas fa-tag"></i> Libellé <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="libelle" 
                                   id="libelle" 
                                   class="form-control @error('libelle') is-invalid @enderror" 
                                   value="{{ old('libelle') }}"
                                   placeholder="Ex: 2024-2025"
                                   required>
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
                                   value="{{ old('date_debut') }}"
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
                                   value="{{ old('date_fin') }}"
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
                                   value="{{ old('date_ouverture_inscription') }}">
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
                                   value="{{ old('date_fermeture_inscription') }}">
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
                                   value="{{ old('date_ouverture_ecole') }}">
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
                                   value="{{ old('date_fermeture_classe') }}">
                            @error('date_fermeture_classe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="alert alert-info mb-0">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Règles de validation :</strong>
                        <ul class="mb-0 mt-2">
                            <li>Date de fin > Date de début</li>
                            <li>Ouverture inscription : 1 mois minimum avant ouverture école</li>
                            <li>Fermeture inscription : après ouverture école</li>
                            <li>Fermeture classe : après ouverture école</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Réouvrir le modal en cas d'erreur de validation
    @if($errors->any())
        var myModal = new bootstrap.Modal(document.getElementById('createAnneeModal'));
        myModal.show();
    @endif
</script>
@endpush