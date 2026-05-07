
<div class="row g-4 mb-4">
  <!-- Total logiciels -->
  <div class="col-12 col-sm-6 col-lg-4">
    <a href="/list_logiciel" class="card border-0 bg-light shadow-sm p-5 position-relative stat-card text-decoration-none text-dark">
      <!-- Decorative gradient bar -->
      <div class="position-absolute top-0 start-0 end-0"
           style="height:5px; background:linear-gradient(135deg,#28a745,#20c997);"></div>

      <div class="d-flex justify-content-between align-items-start">
        <!-- Texte -->
        <div>
          <h4 class="fw-bold text-muted mb-2">Total logiciels</h4>
          <div class="d-flex align-items-baseline gap-2">
            <span class="fs-1 fw-bold text-dark">{{ $licences->count() }}</span>
            <span class="small text-muted">Installés</span>
          </div>
        </div>

        <!-- Icône -->
        <div class="d-flex align-items-center justify-content-center rounded p-3"
             style="background:linear-gradient(135deg,#28a745,#20c997); width:64px; height:64px;">
          <i class="bi bi-cloud-download fs-3 text-white"></i>
        </div>
      </div>

      <!-- Pattern -->
      <div class="position-absolute bottom-0 end-0 opacity-25" style="width:100px; height:100px;">
        <i class="bi bi-cloud-download" style="font-size:100px;"></i>
      </div>
    </a>
  </div>

  <!-- Logiciels bientôt expirés -->
  <div class="col-12 col-sm-6 col-lg-4">
    <a href="/logiciel_bientot_expire" class="card border-0 bg-light shadow-sm p-5 position-relative stat-card text-decoration-none text-dark">
      <div class="position-absolute top-0 start-0 end-0"
           style="height:5px; background:linear-gradient(90deg,#ffc107,#fd7e14);"></div>

      <div class="d-flex justify-content-between align-items-start">
        <div>
          <h4 class="fw-bold text-muted mb-2">Bientôt expirés</h4>
          <div class="d-flex align-items-baseline gap-2">
            <span class="fs-1 fw-bold text-dark">{{ $licencesBientotExpirees->count() }}</span>
            <span class="small text-muted">À surveiller</span>
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-center rounded p-3"
             style="background:linear-gradient(135deg,#ffc107,#fd7e14); width:64px; height:64px;">
          <i class="bi bi-hourglass-split fs-3 text-white"></i>
        </div>
      </div>

      <div class="position-absolute bottom-0 end-0 opacity-25" style="width:100px; height:100px;">
        <i class="bi bi-hourglass-split" style="font-size:100px;"></i>
      </div>
    </a>
  </div>

  <!-- Logiciels expirés -->
  <div class="col-12 col-sm-6 col-lg-4">
    <a href="/logiciel_expire" class="card border-0 bg-light shadow-sm p-5 position-relative stat-card text-decoration-none text-dark">
      <div class="position-absolute top-0 start-0 end-0"
           style="height:5px; background:linear-gradient(135deg,#28a745,#20c997);"></div>

      <div class="d-flex justify-content-between align-items-start">
        <div>
          <h4 class="fw-bold text-muted mb-2">Expirés</h4>
          <div class="d-flex align-items-baseline gap-2">
            <span class="fs-1 fw-bold text-dark">{{ $licencesExpirees->count() }}</span>
            <span class="small text-muted">Non valides</span>
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-center rounded p-3"
             style="background:linear-gradient(135deg,#28a745,#20c997); width:64px; height:64px;">
          <i class="bi bi-exclamation-triangle fs-3 text-white"></i>
        </div>
      </div>

      <div class="position-absolute bottom-0 end-0 opacity-25" style="width:100px; height:100px;">
        <i class="bi bi-exclamation-triangle" style="font-size:100px;"></i>
      </div>
    </a>
  </div>
</div>
<div class="d-flex justify-content-between align-items-center flex-wrap mt-4 gap-3">

    <!-- 🔍 Barre de recherche -->
    <div class="ui action input flex-grow-1" style="max-width: 400px;">
        <input type="text" id="searchLogiciel" placeholder="Rechercher un logiciel...">
        <button class="ui icon button">
            <i class="search icon"></i>
        </button>
    </div>

    <!-- 🟦 Boutons -->
    <div class="d-flex align-items-center gap-2 mb-4">

        <!-- 🟩 Nouveau logiciel -->
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#secondModal">
            <i class="plus circle icon"></i>
            Nouveau logiciel
        </button>

        <!-- 🔽 Dropdown Options -->
        <div class="dropdown">
            <button class="btn border dropdown-toggle" type="button" id="dropdownOptions" data-bs-toggle="dropdown" aria-expanded="false">
                Options
            </button>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownOptions">

                <!-- 
                <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#assignerModal">
                        <i class="bi bi-pc-display"></i> Assigner logiciel
                    </a>
                </li>-->

                <!-- Importer -->
                <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#importModal">
                        <i class="bi bi-upload"></i> Importer
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <!-- Export PDF -->
                <li>
                    <form action="{{ Route('export.logiciels.pdf') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center gap-2 rounded-2">
                            <i class="bi bi-file-earmark-pdf-fill fs-5 text-danger"></i>
                            <span>Exporter en PDF</span>
                        </button>
                    </form>
                </li>

                <!-- Export Excel -->
                <li>
                    <form action="{{ route('export.logiciels.excel') }}" method="post" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center gap-2 rounded-2">
                            <i class="bi bi-file-earmark-excel-fill fs-5 text-success"></i>
                            <span>Exporter en Excel</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>

