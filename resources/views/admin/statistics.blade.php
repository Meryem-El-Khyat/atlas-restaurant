@extends('layouts.app')

@section('title', 'Statistiques')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.css">
<style>
    .stats-card {
        transition: transform 0.3s;
        border: none;
        border-radius: 8px;
        overflow: hidden;
    }
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .card-header {
        background-color: #ff7200 !important;
        color: white !important;
    }
    
    .text-primary {
        color: #3a1019 !important;
    }
    
    .text-success {
        color: #d60015 !important;
    }
    
    .text-info {
        color: #ff7200 !important;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4" style="color: #3a1019;">Statistiques des Réservations</h1>
    
    <!-- Statistiques par type de repas -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header py-3">
            <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Par type de repas (à partir d'aujourd'hui)</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card stats-card h-100 bg-light">
                        <div class="card-body text-center">
                            <i class="fas fa-coffee fa-3x mb-3" style="color: #3a1019;"></i>
                            <h5 class="card-title">Petit-déjeuner</h5>
                            <h2 class="card-text">{{ $repasStats->petit_dejeuner ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card stats-card h-100 bg-light">
                        <div class="card-body text-center">
                            <i class="fas fa-utensils fa-3x mb-3" style="color: #d60015;"></i>
                            <h5 class="card-title">Déjeuner</h5>
                            <h2 class="card-text">{{ $repasStats->dejeuner ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card stats-card h-100 bg-light">
                        <div class="card-body text-center">
                            <i class="fas fa-moon fa-3x mb-3" style="color: #ff7200;"></i>
                            <h5 class="card-title">Dîner</h5>
                            <h2 class="card-text">{{ $repasStats->diner ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Statistiques par jour -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header py-3">
            <h5 class="mb-0"><i class="fas fa-calendar-day me-2"></i>Par jour (7 prochains jours)</h5>
        </div>
        <div class="card-body">
            <canvas id="dailyChart" height="200"></canvas>
        </div>
    </div>
    
    <!-- Statistiques par mois -->
    <div class="card border-0 shadow-sm">
        <div class="card-header py-3">
            <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Par mois (année en cours)</h5>
        </div>
        <div class="card-body">
            <canvas id="monthlyChart" height="200"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script>
    // Données pour le graphique par jour
    const dailyData = @json($dailyStats);
    const dailyLabels = dailyData.map(item => {
        const date = new Date(item.date);
        return date.toLocaleDateString('fr-FR', { weekday: 'short', day: 'numeric', month: 'short' });
    });
    
    // Données pour le graphique par mois
    const monthlyData = @json($monthlyStats);
    const monthlyLabels = monthlyData.map(item => item.month);
    
    // Graphique par jour
    const dailyCtx = document.getElementById('dailyChart').getContext('2d');
    const dailyChart = new Chart(dailyCtx, {
        type: 'bar',
        data: {
            labels: dailyLabels,
            datasets: [
                {
                    label: 'Petit-déjeuner',
                    data: dailyData.map(item => item.petit_dejeuner),
                    backgroundColor: 'rgba(58, 16, 25, 0.7)',
                    borderColor: 'rgba(58, 16, 25, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Déjeuner',
                    data: dailyData.map(item => item.dejeuner),
                    backgroundColor: 'rgba(214, 0, 21, 0.7)',
                    borderColor: 'rgba(214, 0, 21, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Dîner',
                    data: dailyData.map(item => item.diner),
                    backgroundColor: 'rgba(255, 114, 0, 0.7)',
                    borderColor: 'rgba(255, 114, 0, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
    
    // Graphique par mois
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyChart = new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: monthlyLabels,
            datasets: [
                {
                    label: 'Petit-déjeuner',
                    data: monthlyData.map(item => item.petit_dejeuner),
                    backgroundColor: 'rgba(58, 16, 25, 0.2)',
                    borderColor: 'rgba(58, 16, 25, 1)',
                    borderWidth: 2,
                    tension: 0.1
                },
                {
                    label: 'Déjeuner',
                    data: monthlyData.map(item => item.dejeuner),
                    backgroundColor: 'rgba(214, 0, 21, 0.2)',
                    borderColor: 'rgba(214, 0, 21, 1)',
                    borderWidth: 2,
                    tension: 0.1
                },
                {
                    label: 'Dîner',
                    data: monthlyData.map(item => item.diner),
                    backgroundColor: 'rgba(255, 114, 0, 0.2)',
                    borderColor: 'rgba(255, 114, 0, 1)',
                    borderWidth: 2,
                    tension: 0.1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>
@endsection