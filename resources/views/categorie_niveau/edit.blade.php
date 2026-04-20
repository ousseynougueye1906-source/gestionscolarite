@extends('layouts.app')

@section('title', 'Modifier une catégorie de niveau')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-edit"></i> Modifier la catégorie de niveau
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

                    <form method="POST" action="{{ url('/categorie-niveau/update/' . $categorie->id_categorieNiveau) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nom_categorieNiveau" class="form-label">
                                Nom de la catégorie <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="nom_categorieNiveau" 
                                   id="nom_categorieNiveau" 
                                   class="form-control @error('nom_categorieNiveau') is-invalid @enderror" 
                                   value="{{ old('nom_categorieNiveau', $categorie->nom_categorieNiveau) }}"
                                   required>
                            @error('nom_categorieNiveau')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ url('/categorie-niveau/create') }}" class="btn btn-secondary">
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