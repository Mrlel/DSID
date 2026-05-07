@extends('layouts.main-board')
@section('title', 'Gestion des Assignations')
@section('content')

<div class="row mt-4">
    <div class="col">
        <div class="mb-4 p-3 rounded d-flex justify-content-between align-items-center">

            <!-- HEADER -->
            <header>
                <h1 class="h3 fw-bold text-dark mb-1 d-flex align-items-center">
                    Historique des Attributions d'Équipements
                </h1>
                <p class="text-muted mb-0">
                    Liste des Equipements • Assignés aux personnels
                </p>
            </header>

            <!-- BUTTONS -->
            <div class="d-flex gap-2">
             

                <a href="/preview-pdf" class="btn btn-success">
                    <i class="bi bi-filetype-pdf me-1"></i> Exporter en PDF
                </a>
            </div>
        </div>
    </div>
</div>
<div class="card shadow-0 bg-light border-0 mb-4">
    <div class="card-body">
<h3>Filtres et recherche</h3>
        <div class="row g-3">

            <!-- Search -->
            <div class="col-md-6">
                <input id="searchInput" type="text" class="form-control"
                       placeholder="Rechercher un utilisateur ou un équipement...">
            </div>

            <!-- Filter: Utilisateur 
            <div class="col-md-3">
                <select id="filterUser" class="form-select">
                    <option value="">— Tous les utilisateurs —</option>

                    @foreach($assignments->pluck('user.nom')->unique() as $user)
                        @if($user)
                            <option value="{{ $user }}">{{ $user }}</option>
                        @endif
                    @endforeach
                </select>
            </div>-->
        </div>

    </div>
</div>

<!-- TABLE -->
<div class="card shadow-sm border-0">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Réception</th>
                    <th>Agent</th>
                    <th>Remetteur</th>
                    <th>Équipement</th>
                    <th>Date d'attribution</th>
                    <th>Heure</th>
                    <th>Statut</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($assignments->sortBy('returned_at') as $assignment)
                <tr class="searchable-row">

                    <!-- Status icon -->
                    <td>
                        @if($assignment->confirmed)
                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                        @else
                            <i class="bi bi-x-circle-fill text-warning fs-5"></i>
                        @endif
                    </td>

                    <td>{{ optional($assignment->user)->nom }}</td>
                    <td>{{ optional($assignment->assignedBy)->nom ?? 'Inconnu' }}</td>

                    <!-- Equipment -->
                    <td>
                        {{ $assignment->equipement->nom }} - {{ $assignment->equipement->marque }} <br>
                        <small class="text-muted">
                            N° Série: {{ $assignment->equipement->numero_serie }}
                        </small>
                    </td>

                    <td>{{ \Carbon\Carbon::parse($assignment->assigned_at)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($assignment->assigned_at)->format('H:i') }}</td>

                    <!-- Status badge -->
                    <td>
                        @if($assignment->returned_at )
                            <span class="badge bg-success-subtle text-success">Retourné</span>
                        @elseif (!$assignment->returned_at && $assignment->confirmed)
                            <span class="badge bg-primary-subtle text-primary">En service</span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary">En attente de confirmation</span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="text-center">

                        @if(!$assignment->returned_at)
                        <button class="btn btn-warning btn-sm px-3"
                                data-bs-toggle="modal"
                                data-bs-target="#retraitModal{{ $assignment->id }}">
                                <i class="bi bi-arrow-counterclockwise"></i> Retirer
                        </button>
                        @else
                        <button class="btn btn-outline-success btn-sm px-3"
                                data-bs-toggle="modal"
                                data-bs-target="#causeModal{{ $assignment->id }}">
                                <i class="bi bi-info-circle"></i> Cause du retrait
                        </button>
                        @endif
                    </td>
                </tr>

                <!-- Modal: Cause du retrait -->
                <div class="modal fade" id="causeModal{{ $assignment->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content shadow-sm">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    Cause du retrait — {{ $assignment->equipement->des_equipement }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                {{ $assignment->commentaire_retour ?? 'Aucun commentaire fourni.' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal: Retrait -->
                <div class="modal fade" id="retraitModal{{ $assignment->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content shadow-sm">
                            <div class="modal-header">
                                <h5 class="modal-title">Retrait d'équipement</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <p>Confirmez-vous le retrait de :</p>

                                <ul class="mb-3">
                                    <li><strong>Équipement :</strong> {{ $assignment->equipement->des_equipement }}</li>
                                    <li><strong>Utilisateur :</strong> {{ optional($assignment->user)->nom }}</li>
                                    <li><strong>N° Série :</strong> {{ $assignment->equipement->numero_serie }}</li>
                                </ul>

                                <form action="{{ route('retourner.equipement', ['assignmentId' => $assignment->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label class="form-label">Commentaire</label>
                                        <textarea name="commentaire_retour" class="form-control" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">État au retour</label>
                                        <select class="form-select" name="etat_retour" required>
                                            <option value="bon">Bon état</option>
                                            <option value="moyen">État moyen</option>
                                            <option value="mauvais">Mauvais état</option>
                                        </select>
                                    </div>

                                    <button class="btn btn-warning w-100">Confirmer le retrait</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    // Fonction de recherche en temps réel
    function initializeSearch() {
        const searchInput = document.getElementById("searchInput");
        
        if (!searchInput) {
            console.warn("Élément searchEquipement non trouvé");
            return;
        }
        
        searchInput.addEventListener("input", function () {
            const searchTerm = this.value.toLowerCase().trim();
            const tables = document.querySelectorAll("table tbody");
            
            tables.forEach(table => {
                const rows = table.querySelectorAll("tr");
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    
                    if (searchTerm === "" || text.includes(searchTerm)) {
                        row.style.display = "table-row";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
    }
    
    // Exécuter quand le DOM est prêt
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initializeSearch);
    } else {
        initializeSearch();
    }
</script>

@endsection
