@extends('layouts.app')

@section('title', 'Modifier une classe')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-edit"></i> Modifier la classe
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

                    <form method="POST" action="{{ url('/classe/update/' . $classe->id_classe) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="code_classe" class="form-label">
                                Code classe <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="code_classe" 
                                   id="code_classe" 
                                   class="form-control @error('code_classe') is-invalid @enderror" 
                                   value="{{ old('code_classe', $classe->code_classe) }}"
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
                                   value="{{ old('nom_classe', $classe->nom_classe) }}"
                                   required>
                            @error('nom_classe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ url('/classe/create') }}" class="btn btn-secondary">
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