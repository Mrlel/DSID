


<div class="en-tete d-flex flex-column flex-md-row align-items-center justify-content-between py-4">

<header class="">
  <h1 class="h3 fw-bold text-dark mb-1 d-flex align-items-center">
    Gestion des Equipements Informatiques
  </h1>
  <p class="text-muted mb-0">
    Liste des Equipements • 
  </p>
</header>

  <div class="d-flex gap-2 flex-wrap">
        <a href="/equipements/create" class="btn btn-success d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle fs-5"></i> Ajouter un equipement
        </a>
        <a href="/inventaire" class="btn btn-outline-primary d-flex align-items-center gap-2">
            <i class="bi bi-journal-text fs-5"></i> Inventaire
        </a>
        <a href="/list_historique_attribution" class="btn btn-outline-secondary d-flex align-items-center gap-2">
            <i class="bi bi-clock-history fs-5"></i> Historique
        </a>
         <a href="/adminsEquipement/{{ Auth::user()->id }}" class="btn btn-outline-dark d-flex align-items-center gap-2">
            <i class="bi bi-pc-display-horizontal fs-5"></i>
            <span>MES EQUIPEMENTS</span>
          </a>
    </div>
</div>

<!-- Stat Cards -->
 <div class="row g-4 mb-4">
  <!-- Equipements en stock -->
  <div class="col-12 col-sm-6 col-lg-4">
    <a href="/stock_materiel" class="card border-0 bg-light shadow-sm p-5 position-relative stat-card text-decoration-none text-dark">
      <!-- Decorative gradient bar -->
      <div class="position-absolute top-0 start-0 end-0" 
           style="height:5px; background:linear-gradient(90deg,#ff7f50,#ffb347);"></div>

      <div class="d-flex justify-content-between align-items-start">
        <!-- Texte -->
        <div>
          <h4 class="fw-bold text-muted mb-2">Equipements en stock</h4>
          <div class="d-flex align-items-baseline gap-2">
            <span class="fs-1 fw-bold text-dark">{{$materielsEnStock->count()}}</span>
            <span class="small text-muted">Disponibles</span>
          </div>
        </div>

        <!-- Icône -->
        <div class="d-flex align-items-center justify-content-center rounded p-3" 
             style="background:linear-gradient(135deg,#ff7f50,#ffb347); width:64px; height:64px;">
          <i class="bi bi-hdd-stack fs-3 text-white"></i>
        </div>
      </div>

      <!-- Subtle background pattern -->
      <div class="position-absolute bottom-0 end-0 opacity-25" style="width:100px; height:100px;">
        <i class="bi bi-hdd-stack" style="font-size:100px;"></i>
      </div>
    </a>
  </div>

  <!-- Equipements en service -->
  <div class="col-12 col-sm-6 col-lg-4">
    <a href="/materiels-en-service" class="card border-0 bg-light shadow-sm p-5 position-relative stat-card text-decoration-none text-dark">
      <div class="position-absolute top-0 start-0 end-0" 
           style="height:5px; background:linear-gradient(90deg,#28a745,#20c997);"></div>

      <div class="d-flex justify-content-between align-items-start">
        <div>
          <h4 class="fw-bold text-muted mb-2">Equipements en service</h4>
          <div class="d-flex align-items-baseline gap-2">
            <span class="fs-1 fw-bold text-dark">{{$materielsEnService->count()}}</span>
            <span class="small text-muted">Opérationnels</span>
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-center rounded p-3" 
             style="background:linear-gradient(135deg,#28a745,#20c997); width:64px; height:64px;">
          <i class="bi bi-arrow-repeat fs-3 text-white"></i>
        </div>
      </div>

      <div class="position-absolute bottom-0 end-0 opacity-25" style="width:100px; height:100px;">
        <i class="bi bi-arrow-repeat" style="font-size:100px;"></i>
      </div>
    </a>
  </div>

  <!-- Equipements en maintenance -->
  <div class="col-12 col-sm-6 col-lg-4">
    <a href="/materiels-en-maintenance" class="card border-0 bg-light shadow-sm p-5 position-relative stat-card text-decoration-none text-dark">
      <div class="position-absolute top-0 start-0 end-0" 
           style="height:5px; background:linear-gradient(90deg,#ff7f50,#ffb347);"></div>

      <div class="d-flex justify-content-between align-items-start">
        <div>
          <h4 class="text-muted fw-bold mb-2">Equipements en maintenance</h4>
          <div class="d-flex align-items-baseline gap-2">
            <span class="fs-1 fw-bold text-dark">{{$materielsEnMaintenance->count()}}</span>
            <span class="small text-muted">En réparation</span>
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-center rounded p-3" 
             style="background:linear-gradient(90deg,#ff7f50,#ffb347); width:64px; height:64px;">
          <i class="bi bi-gear fs-3 text-white"></i>
        </div>
      </div>

      <div class="position-absolute bottom-0 end-0 opacity-25" style="width:100px; height:100px;">
        <i class="bi bi-gear" style="font-size:100px;"></i>
      </div>
    </a>
  </div>
