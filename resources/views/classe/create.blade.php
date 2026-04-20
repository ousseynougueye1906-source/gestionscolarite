@extends('layouts.app')

@section('title', 'Gestion des classes')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des classes</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createClasseModal">
        <i class="fas fa-plus"></i> Créer une classe
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

<!-- Liste des classes -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Liste des classes</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Nom de la classe</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classes as $classe)
                    <tr>
                        <td>{{ $classe->id_classe }}</td>
                        <td><span class="badge bg-info">{{ $classe->code_classe }}</span></td>
                        <td>{{ $classe->nom_classe }}</td>
                        <td>
                            <a href="{{ url('/classe/edit/' . $classe->id_classe) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <form action="{{ url('/classe/destroy/' . $classe->id_classe) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Voulez-vous vraiment supprimer cette classe ?')">
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
                            <i class="fas fa-inbox"></i> Aucune classe trouvée
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de création -->
<div class="modal fade" id="createClasseModal" tabindex="-1" aria-labelledby="createClasseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ url('/classe/store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createClasseModalLabel">
                        <i class="fas fa-plus-circle"></i> Créer une classe
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="code_classe" class="form-label">
                            Code classe <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="code_classe" 
                               id="code_classe" 
                               class="form-control @error('code_classe') is-invalid @enderror" 
                               value="{{ old('code_classe') }}"
                               placeholder=""
                               required>
                        @error('code_classe')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nom_classe" class="form-label">
                            Nom de la classe <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="nom_classe" 
                               id="nom_classe" 
                               class="form-control @error('nom_classe') is-invalid @enderror" 
                               value="{{ old('nom_classe') }}"
                               placeholder=""
                               required>
                        @error('nom_classe')
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
        var myModal = new bootstrap.Modal(document.getElementById('createClasseModal'));
        myModal.show();
    @endif
</script>
@endpush