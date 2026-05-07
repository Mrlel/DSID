@extends('layouts.superDashboard')
@section('content')
<style>
    /* Alternative Modern Stats Cards Design */
    .stat-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 3px;
        padding: 28px;
        border: none;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;

        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--card-gradient-start), var(--card-gradient-end));
    }
    
    .stat-card.orange {
        --card-gradient-start: #FF9500;
        --card-gradient-end: #FF6B00;
    }
    
    .stat-card.green {
        --card-gradient-start: #009E60;
        --card-gradient-end: #00C778;
    }
    
    .stat-card.blue {
        --card-gradient-start: #007AFF;
        --card-gradient-end: #00A3FF;
    }
    
    .stat-card.purple {
        --card-gradient-start: #5856D6;
        --card-gradient-end: #8B89FF;
    }
    
    .stat-card-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        position: relative;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
    }
    
    .stat-card-icon::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 16px;
        background: inherit;
        filter: blur(12px);
        opacity: 0.4;
        z-index: -1;
    }
    
    .stat-card-icon.orange {
        background: linear-gradient(135deg, #FF9500 0%, #FF6B00 100%);
        color: white;
    }
    
    .stat-card-icon.green {
        background: linear-gradient(135deg, #009E60 0%, #00C778 100%);
        color: white;
    }
    
    .stat-card-icon.blue {
        background: linear-gradient(135deg, #007AFF 0%, #00A3FF 100%);
        color: white;
    }
    
    .stat-card-icon.purple {
        background: linear-gradient(135deg, #5856D6 0%, #8B89FF 100%);
        color: white;
    }
    
    .stat-card-label {
        font-size: 13px;
        color: #6E6E73;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }
    
    .stat-card-value {
        font-size: 42px;
        font-weight: 800;
        background: linear-gradient(135deg, #1C1C1E 0%, #3A3A3C 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
        margin-bottom: 12px;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    }
    
    .stat-card-description {
        font-size: 14px;
        color: #8E8E93;
        margin-bottom: 16px;
        font-weight: 500;
    }
    
    .stat-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 16px;
        border-top: 1px solid rgba(0, 0, 0, 0.06);
    }
    
    .stat-card-change {
        font-size: 13px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        background: rgba(52, 199, 89, 0.1);
    }
    
    .stat-card-change.positive {
        color: #34C759;
    }
    
    .stat-card-change.negative {
        color: #FF3B30;
        background: rgba(255, 59, 48, 0.1);
    }
    
    .stat-card-change i {
        font-size: 10px;
    }
    
    .stat-card-trend {
        width: 60px;
        height: 24px;
        position: relative;
    }
    
    .stat-card-trend svg {
        width: 100%;
        height: 100%;
    }

    /* Charts */
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
        margin-bottom: 30px;
    }
    
    .dashboard-charts {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-top: 20px;
    }
    
    .chart-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }
    
    
    .chart-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        text-align: center;
        color: #1C1C1E;
    }
    
    .direction-comparison {
        grid-column: span 2;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .stat-card-value {
            font-size: 36px;
        }
        
        .stat-card-icon {
            width: 56px;
            height: 56px;
            font-size: 24px;
        }
    }
</style>

<div class="py-4">
    <h2 class="h4 fw-bold font-serif">Tableau de Bord</h2>
    <p class="text-muted">Système optimisé de gestion du MEPD</p>
</div>

<!-- Alternative Modern Stat Cards Grid -->
<div class="row g-4 mb-4">
    <!-- Total Utilisateurs -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="stat-card orange">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="flex-grow-1">
                    <div class="stat-card-label">Total Utilisateurs</div>
                    <div class="stat-card-value">{{ App\Models\User::count() }}</div>
                    <div class="stat-card-description">Personnel enregistré</div>
                </div>
                <div class="stat-card-icon orange">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="stat-card-footer">
                <div class="stat-card-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +12%
                </div>
                <div class="stat-card-trend">
                    <svg viewBox="0 0 60 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 20C5 18 10 15 15 12C20 9 25 10 30 8C35 6 40 4 45 6C50 8 55 5 60 2" 
                              stroke="#34C759" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Directions -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="stat-card green">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="flex-grow-1">
                    <div class="stat-card-label">Directions</div>
                    <div class="stat-card-value">{{ $directions->count() }}</div>
                    <div class="stat-card-description">Unités organisationnelles</div>
                </div>
                <div class="stat-card-icon green">
                    <i class="fas fa-building"></i>
                </div>
            </div>
            <div class="stat-card-footer">
                <div class="stat-card-change positive">
                    <i class="fas fa-check-circle"></i>
                    Actif
                </div>
                <div class="stat-card-trend">
                    <svg viewBox="0 0 60 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 12L15 10L30 14L45 8L60 12" 
                              stroke="#34C759" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Utilisateurs Actifs -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="stat-card blue">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="flex-grow-1">
                    <div class="stat-card-label">Utilisateurs Actifs</div>
                    <div class="stat-card-value">
                        @php
                            $totalConnected = 0;
                            foreach($stats as $stat) {
                                $totalConnected += $stat['utilisateurs']['connectes'];
                            }
                        @endphp
                        {{ $totalConnected }}
                    </div>
                    <div class="stat-card-description">Comptes activés</div>
                </div>
                <div class="stat-card-icon blue">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
            <div class="stat-card-footer">
                <div class="stat-card-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +5%
                </div>
                <div class="stat-card-trend">
                    <svg viewBox="0 0 60 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 18L10 16L20 10L30 14L40 8L50 12L60 6" 
                              stroke="#34C759" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Nouveaux ce mois -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="stat-card purple">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="flex-grow-1">
                    <div class="stat-card-label">Nouveaux ce mois</div>
                    <div class="stat-card-value">
                        @php
                            $newUsersCount = App\Models\User::whereMonth('created_at', now()->month)
                                ->whereYear('created_at', now()->year)
                                ->count();
                        @endphp
                        {{ $newUsersCount }}
                    </div>
                    <div class="stat-card-description">Inscriptions récentes</div>
                </div>
                <div class="stat-card-icon purple">
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>
            <div class="stat-card-footer">
                <div class="stat-card-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +8%
                </div>
                <div class="stat-card-trend">
                    <svg viewBox="0 0 60 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 22L12 18L24 20L36 14L48 10L60 4" 
                              stroke="#34C759" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dashboard Charts -->
<div class="dashboard-charts">

    
    <div class="chart-card direction-comparison">
        <div class="chart-title">Comparaison des directions</div>
        <div class="chart-container">
            <canvas id="directionComparisonChart"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart Initialization -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const colors = {
        blue: 'rgba(54, 162, 235, 0.7)',
        green: 'rgba(75, 192, 192, 0.7)',
        yellow: 'rgba(255, 206, 86, 0.7)',
        red: 'rgba(255, 99, 132, 0.7)',
        purple: 'rgba(153, 102, 255, 0.7)',
        orange: 'rgba(255, 159, 64, 0.7)',
        grey: 'rgba(201, 203, 207, 0.7)'
    };
    
    Chart.defaults.font.family = "'Nunito', 'Segoe UI', sans-serif";
    Chart.defaults.color = '#666';
    
    // Graphique des utilisateurs
    const userTotals = {
        equipes: 0,
        nonEquipes: 0,
        connectes: 0,
        nonConnectes: 0
    };
    
    let totalUsers = 0;
    
    @foreach($stats as $stat)
        userTotals.equipes += {{ $stat['utilisateurs']['equipes'] }};
        userTotals.nonEquipes += {{ $stat['utilisateurs']['non_equipes'] }};
        userTotals.connectes += {{ $stat['utilisateurs']['connectes'] }};
        totalUsers += {{ $stat['utilisateurs']['total'] }};
    @endforeach
    
    userTotals.nonConnectes = totalUsers - userTotals.connectes;
    
    new Chart(document.getElementById('usersChart'), {
        type: 'pie',
        data: {
            labels: ['Équipés', 'Non équipés', 'Connectés', 'Non connectés'],
            datasets: [{
                data: [
                    userTotals.equipes,
                    userTotals.nonEquipes,
                    userTotals.connectes,
                    userTotals.nonConnectes
                ],
                backgroundColor: [colors.green, colors.red, colors.blue, colors.grey],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: { size: 12, weight: '600' }
                    }
                }
            }
        }
    });
    
    // Graphique des directions
    new Chart(document.getElementById('directionsChart'), {
        type: 'doughnut',
        data: {
            labels: ['Actives', 'Inactives'],
            datasets: [{
                data: [{{ $directionsActives }}, {{ $directionsInactives }}],
                backgroundColor: [colors.green, colors.grey],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: { size: 12, weight: '600' }
                    }
                }
            }
        }
    });
    
    // Graphique de comparaison
    const directionLabels = [];
    const directionEquipements = [];
    const directionUtilisateurs = [];
    const directionLicences = [];
    
    @foreach($stats as $directionId => $stat)
        directionLabels.push("{{ $stat['direction'] }}");
        directionEquipements.push({{ $stat['equipements']['total'] }});
        directionUtilisateurs.push({{ $stat['utilisateurs']['total'] }});
        directionLicences.push({{ $stat['logiciels']['total'] }});
    @endforeach
    
    new Chart(document.getElementById('directionComparisonChart'), {
        type: 'bar',
        data: {
            labels: directionLabels,
            datasets: [
                {
                    label: 'Équipements',
                    data: directionEquipements,
                    backgroundColor: colors.blue,
                    borderRadius: 8,
                    borderWidth: 0
                },
                {
                    label: 'Utilisateurs',
                    data: directionUtilisateurs,
                    backgroundColor: colors.green,
                    borderRadius: 8,
                    borderWidth: 0
                },
                {
                    label: 'Licences',
                    data: directionLicences,
                    backgroundColor: colors.purple,
                    borderRadius: 8,
                    borderWidth: 0
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0, 0, 0, 0.05)' }
                },
                x: {
                    grid: { display: false }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        padding: 15,
                        font: { size: 12, weight: '600' },
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                }
            }
        }
    });
});
</script>
@endsection