</div>



    <div class="head-container container-fluid py-3">
  <div class="row g-2 align-items-center justify-content-end">
    <!-- Champ de recherche -->
    <div class="col-12 col-md-6 col-lg-4">
    <div class="input-group">
        <span class="input-group-text">
        <i class="fas fa-search"></i>
        </span>
        <input 
        type="text" 
        id="searchEquipement" 
        class="form-control" 
        placeholder="Rechercher un équipement..." 
        autocomplete="off">
    </div>
    </div>

    <!-- Bouton Liste Postes -->
 

    <!-- Dropdown Actions -->
    <div class="col-12 col-md-auto">
      <div class="dropdown w-100 w-md-auto">
        <button class="btn w-100 w-md-auto dropdown-toggle border" type="button" data-bs-toggle="dropdown" 
                aria-expanded="false">
          Options
        </button>
        <ul class="dropdown-menu dropdown-menu-end p-2 border-0 shadow-lg rounded-3">
          <li>
            <a href="{{ route('poste-complet.create') }}" 
               class="dropdown-item d-flex align-items-center py-2 px-3 rounded-2 text-success hover-bg-light">
              <i class="bi bi-pc-display fs-5 me-3"></i> Former un Poste (Desktop)
            </a>
          </li>
          <li>
            <button class="dropdown-item d-flex align-items-center py-2 px-3 rounded-2 text-success hover-bg-light" 
                    data-bs-toggle="modal" data-bs-target="#importModal">
              <i class="fas fa-file-import me-3"></i> Importer equipement
            </button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fs-5 fw-semibold" id="importModalLabel">Importer des Equipements</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                 @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('equipement.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="fichier" class="form-label">Fichier Excel (.xlsx ou .xls)</label>
                            <input type="file" name="fichier" id="fichier" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-upload me-1"></i> Importer
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="posteModal" tabindex="-1" aria-labelledby="posteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fs-5 fw-semibold" id="posteModalLabel">Nouveau Poste</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('postes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-medium">Code poste</label>
                        <input type="text" class="form-control border-2 border-primary-subtle rounded-3 py-2" name="code_poste" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-medium">Emplacement</label>
                        <input type="text" class="form-control border-2 border-primary-subtle rounded-3 py-2" name="emplacement">
                    </div>
            </div>
            <div class="modal-footer border-top-0 bg-light">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                    Enregistrer le poste
                </button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal pour ajouter un document -->
<div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="addDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDocumentModalLabel">Ajouter un document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="equipement_id" id="equipement_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre du document</label>
                        <input type="text" class="form-control" id="titre" name="titre" required>
                    </div>
                    <div class="mb-3">
                        <label for="type_document" class="form-label">Type de document</label>
                        <select class="form-control" id="type_document" name="type_document" required>
                            <option value="">Sélectionnez un type</option>
                            <option value="manuel">Manuel</option>
                            <option value="garantie">Garantie</option>
                            <option value="facture">Facture</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="document" class="form-label">Fichier (Max 10MB)</label>
                        <input type="file" class="form-control" id="document" name="document" required>
                    </div>
                    <div class="mb-3">
                        <label for="document" class="form-label">Description du document</label>
                        <textarea class="form-control" name="description" id="description" placeholder="" required>
                        </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

    @if(isset($equipements))
    <div class="mt-4">
        <h5>Résultats de la recherche :</h5>
        @forelse($equipements as $equipement)
            <div>
                <strong>{{ $equipement->des_equipement }}</strong> - {{ $equipement->marque }} - {{ $equipement->modele }}
            </div>
        @empty
            <div>Aucun équipement trouvé.</div>
        @endforelse
    </div>
@endif

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Fonction de recherche en temps réel
    function initializeSearch() {
        const searchInput = document.getElementById("searchEquipement");
        
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

