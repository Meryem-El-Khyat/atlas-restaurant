@extends('layouts.app')

@section('title', 'Réservation de Repas')

@section('content')
<div class="container">
    <h1 class="mb-4" style="color: #ff7200;">Réservation de Repas</h1>
    
    <div class="row">
        <!-- Formulaire de réservation -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header py-3" style="background-color: #ff7200; color: white;">
                    <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Nouvelle Réservation</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.reservation.store') }}" method="POST" id="reservationForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="date_reservation" class="form-label fw-medium">Date de réservation</label>
                            <input type="date" class="form-control" id="date_reservation" name="date_reservation" 
                                   min="{{ date('Y-m-d') }}" required style="border-color: #ff7200;">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-medium">Repas</label>
                            <div class="d-flex flex-column gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="repas1" name="repas1" value="1" style="border-color: #ff7200;">
                                    <label class="form-check-label d-flex align-items-center" for="repas1">
                                        <i class="fas fa-coffee me-2" style="color: #ff7200;"></i> Petit-déjeuner
                                    </label>
                                </div>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="repas2" name="repas2" value="1" style="border-color: #ff7200;">
                                    <label class="form-check-label d-flex align-items-center" for="repas2">
                                        <i class="fas fa-utensils me-2" style="color: #ff7200;"></i> Déjeuner
                                    </label>
                                </div>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="repas3" name="repas3" value="1" style="border-color: #ff7200;">
                                    <label class="form-check-label d-flex align-items-center" for="repas3">
                                        <i class="fas fa-moon me-2" style="color: #ff7200;"></i> Dîner
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-3 border-0 shadow-sm">
                            <div class="card-header py-2" style="background-color: #3a1019; color: white;">
                                <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Statistiques des repas</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-wrap gap-2">
                                    <span class="badge bg-orange-soft text-orange" id="count-petit-dejeuner">
                                        <i class="fas fa-coffee me-1"></i> Petit-déjeuner: 0
                                    </span>
                                    <span class="badge bg-orange-soft text-orange" id="count-dejeuner">
                                        <i class="fas fa-utensils me-1"></i> Déjeuner: 0
                                    </span>
                                    <span class="badge bg-orange-soft text-orange" id="count-diner">
                                        <i class="fas fa-moon me-1"></i> Dîner: 0
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-reservation w-100 py-2">
                            <i class="fas fa-save me-2"></i> Enregistrer la réservation
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Réservations futures -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header py-3" style="background-color: #3a1019; color: white;">
                    <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Mes réservations futures</h5>
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
                                        <th style="color: #3a1019;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $reservation)
                                        <tr class="{{ $reservation->Annulation ? 'bg-canceled' : '' }}">
                                            <td>{{ \Carbon\Carbon::parse($reservation->DateReservation)->format('d/m/Y') }}</td>
                                            <td>
                                                @if($reservation->Repas1)
                                                    <i class="fas fa-check" style="color: #ff7200;"></i>
                                                @else
                                                    <i class="fas fa-times" style="color: #6c757d;"></i>
                                                @endif
                                            </td>
                                            <td>
                                                @if($reservation->Repas2)
                                                    <i class="fas fa-check" style="color: #ff7200;"></i>
                                                @else
                                                    <i class="fas fa-times" style="color: #6c757d;"></i>
                                                @endif
                                            </td>
                                            <td>
                                                @if($reservation->Repas3)
                                                    <i class="fas fa-check" style="color: #ff7200;"></i>
                                                @else
                                                    <i class="fas fa-times" style="color: #6c757d;"></i>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!$reservation->Annulation)
                                                    <form action="{{ route('user.reservation.cancel', $reservation->ID) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-cancel">
                                                            <i class="fas fa-ban me-1"></i>Annuler
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
                        <div class="alert alert-orange">
                            <i class="fas fa-info-circle me-2"></i> Vous n'avez pas de réservations futures.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styles personnalisés */
    :root {
        --orange: #ff7200;
        --orange-dark: #e56700;
        --bordeaux: #3a1019;
        --red: #d60015;
    }
    
    .btn-reservation {
        background-color: var(--orange);
        color: white;
        border: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-reservation:hover {
        background-color: var(--orange-dark);
        transform: translateY(-2px);
    }
    
    .btn-cancel {
        background-color: var(--red);
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
    
    .bg-orange-soft {
        background-color: rgba(255, 114, 0, 0.1);
    }
    
    .text-orange {
        color: var(--orange);
    }
    
    .bg-canceled {
        background-color: rgba(214, 0, 21, 0.05) !important;
    }
    
    .alert-orange {
        background-color: rgba(255, 114, 0, 0.1);
        color: #5a1a2b;
        border-left: 4px solid var(--orange);
    }
    
    .card {
        border-radius: 8px;
    }
    
    .form-check-input:checked {
        background-color: var(--orange);
        border-color: var(--orange);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--orange);
        box-shadow: 0 0 0 0.25rem rgba(255, 114, 0, 0.25);
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(255, 114, 0, 0.05);
    }
</style>
@endsection

@section('scripts')
<script>
    // Fonction pour calculer le nombre de repas
    function calculerRepas() {
        let petitDejeuner = $('#repas1').is(':checked') ? 1 : 0;
        let dejeuner = $('#repas2').is(':checked') ? 1 : 0;
        let diner = $('#repas3').is(':checked') ? 1 : 0;
        
        $('#count-petit-dejeuner').html('<i class="fas fa-coffee me-1"></i> Petit-déjeuner: ' + petitDejeuner);
        $('#count-dejeuner').html('<i class="fas fa-utensils me-1"></i> Déjeuner: ' + dejeuner);
        $('#count-diner').html('<i class="fas fa-moon me-1"></i> Dîner: ' + diner);
    }
    
    // Écouter les changements sur les checkboxes
    $(document).ready(function() {
        $('#repas1, #repas2, #repas3').change(function() {
            calculerRepas();
        });
        
        // Initialiser le compteur
        calculerRepas();
    });
</script>
@endsection