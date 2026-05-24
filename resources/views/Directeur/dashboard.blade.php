@extends('layouts.main-board')
@section('content')

    <style>
        .chart-card {
            background: #fdfbfbef;
            border-radius: 12px;
            padding: 1.5rem;
        }
        
        .activity-item {
            padding: 1rem;
            border-left: 3px solid #e9ecef;
            transition: all 0.3s ease;
        }
        
        .activity-item:hover {
            border-left-color: #ff7f50;
            background: #f8f9fa;
        }
        
        .badge-custom {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
        }
        
        .equipment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 1rem;
        }
        
        .equipment-item {
            text-align: center;
            padding: 1rem;
            background: #ffffff;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .equipment-item:hover {
            background: #e9ecef;
            transform: translateY(-3px);
        }
        
        .alert-card {
            border-left: 4px solid;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .alert-danger-custom {
            border-left-color: #d44352e0;
            background: #ffe5e5;
        }
        
        .alert-warning-custom {
            border-left-color: #f5cf5edc;
            background: #fff8e1;
        }
    </style>

<!-- Header -->
<div class="d-flex justify-content-between align-items-center my-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Tableau de bord — Patrimoine</h1>
        <p class="text-muted mb-0">Vue d'ensemble du patrimoine administratif  • Système de Gestion du Patrimoine Administratif</p>
    </div>
    <!--<a href="{{ route('admin.dashboard.export-pdf') }}" class="btn btn-success">
        <i class="fas fa-file-pdf me-2"></i>Exporter PDF
    </a>-->
</div>
 @if($licencesExpirees->count() > 0 || $licencesBientotExpirees->count() > 0)
                    <div class="row mb-4">
                        <div class="col-12">
                            @if($licencesExpirees->count() > 0)
                            <div class="alert-card alert-danger-custom">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>
                                        <strong>{{ $licencesExpirees->count() }} licence(s) expirée(s)</strong>
                                    </div>
                                    <a href="/logiciel_expire" class="btn btn-sm btn-danger"><i class="bi bi-arrow-right px-2"></i></a>
                                </div>
                            </div>
                            @endif
                            
                            @if($licencesBientotExpirees->count() > 0)
                            <div class="alert-card alert-warning-custom">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="bi bi-exclamation-circle-fill text-warning me-2"></i>
                                        <strong>{{ $licencesBientotExpirees->count() }} licence(s) expire(nt) dans moins de 10 jours</strong>
                                    </div>
                                    <a href="/logiciel_bientot_expire" class="btn btn-sm btn-warning"><i class="bi bi-arrow-right px-2"></i></a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
<div class="row g-4 mb-5">
  <!-- Total utilisateurs -->
  <div class="col-12 col-sm-6 col-lg-4">
    <a href="/userlist" class="card border-0 bg-light shadow-sm p-5 position-relative stat-card text-decoration-none text-dark">
      <!-- Gradient bar -->
      <div class="position-absolute top-0 start-0 end-0"
           style="height:5px; background:linear-gradient(90deg,#ff7f50,#ffb347);"></div>

      <div class="d-flex justify-content-between align-items-start">
        <div>
          <h4 class="fw-bold text-muted mb-2">Nombre d'Agent</h4>
          <div class="d-flex align-items-baseline gap-2">
            <span class="fs-1 fw-bold text-dark">{{ $Users->count() }}</span>
            <span class="small text-muted">Personnel enregistré</span>
          </div>
        </div>

        <!-- Icône -->
        <div class="d-flex align-items-center justify-content-center rounded p-3"
             style="background:linear-gradient(90deg,#ff7f50,#ffb347); width:64px; height:64px;">
          <i class="bi bi-people fs-3 text-white"></i>
        </div>
      </div>

      <!-- Pattern -->
      <div class="position-absolute bottom-0 end-0 opacity-25" style="width:100px; height:100px;">
        <i class="bi bi-people" style="font-size:100px;"></i>
      </div>
    </a>
  </div>

  <!-- Utilisateurs équipés -->
  <div class="col-12 col-sm-6 col-lg-4">
    <a href="/utilisateurs/equipes" class="card border-0 bg-light shadow-sm p-5 position-relative stat-card text-decoration-none text-dark">
      <div class="position-absolute top-0 start-0 end-0"
           style="height:5px; background:linear-gradient(135deg,#28a745,#20c997);"></div>

      <div class="d-flex justify-content-between align-items-start">
        <div>
          <h4 class="fw-bold text-muted mb-2">Equipements enregistrés</h4>
          <div class="d-flex align-items-baseline gap-2">
            <span class="fs-1 fw-bold text-dark">{{ $equipements->count() }}</span>
            <span class="small text-muted">Matériels informatique enregistré</span>
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-center rounded p-3"
             style="background:linear-gradient(135deg,#28a745,#20c997); width:64px; height:64px;">
          <i class="bi bi-laptop fs-3 text-white"></i>
        </div>
      </div>

      <div class="position-absolute bottom-0 end-0 opacity-25" style="width:100px; height:100px;">
        <i class="bi bi-laptop" style="font-size:100px;"></i>
      </div>
    </a>
  </div>

  <!-- Utilisateurs non équipés -->
  <div class="col-12 col-sm-6 col-lg-4">
    <a href="/utilisateurs/non-equipes" class="card border-0 bg-light shadow-sm p-5 position-relative stat-card text-decoration-none text-dark">
      <div class="position-absolute top-0 start-0 end-0"
           style="height:5px; background:linear-gradient(90deg,#ff7f50,#ffb347);"></div>

      <div class="d-flex justify-content-between align-items-start">
        <div>
          <h4 class="fw-bold text-muted mb-2">Logiciels Actifs</h4>
          <div class="d-flex align-items-baseline gap-2">
            <span class="fs-1 fw-bold text-dark">{{ $licences->count() }}</span>
            <span class="small text-muted">licences inactifs</span>
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-center rounded p-3"
             style="background:linear-gradient(90deg,#ff7f50,#ffb347); width:64px; height:64px;">
          <i class="bi bi-slash-circle fs-3 text-white"></i>
        </div>
      </div>

      <div class="position-absolute bottom-0 end-0 opacity-25" style="width:100px; height:100px;">
        <i class="bi bi-slash-circle" style="font-size:100px;"></i>
      </div>
    </a>
  </div>
</div>
 <!-- Inventaire des équipements par catégorie -->
                    <div class="row g-4 mb-4">
                        <div class="col-12">
                            <div class="chart-card bg-light">
                                <h5 class="fw-bold mb-4">Inventaire par catégorie</h5>
                                <div class="equipment-grid">
                                    <div class="equipment-item">
                                        <i class="bi bi-laptop fs-2 text-primary"></i>
                                        <div class="mt-2 fw-bold">{{ $ordinateurs_portables->count() }}</div>
                                        <small class="text-muted">Portables</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-pc-display fs-2 text-info"></i>
                                        <div class="mt-2 fw-bold">{{ $ordinateurs_allinone->count() }}</div>
                                        <small class="text-muted">All-in-one</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-hdd-rack fs-2 text-secondary"></i>
                                        <div class="mt-2 fw-bold">{{ $unites_centrales->count() }}</div>
                                        <small class="text-muted">Unités centrales</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-printer fs-2 text-danger"></i>
                                        <div class="mt-2 fw-bold">{{ $imprimantes->count() }}</div>
                                        <small class="text-muted">Imprimantes</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-display fs-2 text-warning"></i>
                                        <div class="mt-2 fw-bold">{{ $ecrans->count() }}</div>
                                        <small class="text-muted">Écrans</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-server fs-2 text-success"></i>
                                        <div class="mt-2 fw-bold">{{ $serveurs->count() }}</div>
                                        <small class="text-muted">Serveurs</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-router fs-2 text-primary"></i>
                                        <div class="mt-2 fw-bold">{{ $routeurs->count() }}</div>
                                        <small class="text-muted">Routeurs</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-diagram-3 fs-2 text-info"></i>
                                        <div class="mt-2 fw-bold">{{ $switchs->count() }}</div>
                                        <small class="text-muted">Switchs</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-battery-charging fs-2 text-warning"></i>
                                        <div class="mt-2 fw-bold">{{ $onduleurs->count() }}</div>
                                        <small class="text-muted">Onduleurs</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-projector fs-2 text-danger"></i>
                                        <div class="mt-2 fw-bold">{{ $projecteurs->count() }}</div>
                                        <small class="text-muted">Projecteurs</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-telephone fs-2 text-success"></i>
                                        <div class="mt-2 fw-bold">{{ $telephones_ip->count() }}</div>
                                        <small class="text-muted">Téléphones IP</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-keyboard fs-2 text-secondary"></i>
                                        <div class="mt-2 fw-bold">{{ $claviers->count() }}</div>
                                        <small class="text-muted">Claviers</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-mouse fs-2 text-primary"></i>
                                        <div class="mt-2 fw-bold">{{ $souris->count() }}</div>
                                        <small class="text-muted">Souris</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-upc-scan fs-2 text-info"></i>
                                        <div class="mt-2 fw-bold">{{ $scanners->count() }}</div>
                                        <small class="text-muted">Scanners</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-shield-check fs-2 text-danger"></i>
                                        <div class="mt-2 fw-bold">{{ $parefeux->count() }}</div>
                                        <small class="text-muted">Pare-feu</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-files fs-2 text-warning"></i>
                                        <div class="mt-2 fw-bold">{{ $photocopieuses->count() }}</div>
                                        <small class="text-muted">Photocopieuses</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-hdd-stack fs-2 text-success"></i>
                                        <div class="mt-2 fw-bold">{{ $stockages->count() }}</div>
                                        <small class="text-muted">Stockages</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-camera-video fs-2 text-primary"></i>
                                        <div class="mt-2 fw-bold">{{ $visio->count() }}</div>
                                        <small class="text-muted">Visio</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-tools fs-2 text-secondary"></i>
                                        <div class="mt-2 fw-bold">{{ $outillages_techniques->count() }}</div>
                                        <small class="text-muted">Outillages</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-plug fs-2 text-warning"></i>
                                        <div class="mt-2 fw-bold">{{ $accessoires_electriques->count() }}</div>
                                        <small class="text-muted">Acc. électriques</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-ethernet fs-2 text-info"></i>
                                        <div class="mt-2 fw-bold">{{ $accessoires_reseau->count() }}</div>
                                        <small class="text-muted">Acc. réseau</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-shield-lock fs-2 text-danger"></i>
                                        <div class="mt-2 fw-bold">{{ $accessoires_securite->count() }}</div>
                                        <small class="text-muted">Acc. sécurité</small>
                                    </div>
                                    <div class="equipment-item">
                                        <i class="bi bi-three-dots fs-2 text-secondary"></i>
                                        <div class="mt-2 fw-bold">{{ $autres->count() }}</div>
                                        <small class="text-muted">Autres</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <!-- Charts Row -->
<div class="row g-4 mb-4">

    <!-- 🟦 COLONNE GAUCHE : Maintenance + Licences (vertical) -->
    <div class="col-lg-8 d-flex flex-column gap-4">

        <!-- 📈 Maintenance -->
        <div class="chart-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Demandes de maintenance mensuelles</h5>
            </div>
            <canvas id="lineChart" height="80"></canvas>
        </div>

        <!-- 🧾 Licences -->
        <div class="chart-card">
            <h5 class="fw-bold mb-3">État des licences</h5>
            <canvas id="licencesChart" height="150"></canvas>
        </div>

    </div>

    <!-- 🟩 COLONNE DROITE : Équipements -->
    <div class="col-lg-4">

        <div class="chart-card h-100">
            <h5 class="fw-bold mb-3">État des équipements</h5>
            <canvas id="equipmentChart" height="200"></canvas>

            <div class="mt-3">
                <div class="d-flex justify-content-between mb-2">
                    <span><i class="bi bi-circle-fill me-2" style="color:#2f3a6dff;"></i>En stock</span>
                    <span class="fw-bold">{{ $equipementsEnStock->count() }}</span>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span><i class="bi bi-circle-fill text-success me-2"></i>En service</span>
                    <span class="fw-bold">{{ $equipementsEnService->count() }}</span>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span><i class="bi bi-circle-fill text-warning me-2"></i>Maintenance</span>
                    <span class="fw-bold">{{ $equipementsEnMaintenance->count() }}</span>
                </div>

            </div>

        </div>

    </div>

</div>
    <script>
        // Line Chart - Demandes de maintenance
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartData['demandes']['labels']) !!},
                datasets: [{
                    label: 'Demandes de maintenance',
                    data: {!! json_encode($chartData['demandes']['values']) !!},
                    borderColor: '#ff7f50',
                    backgroundColor: 'rgba(255, 127, 80, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Doughnut Chart - Équipements
        const equipmentCtx = document.getElementById('equipmentChart').getContext('2d');
        new Chart(equipmentCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartData['equipements']['labels']) !!},
                datasets: [{
                    data: {!! json_encode($chartData['equipements']['values']) !!},
                    backgroundColor: [
    '#2f3a6dff', // bleu clair pastel (INFO)
    '#71dd8a', // vert doux (SUCCESS)
    '#ffe08a', // jaune pastel (WARNING)
],

                    borderWidth: 2,
                    borderColor: '#fdfbfbef'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Bar Chart - Licences
        const licencesCtx = document.getElementById('licencesChart').getContext('2d');
        new Chart(licencesCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartData['licences']['labels']) !!},
                datasets: [{
                    label: 'Nombre de licences',
                    data: {!! json_encode($chartData['licences']['values']) !!},
                    backgroundColor: [
            '#f28b82', // rouge rosé doux
            '#ffe08a', // jaune pastel
            '#71dd8a'  // vert doux
        ],

                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

       
    </script>
@endsection