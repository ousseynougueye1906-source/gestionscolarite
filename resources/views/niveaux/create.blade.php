@extends('layouts.app')

@section('title', 'Gestion des niveaux')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des niveaux</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createNiveauModal">
        <i class="fas fa-plus"></i> Créer un niveau
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

<!-- Liste des niveaux -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Liste des niveaux</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom du niveau</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($niveaux as $niveau)
                    <tr>
                        <td>{{ $niveau->id_niveaux }}</td>
                        <td>{{ $niveau->nom_niveaux }}</td>
                        <td>
                            @if($niveau->categorieNiveau)
                                <span class="badge bg-success">
                                    {{ $niveau->categorieNiveau->nom_categorieNiveau }}
                                </span>
                            @else
                                <span class="badge bg-secondary">N/A</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('/niveaux/edit/' . $niveau->id_niveaux) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <form action="{{ url('/niveaux/destroy/' . $niveau->id_niveaux) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Voulez-vous vraiment supprimer ce niveau ?')">
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
                        <td colspan="4" class="text-center text-muted">
                            <i class="fas fa-inbox"></i> Aucun niveau trouvé
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de création -->
<div class="modal fade" id="createNiveauModal" tabindex="-1" aria-labelledby="createNiveauModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ url('/niveaux/store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createNiveauModalLabel">
                        <i class="fas fa-plus-circle"></i> Créer un niveau
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nom_niveaux" class="form-label">
                            Nom du niveau <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="nom_niveaux" 
                               id="nom_niveaux" 
                               class="form-control @error('nom_niveaux') is-invalid @enderror" 
                               value="{{ old('nom_niveaux') }}"
                               placeholder="Ex: 6ème, 5ème, Terminale..."
                               required>
                        @error('nom_niveaux')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_categorieNiveau" class="form-label">
                            Catégorie de niveau <span class="text-danger">*</span>
                        </label>
                        <select name="id_categorieNiveau" 
                                id="id_categorieNiveau" 
                                class="form-select @error('id_categorieNiveau') is-invalid @enderror"
                                required>
                            <option value="">-- Choisir une catégorie --</option>
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id_categorieNiveau }}" 
                                    {{ old('id_categorieNiveau') == $categorie->id_categorieNiveau ? 'selected' : '' }}>
                                    {{ $categorie->nom_categorieNiveau }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_categorieNiveau')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
        var myModal = new bootstrap.Modal(document.getElementById('createNiveauModal'));
        myModal.show();
    @endif
</script>
@endpush