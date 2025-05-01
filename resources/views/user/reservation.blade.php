@extends('layouts.app')

@section('title', 'Réservation de Repas')

@section('content')
<div class="container">
    <h1 class="mb-4">Réservation de Repas</h1>
    
    <div class="row">
        <!-- Formulaire de réservation -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Nouvelle Réservation</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.reservation.store') }}" method="POST" id="reservationForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="date_reservation" class="form-label">Date de réservation</label>
                            <input type="date" class="form-control" id="date_reservation" name="date_reservation" min="{{ date('Y-m-d') }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Repas</label>
                            <div class="d-flex flex-column gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="repas1" name="repas1" value="1">
                                    <label class="form-check-label" for="repas1">
                                        <i class="fas fa-coffee me-1"></i> Petit-déjeuner
                                    </label>
                                </div>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="repas2" name="repas2" value="1">
                                    <label class="form-check-label" for="repas2">
                                        <i class="fas fa-utensils me-1"></i>  for="repas2">
                                        <i class="fas fa-utensils me-1"></i> Déjeuner
                                    </label>
                                </div>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="repas3" name="repas3" value="1">
                                    <label class="form-check-label" for="repas3">
                                        <i class="fas fa-moon me-1"></i> Dîner
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0">Statistiques des repas</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span class="badge bg-primary" id="count-petit-dejeuner">Petit-déjeuner: 0</span>
                                    <span class="badge bg-success" id="count-dejeuner">Déjeuner: 0</span>
                                    <span class="badge bg-info" id="count-diner">Dîner: 0</span>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-1"></i> Enregistrer la réservation
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Réservations futures -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Mes réservations futures</h5>
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
                                                @if(!$reservation->Annulation)
                                                    <form action="{{ route('user.reservation.cancel', $reservation->ID) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation?')">
                                                            <i class="fas fa-ban"></i> Annuler
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="badge bg-danger">Annulée</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> Vous n'avez pas de réservations futures.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Fonction pour calculer le nombre de repas
    function calculerRepas() {
        let petitDejeuner = $('#repas1').is(':checked') ? 1 : 0;
        let dejeuner = $('#repas2').is(':checked') ? 1 : 0;
        let diner = $('#repas3').is(':checked') ? 1 : 0;
        
        $('#count-petit-dejeuner').text('Petit-déjeuner: ' + petitDejeuner);
        $('#count-dejeuner').text('Déjeuner: ' + dejeuner);
        $('#count-diner').text('Dîner: ' + diner);
    }
    
    // Écouter les changements sur les checkboxes
    $(document).ready(function() {
        $('#repas1, #repas2, #repas3').change(function() {
            calculerRepas();
        });
    });
</script>
@endsection
