@extends('layouts.app')

@section('title', 'Tableau de bord Admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Tableau de bord Administrateur</h1>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-check fa-3x mb-3 text-primary"></i>
                    <h5 class="card-title">Gestion des Réservations</h5>
                    <p class="card-text">Gérer les réservations de repas pour le personnel.</p>
                    <a href="{{ route('admin.reservations') }}" class="btn btn-primary">Accéder</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-chart-bar fa-3x mb-3 text-success"></i>
                    <h5 class="card-title">Statistiques</h5>
                    <p class="card-text">Consulter les statistiques de réservation par jour et par mois.</p>
                    <a href="{{ route('admin.statistics') }}" class="btn btn-success">Accéder</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-user-circle fa-3x mb-3 text-info"></i>
                    <h5 class="card-title">Mon Profil</h5>
                    <p class="card-text">Consulter et modifier vos informations personnelles.</p>
                    <a href="{{ route('user.profile') }}" class="btn btn-info">Accéder</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
