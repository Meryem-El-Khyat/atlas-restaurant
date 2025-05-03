@extends('layouts.app')

@section('title', 'Gestion des Réservations')

@section('content')
<div class="container">
    <h1 class="mb-4" style="color: #3a1019;">Gestion des Réservations</h1>
    
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header py-3" style="background: #ff7200; color: white;">
            <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i> Nouvelle Réservation</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.reservations.store') }}" method="POST" id="reservationForm">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="matricule" class="form-label fw-medium">Personnel</label>
                        <select class="form-select" id="matricule" name="matricule" required>
                            <option value="">Sélectionner un employé</option>
                            @foreach($personnel as $employe)
                                <option value="{{ $employe->Matricule }}">{{ $employe->Prenom }} {{ $employe->nom }} ({{ $employe->Matricule }})</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="date_reservation" class="form-label fw-medium">Date de réservation</label>
                        <input type="date" class="form-control" id="date_reservation" name="date_reservation" 
                               min="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-12">
                        <label class="form-label fw-medium">Repas</label>
                        <div class="d-flex flex-wrap gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="repas1" name="repas1" value="1">
                                <label class="form-check-label d-flex align-items-center" for="repas1">
                                    <i class="fas fa-coffee me-2" style="color: #3a1019;"></i> Petit-déjeuner
                                </label>
                            </div>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="repas2" name="repas2" value="1">
                                <label class="form-check-label d-flex align-items-center" for="repas2">
                                    <i class="fas fa-utensils me-2" style="color: #d60015;"></i> Déjeuner
                                </label>
                            </div>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="repas3" name="repas3" value="1">
                                <label class="form-check-label d-flex align-items-center" for="repas3">
                                    <i class="fas fa-moon me-2" style="color: #ff7200;"></i> Dîner
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-save me-2"></i> Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card border-0 shadow-sm">
        <div class="card-header py-3" style="background: #ff7200; color: white;">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <h5 class="mb-2 mb-md-0"><i class="fas fa-chart-pie me-2"></i> Statistiques des repas</h5>
                <div class="d-flex flex-wrap gap-2 mt-2 mt-md-0">
                    <span class="badge bg-light text-dark fw-medium px-3 py-2" id="count-petit-dejeuner">
                        <i class="fas fa-coffee me-1" style="color: #3a1019;"></i> Petit-déjeuner: 0
                    </span>
                    <span class="badge bg-light text-dark fw-medium px-3 py-2" id="count-dejeuner">
                        <i class="fas fa-utensils me-1" style="color: #d60015;"></i> Déjeuner: 0
                    </span>
                    <span class="badge bg-light text-dark fw-medium px-3 py-2" id="count-diner">
                        <i class="fas fa-moon me-1" style="color: #ff7200;"></i> Dîner: 0
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Bouton principal */
    .btn-primary {
        background-color: #d60015;
        border-color: #d60015;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: #ff7200;
        border-color: #ff7200;
        transform: translateY(-2px);
    }
    
    /* Formulaires */
    .form-control:focus, .form-select:focus {
        border-color: #ff7200;
        box-shadow: 0 0 0 0.2rem rgba(255, 114, 0, 0.25);
    }
    
    .form-check-input:checked {
        background-color: #3a1019;
        border-color: #3a1019;
    }
    
    /* Badges */
    .badge {
        border-radius: 6px;
        font-weight: 500;
        border: 1px solid #dee2e6;
    }
    
    /* Cartes */
    .card {
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
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
        
        $('#count-petit-dejeuner').html('<i class="fas fa-coffee me-1" style="color: #3a1019;"></i> Petit-déjeuner: ' + petitDejeuner);
        $('#count-dejeuner').html('<i class="fas fa-utensils me-1" style="color: #d60015;"></i> Déjeuner: ' + dejeuner);
        $('#count-diner').html('<i class="fas fa-moon me-1" style="color: #ff7200;"></i> Dîner: ' + diner);
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