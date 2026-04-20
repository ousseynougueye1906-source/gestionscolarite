@extends('layouts.app')

@section('title', 'Modifier un niveau')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-edit"></i> Modifier le niveau
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

                    <form method="POST" action="{{ url('/niveaux/update/' . $niveau->id_niveaux) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nom_niveaux" class="form-label">
                                Nom du niveau <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="nom_niveaux" 
                                   id="nom_niveaux" 
                                   class="form-control @error('nom_niveaux') is-invalid @enderror" 
                                   value="{{ old('nom_niveaux', $niveau->nom_niveaux) }}"
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
                                        {{ old('id_categorieNiveau', $niveau->id_categorieNiveau) == $categorie->id_categorieNiveau ? 'selected' : '' }}>
                                        {{ $categorie->nom_categorieNiveau }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_categorieNiveau')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ url('/niveaux/create') }}" class="btn btn-secondary">
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