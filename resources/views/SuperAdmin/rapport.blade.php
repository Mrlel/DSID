@extends('layouts.superDashboard')

@section('content')
<div class="dashboard-container">
   
<div class="mb-4">
      <h1 class="fw-bold font-serif mb-1">Rapport de gestion du patrimoine des directions</h1>
      <p class="small text-muted">Structure organisationnelle du ministère</p>
    </div>
    <!-- Formulaire de filtrage -->
    <div class="filter-card">
        <form method="GET" action="" class="filter-form">
            <div class="filter-group">
                <label for="direction_select">Filtrer par direction</label>
                <div class="select-wrapper">
                    <select class="ui search dropdown" id="direction_select" name="direction_id">
                        <option value="">Toutes les directions</option>
                        @foreach($directions as $direction)
                            <option value="{{ $direction->id }}" {{ request('direction_id') == $direction->id ? 'selected' : '' }}>
                                {{ $direction->nom_direction }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="button-group">
                    <button class="btn btn-primary" type="submit">
                        <i class="filter icon"></i> Filtrer
                    </button>
                    <!--<a href="{{ route('rapport.pdf') }}" class="btn btn-secondary">
                        <i class="download icon"></i> Télécharger PDF (Toutes directions)
                    </a>-->
                    @if(request('direction_id'))
                    <a href="{{ route('rapport.pdf.direction', ['directionId' => request('direction_id')]) }}" class="btn btn-secondary">
                        <i class="download icon"></i> Télécharger PDF
                    </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Affichage des stats -->
    <div class="stats-container">
        @foreach($stats as $stat)
            <div class="stat-cardd">
                <div class="stat-header">
                    <h2>{{ $stat['direction'] }}</h2>
                </div>
                <div class="stat-body">
                    <div class="stat-section">
                        <h3>Équipements</h3>
                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Total</th>
                                        <th>En stock</th>
                                        <th>En service</th>
                                        <th>En maintenance</th>
                                        <th>Hors service</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $stat['equipements']['total'] }}</td>
                                        <td>{{ $stat['equipements']['en_stock'] }}</td>
                                        <td>{{ $stat['equipements']['en_service'] }}</td>
                                        <td>{{ $stat['equipements']['en_maintenance'] }}</td>
                                        <td>{{ $stat['equipements']['hors_service'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="stat-section">
                        <h3>Utilisateurs</h3>
                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Total</th>
                                        <th>Équipés</th>
                                        <th>Non équipés</th>
                                        <th>Connectés</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $stat['utilisateurs']['total'] }}</td>
                                        <td>{{ $stat['utilisateurs']['equipes'] }}</td>
                                        <td>{{ $stat['utilisateurs']['non_equipes'] }}</td>
                                        <td>{{ $stat['utilisateurs']['connectes'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="stat-section">
                        <h3>Logiciels</h3>
                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Total</th>
                                        <th>Actifs</th>
                                        <th>Bientôt expirés</th>
                                        <th>Expirés</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $stat['logiciels']['total'] }}</td>
                                        <td>{{ $stat['logiciels']['actifs'] }}</td>
                                        <td>{{ $stat['logiciels']['bientot_expires'] }}</td>
                                        <td>{{ $stat['logiciels']['expires'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
/* Variables */
:root {
    --primary-color: #3498db;
    --secondary-color: #2c3e50;
    --green-color: #009e00;
    --bg-color: #f5f7fa;
    --card-bg: #ffffff;
    --text-color: #333333;
    --border-radius: 8px;
    --box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    --padding: 20px;
    --spacing: 16px;
}

/* Container principal */
.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: var(--padding);
   
    color: var(--text-color);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Titre du dashboard */
.dashboard-title {
    font-size: 28px;
    margin-bottom: 24px;
    color: #FF9900;
    border-bottom: 2px solid var(--primary-color);
    padding-bottom: 10px;
}

/* Carte de filtrage */
.filter-card {
    background-color: var(--card-bg);
    margin-bottom: 24px;
}

.filter-form {
    width: 100%;
}

.filter-group {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}

.filter-group label {
    font-weight: 600;
    margin-right: 10px;
}

.select-wrapper {
    position: relative;
    min-width: 200px;
}

.filter-group select {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: white;
    font-size: 14px;
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24'%3E%3Cpath fill='%23333' d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    cursor: pointer;
}

.button-group {
    display: flex;
    gap: 10px;
    margin-left: auto;
}

.btn {
    padding: 10px 16px;
    border-radius: 4px;
    font-weight: 500;
    font-size: 14px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
    border: none;
}

.btn-primary {
    background-color: var(--primary-color);
    color: white;
}

.btn-primary:hover {
    background-color: #2980b9;
}

.btn-secondary {
    background-color: #ecf0f1;
    color: var(--secondary-color);
}

.btn-secondary:hover {
    background-color: #d5dbdb;
}

/* Carte de statistiques */
.stat-cardd {
    background-color: var(--card-bg);
    border-radius: 5px;
    box-shadow: var(--box-shadow);
    overflow: hidden;
    transition: transform 0.2s ease;
    margin-bottom: 24px;
}

.stat-cardd:hover {
    transform: translateY(-3px);
}

.stat-header {
    background-color: #009E60;
    color: white;
    padding: 12px var(--padding);
}

.stat-header h2 {
    font-size: 18px;
    margin: 0;
}

.stat-body {
    padding: var(--padding);
}

.stat-section {
    margin-bottom: 20px;
}

.stat-section:last-child {
    margin-bottom: 0;
}

.stat-section h3 {
    font-size: 16px;
    margin: 0 0 12px 0;
    color: var(--secondary-color);
    position: relative;
    padding-left: 12px;
}

.stat-section h3::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 4px;
    background-color: var(--primary-color);
    border-radius: 4px;
}

.table-responsive {
    overflow-x: auto;
    margin-bottom: 16px;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.data-table th,
.data-table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #e0e0e0;
}

.data-table th {
    background-color: #f5f7fa;
    color: var(--secondary-color);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 0.5px;
}

.data-table tbody tr:hover {
    background-color: rgba(52, 152, 219, 0.05);
}

.data-table td {
    font-weight: 500;
    color: var(--text-color);
}

/* Style alternatif pour les lignes */
.data-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Responsive */
@media (max-width: 768px) {
    .filter-group {
        flex-direction: column;
        align-items: stretch;
    }
    
    .button-group {
        margin-left: 0;
        width: 100%;
    }
    
    .btn {
        flex: 1;
    }
    
    .stats-container {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection