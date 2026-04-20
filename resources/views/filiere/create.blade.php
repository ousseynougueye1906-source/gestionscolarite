@extends('layouts.app')

@section('title', 'Gestion des filières')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des filières</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createFiliereModal">
        <i class="fas fa-plus"></i> Créer une filière
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

<!-- Liste des filières -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Liste des filières</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Nom de la filière</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($filieres as $filiere)
                    <tr>
                        <td>{{ $filiere->id_filiere }}</td>
                        <td><span class="badge bg-primary">{{ $filiere->code }}</span></td>
                        <td>{{ $filiere->nom_filiere }}</td>
                        <td>
                            <a href="{{ url('/filiere/edit/' . $filiere->id_filiere) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <form action="{{ url('/filiere/destroy/' . $filiere->id_filiere) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Voulez-vous vraiment supprimer cette filière ?')">
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
                            <i class="fas fa-inbox"></i> Aucune filière trouvée
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de création -->
<div class="modal fade" id="createFiliereModal" tabindex="-1" aria-labelledby="createFiliereModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ url('/filiere/store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createFiliereModalLabel">
                        <i class="fas fa-plus-circle"></i> Créer une filière
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="code" class="form-label">
                            Code filière <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="code" 
                               id="code" 
                               class="form-control @error('code') is-invalid @enderror" 
                               value="{{ old('code') }}"
                               placeholder=""
                               required>
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nom_filiere" class="form-label">
                            Nom de la filière <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="nom_filiere" 
                               id="nom_filiere" 
                               class="form-control @error('nom_filiere') is-invalid @enderror" 
                               value="{{ old('nom_filiere') }}"
                               placeholder=""
                               required>
                        @error('nom_filiere')
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
        var myModal = new bootstrap.Modal(document.getElementById('createFiliereModal'));
        myModal.show();
    @endif
</script>
@endpush