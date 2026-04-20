@extends('layouts.app')

@section('title', 'Modifier une filière')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-edit"></i> Modifier la filière
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

                    <form method="POST" action="{{ url('/filiere/update/' . $filiere->id_filiere) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="code" class="form-label">
                                Code filière <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="code" 
                                   id="code" 
                                   class="form-control @error('code') is-invalid @enderror" 
                                   value="{{ old('code', $filiere->code) }}"
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
                                   value="{{ old('nom_filiere', $filiere->nom_filiere) }}"
                                   required>
                            @error('nom_filiere')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ url('/filiere/create') }}" class="btn btn-secondary">
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