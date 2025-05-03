@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="container">
    <h1 class="mb-4" style="color: #3a1019;">Bienvenue, {{ Auth::user()->Prenom }} {{ Auth::user()->nom }}</h1>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-utensils fa-3x mb-3" style="color: #d60015;"></i>
                    <h5 class="card-title" style="color: #3a1019;">Réservation de Repas</h5>
                    <p class="card-text text-muted">Réservez vos repas pour les prochains jours.</p>
                    <a href="{{ route('user.reservation') }}" class="btn btn-reservation">
                        <i class="fas fa-plus-circle me-2"></i>Réserver
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-user-circle fa-3x mb-3" style="color: #3a1019;"></i>
                    <h5 class="card-title" style="color: #3a1019;">Mon Profil</h5>
                    <p class="card-text text-muted">Consultez vos informations personnelles.</p>
                    <a href="{{ route('user.profile') }}" class="btn btn-profile">
                        <i class="fas fa-user me-2"></i>Voir mon profil
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-alt fa-3x mb-3" style="color: #ff7200;"></i>
                    <h5 class="card-title" style="color: #3a1019;">Mes Réservations</h5>
                    <p class="card-text text-muted">Gérez vos réservations actuelles.</p>
                    <a href="{{ route('user.profile') }}#reservations" class="btn btn-reservations">
                        <i class="fas fa-list me-2"></i>Voir mes réservations
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Boutons personnalisés */
    .btn-reservation {
        background-color: #d60015;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    
    .btn-profile {
        background-color: #3a1019;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    
    .btn-reservations {
        background-color: #ff7200;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    
    /* Effets au survol */
    .btn-reservation:hover {
        background-color: #b30012;
        color: white;
        transform: translateY(-2px);
    }
    
    .btn-profile:hover {
        background-color: #2a0c13;
        color: white;
        transform: translateY(-2px);
    }
    
    .btn-reservations:hover {
        background-color: #e56700;
        color: white;
        transform: translateY(-2px);
    }
    
    /* Cartes */
    .card {
        border-radius: 8px;
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection