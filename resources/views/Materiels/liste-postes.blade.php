@extends('layouts.main-board')
@section('title', 'Gestion des materiels en service')
@section('content')
{{-- Select2 CSS --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Style du Select2 dans le modal */
    .select2-container--default .select2-selection--single {
        background-color: #f9fafb !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 5px!important;
        height: 40px !important;
        padding: 10px 18px !important;
        display: flex;
        align-items: center;
        font-size: 15px;
        transition: all .2s ease-in-out;
    }

    .select2-container--default .select2-selection--single:hover {
        border-color: #3b82f6 !important;
        box-shadow: 0 4px 10px rgba(59,130,246,0.15);
    }

    /* Texte sélectionné */
    .select2-selection__rendered {
        line-height: 30px !important;
        color: #374151 !important;
        font-weight: 500;
    }

    /* Flèche */
    .select2-selection__arrow {
        height: 100% !important;
        right: 15px !important;
    }

    /* Zone de recherche */
    .select2-container--default .select2-search--dropdown .select2-search__field {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #d1d5db;
    }

    /* Dropdown list */
    .select2-container--default .select2-results > .select2-results__options {
        max-height: 220px !important;
        padding: 5px;
    }

    .select2-results__option {
        padding: 10px 12px;
        border-radius: 8px;
        margin-bottom: 4px;
        font-size: 14px;
        transition: background .15s ease;
    }

    .select2-results__option--highlighted {
        background: #3b82f6 !important;
        color: white !important;
    }

    /* Conteneur de dropdown dans modal */
    .select2-container {
        width: 100% !important;
    }
</style>

    <div class="page-header d-flex justify-content-between align-items-center my-4">
<header class="">
  <h1 class="h3 fw-bold text-dark mb-1 d-flex align-items-center">
    Gestion des Postes Informatiques ({{ $postes->count() }})
  </h1>
  <p class="text-muted mb-0">
    Liste des materiels • desktop
  </p>
</header>

        <div class="header-actions d-flex justify-content-end gap-3 flex-wrap">
            <a href="{{ route('poste-complet.create') }}" class="btn text-white bg-success"><i class="fas fa-plus me-2"></i>Créer un nouveau poste</a>
        </div>
    </div>
    <!-- Tableau des postes -->
    <div class="postes-section">
        <div class="table-container">
            <table class="postes-table">
                <thead style="background-color: #f3902e;">
                    <tr>
                        <th>Code Poste</th>
                        <th>Designation poste</th>
                        <th>Utilisateur</th>
                        <th>Composants</th>
                        <th>Date Création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($postes as $poste)
                    <tr class="poste-row">
                        <td>
                            <strong>{{ $poste->code_poste }}</strong>
                        </td>
                        <td>{{ $poste->emplacement }}</td>
                        <td>
                            <span class="utilisateur">{{ $poste->user ? $poste->user->nom : 'Non affecté' }}</span>
                        </td>
                        <td>
                            <span class="equipment-count">{{ $poste->equipements->count() }}</span>
                        </td>
                        <td>{{ $poste->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <button type="button" class="btn btn-sm text-success bg-success-subtle" title="Affecter le poste" data-bs-toggle="modal" data-bs-target="#modalAffecterPoste{{ $poste->id }}">
                                    <i class="fas fa-user-check"></i>
                                </button>

                                <form action="{{ route('postes.destroy', $poste->id) }}" Onsubmit="return confirm('Voulez-vous vraiment supprimer ce poste ?')" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-danger bg-danger-subtle"><i class="fas fa-trash"></i></button>
                                </form>
                                <a href="{{ route('postes.print', $poste->id) }}" class="btn btn-sm text-primary" title="Imprimer la fiche du poste">
                                    <i class="fas fa-print"></i>
                                </a>
                                <button class="btn btn-sm text-primary toggle-details" data-post-id="{{ $poste->id }}">
                                    <span class="show-text">Détails <i class="fas fa-info-circle"></i></span>
                                    <span class="hide-text" style="display:none">Masquer <i class="fas fa-eye-slash"></i></span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr class="details-row" id="details-{{ $poste->id }}" style="display:none">
                        <td colspan="6" class="details-cell">
                            <div class="details-content">
                                <div class="equipment-section">
                                    @if($poste->equipements->isEmpty())
                                        <div class="empty-state">
                                            <p>Aucun équipement associé à ce poste</p>
                                        </div>
                                    @else
                                        @php $uc = $poste->equipements->where('categorie', 'unite centrale')->first(); @endphp
                                        @if($uc)
                                            <div class="equipment-group d-flex justify-content-between align-item-center">
                                            <div class="info-section">
                                                    <h3 class="text-align-center">Code Poste : {{ $poste->code_poste }}</h3>
                                                    <div class="info-grid">
                                                        <div class="modal-body text-center">
                                                            @if($poste->qr_code)
                                                                <img src="{{ asset('storage/' . $poste->qr_code) }}" alt="QR Code" class="qr-image">
                                                                <div class="mt-3">
                                                                    <a href="{{ asset('storage/' . $poste->qr_code) }}" download="qr-code-{{ $poste->code_poste }}.svg" class="btn btn-download">
                                                                        Télécharger
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="equipment-card main-unit border-0" >
                                                    <div class="equipment-header">
                                                        <span class="serial">N° Série: {{ $uc->numero_serie }}</span>
                                                        <span class="status status-{{ $uc->etat }}">{{ ucfirst($uc->etat) }}</span>
                                                    </div>
                                                    <div class="equipment-details">
                                                        <div class="detail-row">
                                                            <span class="detail-label">Marque:</span>
                                                            <span class="detail-value">{{ $uc->marque ?? 'N/A' }}</span>
                                                        </div>
                                                        <div class="detail-row">
                                                            <span class="detail-label">Modèle:</span>
                                                            <span class="detail-value">{{ $uc->modele ?? 'N/A' }}</span>
                                                        </div>
                                                        <div class="detail-row">
                                                            <span class="detail-label">Processeur:</span>
                                                            <span class="detail-value">{{ $uc->processeur ?? 'N/A' }}</span>
                                                        </div>
                                                        <div class="detail-row">
                                                            <span class="detail-label">RAM:</span>
                                                            <span class="detail-value">{{ $uc->ram ?? 'N/A' }} Go</span>
                                                        </div>
                                                        <div class="detail-row">
                                                            <span class="detail-label">Système:</span>
                                                            <span class="detail-value">{{ $uc->systeme ?? 'N/A' }}</span>
                                                        </div>
                                                        <div class="detail-row">
                                                            <span class="detail-label">Adresse MAC:</span>
                                                            <span class="detail-value">{{ $uc->adresse_mac ?? 'N/A' }}</span>
                                                        </div>

                                                    </div>
                                                    <div class="equipment-actions">
                                                        <a href="/equipement_details/{{$uc->id}}" class="btn btn-sm text-primary">Voir détails <i class="fas fa-info-circle"></i></a>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        @endif
                                        @foreach($poste->equipements->whereIn('categorie', ['souris', 'clavier', 'ecran'])->groupBy('categorie') as $categorie => $equipements)
                                            <div class="equipment-group">
                                                <h4 class="bg-success text-white p-2">{{ $categorie }}</h4>
                                                <div class="equipment-table">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th>Utilisateur </th>
                                                                <th>N° Série</th>
                                                                <th>Marque</th>
                                                                <th>Modèle</th>
                                                                <th>État</th>
                                                                <th>Date</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($equipements as $equipement)
                                                            
                                                            <tr>
                                                            <td>
                                                                    @php
                                                                        $lastAssignment = $equipement->assignments->where('returned_at', null)->sortByDesc('assigned_at')->first();
                                                                        if (!$lastAssignment) {
                                                                            $lastAssignment = $equipement->assignments->sortByDesc('assigned_at')->first();
                                                                        }
                                                                    @endphp
                                                                    @if($lastAssignment && $lastAssignment->user)
                                                                        {{ $lastAssignment->user->nom }} {{ $lastAssignment->user->prenom }}
                                                                    @else
                                                                        <span class="text-muted">Non assigné</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $equipement->numero_serie }}</td>
                                                                <td>{{ $equipement->marque ?? 'N/A' }}</td>
                                                                <td>{{ $equipement->modele ?? 'N/A' }}</td>
                                                                <td>
                                                                    <span class="status status-{{ $equipement->etat }}">
                                                                        {{ ucfirst($equipement->etat) }}
                                                                    </span>
                                                                </td>
                                                                <td>{{ $equipement->created_at->format('d/m/Y') }}</td>
                                                                <td>
                                                                    <a href="/equipement_details/{{$equipement->id}}" class="btn btn-sm text-primary">Détails <i class="fas fa-info-circle"></i></a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@foreach($postes as $poste)
    <div class="modal fade" id="modalAffecterPoste{{ $poste->id }}" tabindex="-1" aria-labelledby="modalAffecterPosteLabel{{ $poste->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAffecterPosteLabel{{ $poste->id }}">Affecter le poste {{$poste->code_poste }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">                              
                    <form action="{{ route('assigner_poste', $poste->id) }}" method="POST">
                        @csrf
                        <select name="user_id" class="form-control" id="user_id_select2_{{ $poste->id }}" required>
                            <option value="">Sélectionner un utilisateur</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenom }} - {{$user->matricule }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-success mt-3 w-100">Affecter <i class="fas fa-user me-3"></i></button>
                    </form> 
                </div>
            </div>
        </div>
@endforeach

<style>
/* Variables CSS */
:root {
    --primary-color: #2c3e50;
    --secondary-color: #34495e;
    --accent-color: #3498db;
    --success-color: #27ae60;
    --warning-color: #f39c12;
    --danger-color: #e74c3c;
    --light-bg: #f8f9fa;
    --white: #ffffff;
    --text-primary: #2c3e50;
    --text-secondary: #6c757d;
    --border-color: #dee2e6;
    --border-radius: 6px;
    --shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.container {
    max-width: 1200px;
    margin: 0 auto;
}

/* En-tête */
.page-header {
    margin-bottom: 10px;
}

.page-header h1 {
    font-size: 28px;
    font-weight: 600;
    color: var(--primary-color);
    margin: 0 0 10px 0;
}

.breadcrumb {
    font-size: 14px;
    color: var(--text-secondary);
}

.breadcrumb a {
    color: var(--accent-color);
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

.table-container {
    overflow-x: auto;
}

/* Tableau principal */
.postes-table {
    width: 100%;
    border-collapse: collapse;
}

.postes-table thead {
    background-color: var(--primary-color);
    color: var(--white);
}

.postes-table th,
.postes-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}

.postes-table th {
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.poste-row:hover {
    background-color: var(--light-bg);
}

/* Colonnes */
.col-code {
    width: 15%;
}

.col-location {
    width: 25%;
}

.col-date {
    width: 15%;
}

.col-count {
    width: 10%;
    text-align: center;
}

.col-actions {
    width: 35%;
    text-align: right;
}

.col-code strong {
    color: var(--primary-color);
    font-weight: 600;
}

.equipment-count {
    background-color: #009e60;
    color: var(--white);
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

/* Boutons d'action */
.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: flex-end;
}

/* Section des détails */
.details-row {
    background-color: var(--light-bg);
}

.details-cell {
    padding: 0 !important;
}

.details-content {
    padding: 25px;

}

/* Informations du poste */
.info-section h3 {
    font-size: 18px;
    font-weight: 600;
    color: var(--primary-color);
    padding-bottom: 10px;
}

.info-grid {
    display: grid;
    gap: 15px;
    margin-bottom: 25px;
    padding:8px;
}

.info-item {
    display: flex;
    align-items: center;
}

.info-item label {
    font-weight: 600;
    color: var(--text-secondary);
    width: 120px;
    margin: 0;
}

.info-item span {
    color: var(--text-primary);
}

.management-actions {
    display: flex;
    gap: 10px;
}

/* Section équipements */
.equipment-section h3 {
    font-size: 18px;
    font-weight: 600;
    color: var(--primary-color);
}

.empty-state {
    text-align: center;
    padding: 40px;
    color: var(--text-secondary);
    border: 2px dashed var(--border-color);
    border-radius: var(--border-radius);
}

.equipment-group {
    margin-bottom: 25px;
}

.equipment-group h4 {
    font-size: 16px;
    font-weight: 600;
    color: var(--secondary-color);
    margin: 0 0 15px 0;
}

/* Carte unité centrale */
.equipment-card {
    background: var(--white);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    padding: 20px;
    margin-bottom: 15px;
    width: 700px;
}

.equipment-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.serial {
    font-size: 15px;
    color: var(--text-secondary);
    font-family: monospace;
}

.equipment-details {
    display: block;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 10px;
}

.detail-row {
    display: flex;
    gap: 10px;
    align-items: center;
    margin-bottom: 14px;
}

.detail-label {
    font-weight: 700;
    color: var(--text-secondary);
    width: 150px;
    font-size: 13px;
}

.detail-value {
    color: var(--text-primary);
    font-size: 13px;
}

.equipment-actions {
    display: flex;
    justify-content: flex-end;
}

/* Tableau des équipements */
.equipment-table {
    overflow-x: auto;
}

.equipment-table table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.equipment-table th,
.equipment-table td {
    padding: 10px 12px;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}

.equipment-table th {
    background-color: var(--light-bg);
    font-weight: 600;
    color: var(--text-primary);
}

.equipment-table tr:hover {
    background-color: var(--light-bg);
}

/* Boutons */
.btn {
    display: inline-block;
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    border: none;
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 12px;
}

.btn-details {
    background-color: var(--accent-color);
    color: var(--white);
}

.btn-details:hover {
    background-color: #2980b9;
}

.btn-qr {
    background-color: var(--success-color);
    color: var(--white);
}

.btn-qr:hover {
    background-color: #229954;
}

.btn-edit {
    background-color: var(--warning-color);
    color: var(--white);
}

.btn-edit:hover {
    background-color: #e67e22;
}

.btn-delete {
    background-color: var(--danger-color);
    color: var(--white);
}

.btn-delete:hover {
    background-color: #c0392b;
}

.btn-download {
    background-color: var(--success-color);
    color: var(--white);
}

.btn-download:hover {
    background-color: #229954;
}

.btn-secondary {
    background-color: #6c757d;
    color: var(--white);
}

.btn-secondary:hover {
    background-color: #5a6268;
}

/* Statuts */
.status {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
}

.status-bon {
    background-color: #d4edda;
    color: #155724;
}

.status-moyen {
    background-color: #fff3cd;
    color: #856404;
}

.status-mauvais {
    background-color: #f8d7da;
    color: #721c24;
}

.status-en_service {
    background-color: #d1ecf1;
    color: #0c5460;
}

.status-en_stock {
    background-color: #e2e3e5;
    color: #383d41;
}

/* Modals */
.modal-content {
    border-radius: var(--border-radius);
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.modal-header {
    background-color: var(--primary-color);
    color: var(--white);
    border-radius: var(--border-radius) var(--border-radius) 0 0;
}

.modal-title {
    font-weight: 600;
}

.btn-close {
    background: none;
    border: none;
    color: var(--white);
    font-size: 20px;
    opacity: 0.8;
}

.btn-close:hover {
    opacity: 1;
}

.qr-image {
    max-width: 100%;
    height: auto;
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
}

.text-warning {
    color: var(--warning-color);
}

.text-muted {
    color: var(--text-secondary);
}

/* Responsive */
@media (max-width: 992px) {
    .details-content {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .equipment-details {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .container {
        padding: 15px;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 5px;
    }
    
    .management-actions {
        flex-direction: column;
        gap: 8px;
    }
    
    .btn {
        font-size: 13px;
        padding: 6px 12px;
    }
    
    .postes-table th,
    .postes-table td {
        padding: 8px 10px;
        font-size: 13px;
    }
}

@media (max-width: 576px) {
    .info-item {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .info-item label {
        width: auto;
        margin-bottom: 5px;
    }
    
    .equipment-table {
        font-size: 12px;
    }
    
    .equipment-table th,
    .equipment-table td {
        padding: 6px 8px;
    }
}

</style>

<script>
$(document).ready(function() {
    // Gestion des boutons de suppression
    $('.delete-poste').click(function() {
        var posteId = $(this).data('id');
        var url = "{{ route('postes.destroy', ':id') }}".replace(':id', posteId);
        $('#deletePosteForm').attr('action', url);
        $('#deletePosteModal').modal('show');
    });

    // Gestion des boutons pour afficher/masquer les détails
    $('.toggle-details').click(function() {
        var postId = $(this).data('post-id');
        var details = $('#details-' + postId);
        
        if (details.is(':visible')) {
            details.hide();
            $(this).find('.show-text').show();
            $(this).find('.hide-text').hide();
        } else {
            details.show();
            $(this).find('.show-text').hide();
            $(this).find('.hide-text').show();
        }
    });

    // Initialisation de Select2 pour chaque modal d'affectation de poste
    @foreach($postes as $poste)
        $('#user_id_select2_{{ $poste->id }}').select2({
            dropdownParent: $('#modalAffecterPoste{{ $poste->id }}')
        });
    @endforeach
});
</script>
@endsection