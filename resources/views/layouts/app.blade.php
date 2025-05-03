<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atlas Restaurant - @yield('title', 'Système de Réservation')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }
        .content {
            flex: 1;
        }
        .navbar-brand img {
            height: 60px;
        }
        
        /* Couleurs principales */
        .bg-dark {
            background-color: #3a1019 !important; /* Rouge bordeaux foncé */
        }
        
        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85);
        }
        
        .navbar-dark .navbar-nav .nav-link:hover,
        .navbar-dark .navbar-nav .nav-link.active {
            color: #ff7200 !important; /* Orange vif */
        }
        
        .dropdown-menu {
            background-color: #3a1019;
            border: 1px solid #ff7200;
        }
        
        .dropdown-item {
            color: rgba(255, 255, 255, 0.85);
        }
        
        .dropdown-item:hover {
            background-color: #d60015; /* Rouge vif */
            color: white;
        }
        
        .btn-primary {
            background-color: #d60015;
            border-color: #d60015;
        }
        
        .btn-primary:hover {
            background-color: #ff7200;
            border-color: #ff7200;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
        
        footer {
            background-color: #3a1019 !important;
        }
        
        /* Style pour les liens */
        a {
            color: #d60015;
        }
        
        a:hover {
            color: #ff7200;
        }
        
        /* Style pour les boutons secondaires */
        .btn-outline-primary {
            color: #d60015;
            border-color: #d60015;
        }
        
        .btn-outline-primary:hover {
            background-color: #d60015;
            border-color: #d60015;
            color: white;
        }
    </style>
    @yield('styles')
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/logoo.jpg') }}" alt="Atlas Restaurant Logo">
                    Atlas Restaurant
                </a>
                
                @auth
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    @if(Auth::user()->TypeCompte === 'admin')
                        <!-- Menu Admin -->
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> Tableau de bord
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.reservations') ? 'active' : '' }}" href="{{ route('admin.reservations') }}">
                                    <i class="fas fa-calendar-check"></i> Réservations
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.statistics') ? 'active' : '' }}" href="{{ route('admin.statistics') }}">
                                    <i class="fas fa-chart-bar"></i> Statistiques
                                </a>
                            </li>
                        </ul>
                    @else
                        <!-- Menu Utilisateur -->
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                                    <i class="fas fa-home"></i> Accueil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('user.reservation') ? 'active' : '' }}" href="{{ route('user.reservation') }}">
                                    <i class="fas fa-utensils"></i> Réservation
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('user.profile') ? 'active' : '' }}" href="{{ route('user.profile') }}">
                                    <i class="fas fa-user"></i> Profil
                                </a>
                            </li>
                        </ul>
                    @endif
                    
                    <!-- Menu de droite (commun) -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->Prenom }} {{ Auth::user()->nom }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fas fa-id-card"></i> Mon profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Déconnexion</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </nav>
    </header>

    <div class="content container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="bg-dark text-white py-3 mt-auto">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Atlas Restaurant - Tous droits réservés</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>
</html>