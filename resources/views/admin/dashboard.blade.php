@extends('layouts.app')

@section('title', 'Tableau de bord Admin')

@section('content')
<div class="container">
    <h1 class="mb-4" style="color: #3a1019;">Tableau de bord Administrateur</h1>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-check fa-3x mb-3" style="color: #ff7200;"></i>
                    <h5 class="card-title" style="color: #3a1019;">Gestion des Réservations</h5>
                    <p class="card-text text-muted">Gérer les réservations de repas pour le personnel.</p>
                    <a href="{{ route('admin.reservations') }}" class="btn btn-orange">Accéder</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-chart-bar fa-3x mb-3" style="color: #ff7200;"></i>
                    <h5 class="card-title" style="color: #3a1019;">Statistiques</h5>
                    <p class="card-text text-muted">Consulter les statistiques de réservation.</p>
                    <a href="{{ route('admin.statistics') }}" class="btn btn-orange">Accéder</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-user-circle fa-3x mb-3" style="color: #ff7200;"></i>
                    <h5 class="card-title" style="color: #3a1019;">Mon Profil</h5>
                    <p class="card-text text-muted">Gérer vos informations personnelles.</p>
                    <a href="{{ route('user.profile') }}" class="btn btn-orange">Accéder</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Style personnalisé */
    .btn-orange {
        background-color: #ff7200;
        color: white;
        border: none;
        padding: 8px 20px;
        font-weight: 500;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    
    .btn-orange:hover {
        background-color: #e56700;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(255, 114, 0, 0.2);
    }
    
    .card {
        transition: transform 0.3s ease;
        border-radius: 8px;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    .card-title {
        font-weight: 600;
        margin-bottom: 15px;
    }
</style>
@endsection