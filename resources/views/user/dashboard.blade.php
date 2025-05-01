@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="container">
    <h1 class="mb-4">Bienvenue, {{ Auth::user()->Prenom }} {{ Auth::user()->nom }}</h1>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-utensils fa-3x mb-3 text-primary"></i>
                    <h5 class="card-title">Réservation de Repas</h5>
                    <p class="card-text">Réservez vos repas pour les prochains jours.</p>
                    <a href="{{ route('user.reservation') }}" class="btn btn-primary">Réserver</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-user-circle fa-3x mb-3 text-success"></i>
                    <h5 class="card-title">Mon Profil</h5>
                    <p class="card-text">Consultez vos informations personnelles et vos réservations.</p>
                    <a href="{{ route('user.profile') }}" class="btn btn-success">Voir mon profil</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-alt fa-3x mb-3 text-info"></i>
                    <h5 class="card-title">Mes Réservations</h5>
                    <p class="card-text">Consultez et gérez vos réservations actuelles.</p>
                    <a href="{{ route('user.profile') }}#reservations" class="btn btn-info">Voir mes réservations</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
