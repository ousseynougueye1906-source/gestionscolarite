@extends('layouts.app')

@section('title', 'Modifier un tarif')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-edit"></i> Modifier le tarif
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

                    <form method="POST" action="{{ url('/tarif/update/' . $tarif->id_tarif) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="inscription" class="form-label">
                                <i class="fas fa-user-plus"></i> Frais d'inscription <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" 
                                       name="inscription" 
                                       id="inscription" 
                                       class="form-control @error('inscription') is-invalid @enderror" 
                                       value="{{ old('inscription', $tarif->inscription) }}"
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
                                       value="{{ old('mensualite', $tarif->mensualite) }}"
                                       min="0"
                                       step="1"
                                       required>
                                <span class="input-group-text">FCFA</span>
                                @error('mensualite')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            <small>Les montants sont en Francs CFA (FCFA)</small>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ url('/tarif/create') }}" class="btn btn-secondary">
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