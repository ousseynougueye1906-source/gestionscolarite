@extends('layouts.app')

@section('title', 'Gestion des Tarifs-Classes')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des Tarifs-Classes</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTarifClasseModal">
        <i class="fas fa-plus"></i> Créer un Tarif-Classe
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
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

<!-- Liste des Tarifs-Classes -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Liste des Tarifs-Classes</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Classe</th>
                        <th>Inscription</th>
                        <th>Mensualité</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tarifClasses as $tc)
                        <tr>
                            <td>{{ $tc->id }}</td>
                            <td>
                                <i class="fas fa-chalkboard text-primary"></i>
                                <strong>{{ $tc->classe->nom_classe ?? 'N/A' }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ number_format($tc->tarif->inscription ?? 0, 0, ',', ' ') }} FCFA
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    {{ number_format($tc->tarif->mensualite ?? 0, 0, ',', ' ') }} FCFA
                                </span>
                            </td>
                            <td>
                                @if($tc->statut)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle"></i> Actif
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times-circle"></i> Inactif
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('/tarif-classe/edit/' . $tc->id) }}" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form action="{{ url('/tarif-classe/destroy/' . $tc->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Voulez-vous vraiment supprimer cette association ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                <i class="fas fa-inbox"></i> Aucun tarif-classe trouvé
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de création -->
<div class="modal fade" id="createTarifClasseModal" tabindex="-1" aria-labelledby="createTarifClasseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ url('/tarif-classe/store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createTarifClasseModalLabel">
                        <i class="fas fa-plus-circle"></i> Créer un Tarif-Classe
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                                    {{ old('id_classe') == $classe->id_classe ? 'selected' : '' }}>
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
                                    {{ old('id_tarif') == $tarif->id_tarif ? 'selected' : '' }}>
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
                            <option value="1" {{ old('statut', 1) == 1 ? 'selected' : '' }}>
                                <i class="fas fa-check"></i> Actif
                            </option>
                            <option value="0" {{ old('statut') == 0 ? 'selected' : '' }}>
                                <i class="fas fa-times"></i> Inactif
                            </option>
                        </select>
                        @error('statut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-info mb-0">
                        <i class="fas fa-info-circle"></i> 
                        <small>Associez un tarif à une classe spécifique</small>
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
        var myModal = new bootstrap.Modal(document.getElementById('createTarifClasseModal'));
        myModal.show();
    @endif
</script>
@endpush