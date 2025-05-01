@extends('layouts.app')

@section('title', 'Statistiques')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.css">
<style>
    .stats-card {
        transition: transform 0.3s;
    }
    .stats-card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4">Statistiques des Réservations</h1>
    
    <!-- Statistiques par type de repas -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Par type de repas (à partir d'aujourd'hui)</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card stats-card h-100 bg-light">
                        <div class="card-body text-center">
                            <i class="fas fa-coffee fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Petit-déjeuner</h5>
                            <h2 class="card-text">{{ $repasStats->petit_dejeuner ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card stats-card h-100 bg-light">
                        <div class="card-body text-center">
                            <i class="fas fa-utensils fa-3x mb-3 text-success"></i>
                            <h5 class="card-title">Déjeuner</h5>
                            <h2 class="card-text">{{ $repasStats->dejeuner ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card stats-card h-100 bg-light">
                        <div class="card-body text-center">
                            <i class="fas fa-moon fa-3x mb-3 text-info"></i>
                            <h5 class="card-title">Dîner</h5>
                            <h2 class="card-text">{{ $repasStats->diner ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Statistiques par jour -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Par jour (7 prochains jours)</h5>
        </div>
        <div class="card-body">
            <canvas id="dailyChart" height="200"></canvas>
        </div>
    </div>
    
    <!-- Statistiques par mois -->
    <div class="card">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Par mois (année en cours)</h5>
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
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Déjeuner',
                    data: dailyData.map(item => item.dejeuner),
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Dîner',
                    data: dailyData.map(item => item.diner),
                    backgroundColor: 'rgba(153, 102, 255, 0.7)',
                    borderColor: 'rgba(153, 102, 255, 1)',
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
                    display: true,
                    text: 'Réservations par jour'
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
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.1
                },
                {
                    label: 'Déjeuner',
                    data: monthlyData.map(item => item.dejeuner),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    tension: 0.1
                },
                {
                    label: 'Dîner',
                    data: monthlyData.map(item => item.diner),
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
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
                    display: true,
                    text: 'Réservations par mois'
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
