@extends('layouts.app')

@section('title', 'Gestion des tarifs')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des tarifs</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTarifModal">
        <i class="fas fa-plus"></i> Créer un tarif
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

<!-- Liste des tarifs -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Liste des tarifs</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Frais d'inscription</th>
                    <th>Mensualité</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tarifs as $tarif)
                    <tr>
                        <td>{{ $tarif->id_tarif }}</td>
                        <td>
                            <span class="badge bg-info text-dark">
                                {{ number_format($tarif->inscription, 0, ',', ' ') }} FCFA
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-warning text-dark">
                                {{ number_format($tarif->mensualite, 0, ',', ' ') }} FCFA
                            </span>
                        </td>
                        <td>
                            <a href="{{ url('/tarif/edit/' . $tarif->id_tarif) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <form action="{{ url('/tarif/destroy/' . $tarif->id_tarif) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Voulez-vous vraiment supprimer ce tarif ?')">
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
                            <i class="fas fa-inbox"></i> Aucun tarif trouvé
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de création -->
<div class="modal fade" id="createTarifModal" tabindex="-1" aria-labelledby="createTarifModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ url('/tarif/store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createTarifModalLabel">
                        <i class="fas fa-plus-circle"></i> Créer un tarif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="inscription" class="form-label">
                            <i class="fas fa-user-plus"></i> Frais d'inscription <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="number" 
                                   name="inscription" 
                                   id="inscription" 
                                   class="form-control @error('inscription') is-invalid @enderror" 
                                   value="{{ old('inscription') }}"
                                   placeholder="Ex: 50000"
                                   min="0"
                                   step="1"
                                   required>
                            <span class="input-group-text">FCFA</span>
                            @error('inscription')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mensualite" class="form-label">
                            <i class="fas fa-calendar-alt"></i> Mensualité <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="number" 
                                   name="mensualite" 
                                   id="mensualite" 
                                   class="form-control @error('mensualite') is-invalid @enderror" 
                                   value="{{ old('mensualite') }}"
                                   placeholder="Ex: 25000"
                                   min="0"
                                   step="1"
                                   required>
                            <span class="input-group-text">FCFA</span>
                            @error('mensualite')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="alert alert-info mb-0">
                        <i class="fas fa-info-circle"></i> 
                        <small>Les montants sont en Francs CFA (FCFA)</small>
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
        var myModal = new bootstrap.Modal(document.getElementById('createTarifModal'));
        myModal.show();
    @endif
</script>
@endpush