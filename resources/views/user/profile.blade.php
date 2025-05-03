@extends('layouts.app')

@section('title', 'Mon Profil')

@section('content')
<div class="container">
    <h1 class="mb-4" style="color: #3a1019;">Mon Profil</h1>
    
    <div class="row">
        <!-- Informations personnelles -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header py-3" style="background-color: #ff7200; color: white;">
                    <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Informations personnelles</h5>
                </div>
                <div class="card-body text-center">
                    <h4 style="color: #3a1019;">{{ $user->Prenom }} {{ $user->nom }}</h4>
                    <p class="text-muted">{{ $user->TypeCompte }}</p>
                    
                    <ul class="list-group list-group-flush text-start mt-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-id-card me-2" style="color: #ff7200;"></i> Matricule:</span>
                            <span class="fw-bold">{{ $user->Matricule }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-user me-2" style="color: #ff7200;"></i> Login:</span>
                            <span class="fw-bold">{{ $user->login }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-envelope me-2" style="color: #ff7200;"></i> Email:</span>
                            <span class="fw-bold">{{ $user->Email }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Réservations du mois -->
        <div class="col-md-8" id="reservations">
            <div class="card border-0 shadow-sm">
                <div class="card-header py-3" style="background-color: #ff7200; color: white;">
                    <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Mes réservations du mois</h5>
                </div>
                <div class="card-body">
                    @if($reservations->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead style="background-color: #f8f9fa;">
                                    <tr>
                                        <th style="color: #3a1019;">Date</th>
                                        <th style="color: #3a1019;">Petit-déjeuner</th>
                                        <th style="color: #3a1019;">Déjeuner</th>
                                        <th style="color: #3a1019;">Dîner</th>
                                        <th style="color: #3a1019;">Statut</th>
                                        <th style="color: #3a1019;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $reservation)
                                        <tr class="{{ $reservation->Annulation ? 'bg-canceled' : '' }}">
                                            <td>{{ \Carbon\Carbon::parse($reservation->DateReservation)->format('d/m/Y') }}</td>
                                            <td>
                                                @if($reservation->Repas1)
                                                    <i class="fas fa-check" style="color: #d60015;"></i>
                                                @else
                                                    <i class="fas fa-times" style="color: #6c757d;"></i>
                                                @endif
                                            </td>
                                            <td>
                                                @if($reservation->Repas2)
                                                    <i class="fas fa-check" style="color: #d60015;"></i>
                                                @else
                                                    <i class="fas fa-times" style="color: #6c757d;"></i>
                                                @endif
                                            </td>
                                            <td>
                                                @if($reservation->Repas3)
                                                    <i class="fas fa-check" style="color: #d60015;"></i>
                                                @else
                                                    <i class="fas fa-times" style="color: #6c757d;"></i>
                                                @endif
                                            </td>
                                            <td>
                                                @if($reservation->Annulation)
                                                    <span class="badge bg-danger">Annulée</span>
                                                @else
                                                    <span class="badge bg-success">Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!$reservation->Annulation && $reservation->DateReservation >= \Carbon\Carbon::today())
                                                    <form action="{{ route('user.reservation.cancel', $reservation->ID) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-cancel" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation?')">
                                                            <i class="fas fa-ban me-1"></i>Annuler
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> Vous n'avez pas de réservations pour ce mois.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styles personnalisés */
    .bg-canceled {
        background-color: rgba(214, 0, 21, 0.05) !important;
    }
    
    .btn-cancel {
        background-color: #d60015;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    
    .btn-cancel:hover {
        background-color: #b30012;
        transform: translateY(-1px);
    }
    
    .card {
        border-radius: 8px;
        overflow: hidden;
    }
    
    .list-group-item {
        border-color: #ff7200;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(255, 114, 0, 0.05);
    }
    
    .badge {
        font-weight: 500;
        padding: 5px 10px;
    }
    
    .badge.bg-success {
        background-color: rgba(58, 16, 25, 0.1) !important;
        color: #3a1019;
        border: 1px solid #3a1019;
    }
    
    .badge.bg-danger {
        background-color: rgba(214, 0, 21, 0.1) !important;
        color: #d60015;
        border: 1px solid #d60015;
    }
</style>
@endsection