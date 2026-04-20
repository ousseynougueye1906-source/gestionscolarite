<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion Inscription')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @stack('styles')
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-graduation-cap"></i> Gestion Inscription
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!-- Catégorie Niveau -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('categorie-niveau/*') ? 'active' : '' }}" 
                       href="{{ url('/categorie-niveau/create') }}">
                        <i class="fas fa-layer-group"></i> Catégorie Niveau
                    </a>
                </li>

                <!-- Niveau -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('niveaux/*') ? 'active' : '' }}" 
                       href="{{ url('/niveaux/create') }}">
                        <i class="fas fa-list-ol"></i> Niveau
                    </a>
                </li>

                <!-- Filière -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('filiere/*') ? 'active' : '' }}" 
                       href="{{ url('/filiere/create') }}">
                        <i class="fas fa-stream"></i> Filière
                    </a>
                </li>

                <!-- Classe -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('classe/*') ? 'active' : '' }}" 
                       href="{{ url('/classe/create') }}">
                        <i class="fas fa-chalkboard"></i> Classe
                    </a>
                </li>

                <!-- Tarif -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('tarif/create') || request()->is('tarif/edit/*') ? 'active' : '' }}" 
                       href="{{ url('/tarif/create') }}">
                        <i class="fas fa-dollar-sign"></i> Tarif
                    </a>
                </li>

                <!-- Tarif-Classe -->
                <li class="nav-item">   
                    <a class="nav-link {{ request()->is('tarif-classe/*') ? 'active' : '' }}" 
                       href="{{ url('/tarif-classe/create') }}">
                        <i class="fas fa-link"></i> Tarif-Classe
                    </a>
                </li>
                <!-- Année Académique -->
<li class="nav-item">
    <a class="nav-link {{ request()->is('annee-academique/*') ? 'active' : '' }}" 
       href="{{ url('/annee-academique/create') }}">
        <i class="fas fa-calendar-alt"></i> Année Académique
    </a>
</li>

            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>