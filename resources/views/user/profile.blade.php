@extends('layouts.app')

@section('title', 'Mon Profil')

@section('content')
<div class="container">
    <h1 class="mb-4">Mon Profil</h1>
    
    <div class="row">
        <!-- Informations personnelles -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Informations personnelles</h5>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        @if($user->photo)
                            <img src="{{ asset('images/' . $user->photo) }}" alt="Photo de profil" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 150px; height: 150px;">
                                <i class="fas fa-user fa-5x text-secondary"></i>
                            </div>
                        @endif
                    </div>
                    
                    <h4>{{ $user->Prenom }} {{ $user->nom }}</h4>
                    <p class="text-muted">{{ $user->TypeCompte }}</p>
                    
                    <ul class="list-group list-group-flush text-start mt-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-id-card me-2"></i> Matricule:</span>
                            <span class="fw-bold">{{ $user->Matricule }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-user me-2"></i> Login:</span>
                            <span class="fw-bold">{{ $user->login }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-envelope me-2"></i> Email:</span>
                            <span class="fw-bold">{{ $user->Email }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Réservations du mois -->
        <div class="col-md-8" id="reservations">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Mes réservations du mois</h5>
                </div>
                <div class="card-body">
                    @if($reservations->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Petit-déjeuner</th>
                                        <th>Déjeuner</th>
                                        <th>Dîner</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $reservation)
                                        <tr class="{{ $reservation->Annulation ? 'table-danger' : '' }}">
                                            <td>{{ \Carbon\Carbon::parse($reservation->DateReservation)->format('d/m/Y') }}</td>
                                            <td>
                                                @if($reservation->Repas1)
                                                    <i class="fas fa-check text-success"></i>
                                                @else
                                                    <i class="fas fa-times text-danger"></i>
                                                @endif
                                            </td>
                                            <td>
                                                @if($reservation->Repas2)
                                                    <i class="fas fa-check text-success"></i>
                                                @else
                                                    <i class="fas fa-times text-danger"></i>
                                                @endif
                                            </td>
                                            <td>
                                                @if($reservation->Repas3)
                                                    <i class="fas fa-check text-success"></i>
                                                @else
                                                    <i class="fas fa-times text-danger"></i>
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
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation?')">
                                                            <i class="fas fa-ban"></i> Annuler
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
@endsection
