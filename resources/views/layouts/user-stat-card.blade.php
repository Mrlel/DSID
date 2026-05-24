{{-- En-tête --}}
<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between py-4 gap-3">
    <div>
        <h1 class="h3 fw-bold text-dark mb-1 d-flex align-items-center gap-2">
            <i class="bi bi-person text-success"></i> Gestion du personnel
        </h1>
        <p class="text-muted mb-0">Gestion complète de tout les agents de la direction
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <button class="btn btn-success d-flex align-items-center gap-2"
         type="button" 
          data-bs-toggle="modal" 
          data-bs-target="#exampleModal">
            <i class="bi bi-plus-circle fs-5"></i> Ajouter
        </button>
        <a href="{{ route('mobiliers.inventaire') }}" class="btn btn-outline-primary d-flex align-items-center gap-2"
        type="button" 
          data-bs-toggle="modal" 
          data-bs-target="#fonctionModal">
            <i class="bi bi-briefcase fs-5"></i> Ajouter une fonction
        </a>
        <div class="dropdown">
    <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center gap-2 px-3 py-2" 
            type="button" 
            data-bs-toggle="dropdown" 
            aria-expanded="false">
      <i class="bi bi-download me-2"></i>
      Exporter
    </button>
    
    <ul class="dropdown-menu dropdown-menu-end p-2 border-0 shadow-lg rounded-3">
      
      <li>
        <button type="button" 
                class="dropdown-item d-flex align-items-center gap-2 rounded-2" 
                data-bs-toggle="modal" 
                data-bs-target="#importModal">
          <i class="bi bi-file-earmark-arrow-up fs-5 text-success"></i>
          <span>Importer (depuis Excel)</span>
        </button>
      </li>
      
      <li><hr class="dropdown-divider"></li>

      <li>
        <form action="{{ route('ExportUsers') }}" method="post" class="m-0">
          @csrf  
          <button type="submit" class="dropdown-item d-flex align-items-center gap-2 rounded-2">
            <i class="bi bi-file-earmark-pdf-fill fs-5 text-danger"></i>
            <span>Exporter en PDF</span>
          </button>
        </form>
      </li>
      
      <li>
        <form action="{{ route('ExportUsersExcel') }}" method="post" class="m-0">
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

<div class="row g-4 mb-5">
  <!-- Total utilisateurs -->
  <div class="col-12 col-sm-6 col-lg-4">
    <a href="/userlist" class="card border-0 bg-light shadow-sm p-5 position-relative stat-card text-decoration-none text-dark">
      <!-- Gradient bar -->
      <div class="position-absolute top-0 start-0 end-0"
           style="height:5px; background:linear-gradient(90deg,#ff7f50,#ffb347);"></div>

      <div class="d-flex justify-content-between align-items-start">
        <div>
          <h4 class="fw-bold text-muted mb-2">Nombre de personnel</h4>
          <div class="d-flex align-items-baseline gap-2">
            <span class="fs-1 fw-bold text-dark">{{ $users->count() }}</span>
            <span class="small text-muted">Personnel enregistré</span>
          </div>
          <div class="d-flex align-items-center gap-1 mt-2">
            <span class="small fw-semibold text-success">{{ $informaticiens->count() }}</span>
            <span class="small text-muted">personnel informaticiens</span>
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
        <div class="py-3">
          <h4 class="fw-bold text-muted mb-2">Utilisateurs équipés</h4>
          <div class="d-flex align-items-baseline gap-2">
            <span class="fs-1 fw-bold text-dark">{{ $users_equipes->count() }}</span>
            <span class="small text-muted">Comptes activés</span>
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
        <div class="py-3">
          <h4 class="fw-bold text-muted mb-2">Utilisateurs non équipés</h4>
          <div class="d-flex align-items-baseline gap-2">
            <span class="fs-1 fw-bold text-dark">{{ $users_non_equipes->count() }}</span>
            <span class="small text-muted">Comptes inactifs</span>
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
 <!-- Barre de recherche -->
  <div class="search-bar w-50 w-md-50 position-relative">
    <input type="text" id="searchInput" class="form-control ps-5" placeholder="Rechercher un utilisateur...">
    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
  </div>
  

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un nouvel utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                        <form class="ui form" action="{{ route('users.store') }}" method="POST">
                            @csrf
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrer le nom" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrer le prénom" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="matricule" class="form-label">Matricule</label>
                                    <input type="text" class="form-control" id="matricule" name="matricule" placeholder="Entrer le matricule" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Entrer l'email" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="contact" class="form-label">Contact</label>
                                    <input type="text" class="form-control" id="contact" name="contact" placeholder="Entrer le contact" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="emploie" class="form-label">Emploi</label>
                                    <input type="text" class="form-control" id="emploie" name="emploie" placeholder="Entrer l'emploi" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="fonction" class="form-label">Fonction</label>
                                    <select name="fonction_id" id="">
                                      @foreach( $fonctions as $fonc)
                                        <option value="{{ $fonc->id}}">{{ $fonc->fonction}}</option>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="grade" class="form-label">Grade</label>
                                    <input type="text" class="form-control" id="grade" name="grade" placeholder="Entrer le grade" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="date_prise_service" class="form-label">Date de première prise de service</label>
                                    <input type="date" class="form-control" id="fonction" name="date_prise_service_un" placeholder="Entrer la date de première prise de service" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="grade" class="form-label">Date de dernière prise de service</label>
                                    <input type="date" class="form-control" id="grade" name="date_prise_service" placeholder="Entrer la date de dernière prise de service" required>
                                </div>
                            </div>
                                <div class="md-6">
                                    <label for="role" class="form-label">Rôle</label>
                                    <select class="fluid ui search dropdown" id="role" name="role" required>
                                        <option value="user">Agent</option>
                                        <option value="chef_de_service">Chef de service</option>
                                        <option value="sous_directeur">Sous directeur</option>
                                        <option value="gestionnaire_parc">Gestionnaire de parc</option>
                                        <option value="technicien">Chef de service maintenance</option>
                                        <option value="directeur">Directeur</option>
                                        <option value="Admin">Administrateur</option>
                                        <option value="point_focal">Point focal</option>
                                        <option value="service_gestionnaire">Service gestionnaire</option>
                                        <option value="ministre">Ministre</option>
                                    </select>
                                </div>
   
                            <div class="modal-footer mt-4">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button class="btn btn-success" type="submit">Enregistrer l'utilisateur</button>
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
                <h4>Importer des utilisateurs</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="import-section">
                    <form action="{{ route('import.users') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="fichier">Fichier Excel (.xlsx, .xls)</label>
                            <input type="file" name="fichier" class="form-control" accept=".xlsx,.xls" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-3 w-100"><i class="fas fa-download"></i> Importer</button>
                    </form>
                </div>
                </div>
               
            </div>
        </div>
    </div>

        <div class="modal fade" id="fonctionModal" tabindex="-1" aria-labelledby="fonctionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h4>Fonction</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="import-section">
                    <form action="{{ route('fonctions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="fichier">Fonction agent</label>
                            <input type="text" name="fonction" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-3 w-100"><i class="fas fa-download"></i> Enregistrer</button>
                    </form>
                </div>
                </div>
               
            </div>
        </div>
    </div>








