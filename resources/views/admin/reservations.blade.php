@extends('layouts.app')

@section('title', 'Gestion des Réservations')

@section('content')
<div class="container">
    <h1 class="mb-4">Gestion des Réservations</h1>
    
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Nouvelle Réservation</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.reservations.store') }}" method="POST" id="reservationForm">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="matricule" class="form-label">Personnel</label>
                        <select class="form-select" id="matricule" name="matricule" required>
                            <option value="">Sélectionner un employé</option>
                            @foreach($personnel as $employe)
                                <option value="{{ $employe->Matricule }}">{{ $employe->Prenom }} {{ $employe->nom }} ({{ $employe->Matricule }})</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="date_reservation" class="form-label">Date de réservation</label>
                        <input type="date" class="form-control" id="date_reservation" name="date_reservation" min="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">Repas</label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="repas1" name="repas1" value="1">
                                <label class="form-check-label" for="repas1">
                                    <i class="fas fa-coffee me-1"></i> Petit-déjeuner
                                </label>
                            </div>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="repas2" name="repas2" value="1">
                                <label class="form-check-label" for="repas2">
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
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Enregistrer la réservation
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header bg-info text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Statistiques des repas</h5>
                <div>
                    <span class="badge bg-light text-dark me-2" id="count-petit-dejeuner">Petit-déjeuner: 0</span>
                    <span class="badge bg-light text-dark me-2" id="count-dejeuner">Déjeuner: 0</span>
                    <span class="badge bg-light text-dark" id="count-diner">Dîner: 0</span>
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
