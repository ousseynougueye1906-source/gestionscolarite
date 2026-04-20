@extends('layouts.app')

@section('title', 'Gestion des catégories de niveau')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des catégories de niveau</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategorieModal">
        <i class="fas fa-plus"></i> Créer une catégorie
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

<!-- Liste des catégories -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Liste des catégories de niveau</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom de la catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $categorie)
                    <tr>
                        <td>{{ $categorie->id_categorieNiveau }}</td>
                        <td>{{ $categorie->nom_categorieNiveau }}</td>
                        <td>
                            <a href="{{ url('/categorie-niveau/edit/' . $categorie->id_categorieNiveau) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <form action="{{ url('/categorie-niveau/destroy/' . $categorie->id_categorieNiveau) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')">
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
                        <td colspan="3" class="text-center">Aucune catégorie trouvée</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de création -->
<div class="modal fade" id="createCategorieModal" tabindex="-1" aria-labelledby="createCategorieModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ url('/categorie-niveau/store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategorieModalLabel">
                        <i class="fas fa-plus-circle"></i> Créer une catégorie de niveau
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nom_categorieNiveau" class="form-label">Nom de la catégorie <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="nom_categorieNiveau" 
                               id="nom_categorieNiveau" 
                               class="form-control @error('nom_categorieNiveau') is-invalid @enderror" 
                               value="{{ old('nom_categorieNiveau') }}"
                               placeholder="Ex: licence, master..."
                               required>
                        @error('nom_categorieNiveau')
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
        var myModal = new bootstrap.Modal(document.getElementById('createCategorieModal'));
        myModal.show();
    @endif
</script>
@endpush