</div>


<div class="modal fade" id="secondModal" tabindex="-1" aria-labelledby="secondModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 70%;">
        <div class="modal-content border-0 shadow-sm rounded">
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title fw-bold text-dark" id="secondModal_addLabel">Ajouter un Logiciel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>

            <div class="modal-body p-4">
                <form action="/logiciel/traitement" method="POST" enctype="multipart/form-data" class="ui form">
                    @csrf
                    
                    <!-- Ligne 1 -->
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Désignation</label>
                            <input type="text" class="form-control" name="designation_licence" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Type de logiciel</label>
                            <select class="ui dropdown w-100" name="type_licence" required>
                                <option value="">Sélectionner un type</option>
                                <option value="Système d'exploitation">Système d'exploitation</option>
                                <option value="Application bureautique">Application bureautique</option>
                                <option value="Logiciel de développement">Logiciel de développement</option>
                                <option value="Antivirus">Antivirus</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Date d'expiration</label>
                            <input type="date" class="form-control" name="date_expiration">
                        </div>
                    </div>

                    <!-- Ligne 2 -->
                    <div class="row g-3 mt-2">
                        <div class="col-md-4">
                            <label class="form-label">Clé de licence</label>
                            <input type="text" class="form-control" name="cle_licence">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Environnement</label>
                            <select class="ui dropdown w-100" name="environnement" required>
                                <option value="">Sélectionner l'environnement</option>
                                <option value="Windows">Windows</option>
                                <option value="Linux">Linux</option>
                                <option value="MacOS">MacOS</option>
                                <option value="Multi-plateforme">Multi-plateforme</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Langage / Version</label>
                            <input type="text" class="form-control" name="langage_version">
                        </div>
                    </div>

                    <!-- Ligne 3 -->
                    <div class="row g-3 mt-2">
                        <div class="col-md-3">
                            <label class="form-label">SGBD et version</label>
                            <input type="text" class="form-control" name="sgbd_version" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Base de données</label>
                            <select class="ui dropdown w-100" name="base_donnees">
                                <option value="">Sélectionner</option>
                                <option value="MySQL">MySQL</option>
                                <option value="PostgreSQL">PostgreSQL</option>
                                <option value="Oracle">Oracle</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Fichier BDD</label>
                            <input type="file" class="form-control" name="fichier_licence">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Fichier Application</label>
                            <input type="file" class="form-control" name="fichier_app">
                        </div>
                    </div>

                    <!-- Zone texte -->
                    <div class="mt-3">
                        <label class="form-label">Libellé du logiciel</label>
                        <textarea class="form-control" name="libelle_licence" rows="3" required></textarea>
                    </div>

                    <!-- Bouton -->
                    <div class="mt-4">
                        <button type="submit" class="btn bg-success w-100 text-white fw-bold">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h4>Importer des logiciels</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">                    
                    <div class="import-section">
                        <form action="{{ route('import.logiciels') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="fichier">Fichier Excel (.xlsx, .xls)</label>
                                <input type="file" name="fichier" class="form-control" accept=".xlsx,.xls" required>
                            </div>
                            <button type="submit" class="btn btn-success mt-4 w-100"><i class="fas fa-download me-2"></i>Importer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



<!-- Modal pour assigner un logiciel -->
<div class="modal fade" id="assignerModal" tabindex="-1" aria-labelledby="assignerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignerModalLabel">Assigner un logiciel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="ui form" action="{{ route('assigner_logiciels.store') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label>Equipements</label>
                        <div class="ui fluid search selection dropdown">
                            <input type="hidden" name="equipement_id">
                            <i class="dropdown icon"></i>
                            <div class="default text">Sélectionner un Equipement</div>
                            <div class="menu">
                                @foreach($equipements as $equipement)
                                    <div class="item" data-value="{{ $equipement->id }}">
                                        <i class="computer icon"></i>
                                        {{ $equipement->des_equipement }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Logiciel</label>
                        <div class="ui fluid search selection dropdown">
                            <input type="hidden" name="licence_id">
                            <i class="dropdown icon"></i>
                            <div class="default text">Sélectionner un logiciel</div>
                            <div class="menu">
                                @foreach($licences as $licence)
                                    <div class="item" data-value="{{ $licence->id }}">
                                        <i class="cube icon"></i>
                                        {{ $licence->designation_licence }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <button class="ui primary button fluid" type="submit">
                        <i class="user plus icon"></i>
                        Assigner
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Fonction de recherche en temps réel
    function initializeSearch() {
        const searchInput = document.getElementById("searchLogiciel");
        
        if (!searchInput) {
            console.warn("Élément searchLogiciel non trouvé");
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