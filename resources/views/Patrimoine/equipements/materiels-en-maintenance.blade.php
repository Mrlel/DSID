@extends('layouts.main-board')
@section('title', 'Gestion des materiels en maintenance')
@section('content')
<div class="en-tete d-flex flex-column flex-md-row align-items-center justify-content-between py-4">
<header class="">
  <h1 class="h3 fw-bold text-dark mb-1 d-flex align-items-center">
    Gestion des Equipements Informatiques
  </h1>
  <p class="text-muted mb-0">
    Liste des Equipements • En Maintenance
  </p>
</header>

  <div class="d-flex align-items-center gap-2">
    <a href="/list_poste" class="btn btn-success d-flex align-items-center gap-2 px-3 py-2">
      <i class="bi bi-pc-display fs-5"></i>
      <span>POSTES/DESKTOP <span class="fs-5">({{$postes->count()}})</span></span>
    </a>
    <a href="/adminsEquipement/{{ Auth::user()->id }}" class="btn btn-dark d-flex align-items-center gap-2 px-3 py-2 text-white">
     <i class="bi bi-pc-display-horizontal fs-5"></i>
      <span>MES EQUIPEMENTS</span>
    </a>
  </div>
</div>

@include('layouts.materiel-stat-card')

@if($materielsEnMaintenance->count() > 0)
<div class="table-responsive shadow-sm rounded">
  <table class="table table-striped table-hover align-middle mb-0">
    <thead class="table-dark">
      <tr>
        <th>Designation</th>
        <th>Catégorie</th>
        <th>Marque</th>
        <th>Num série</th>
        <th>État</th>
        <th>Date Acquisition</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($materielsEnMaintenance as $materiels)
      <tr>
        <td>{{ $materiels->des_equipement }}</td>
        <td>{{ $materiels->categorie }}</td>
        <td>{{ $materiels->marque }}</td>
        <td>{{ $materiels->numero_serie }}</td>
        <td>{{ $materiels->etat }}</td>
        <td>{{ $materiels->date_acquis ?? 'Non spécifié' }}</td>
        <td class="text-center">
          <div class="dropdown">
            <button class="btn btn-sm btn-light dropdown-toggle" 
                    type="button" 
                    id="dropdownMenuButtonMateriels{{ $materiels->id }}" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" 
                aria-labelledby="dropdownMenuButtonMateriels{{ $materiels->id }}">
              <li>
                <a class="dropdown-item" href="/update_equipemnt/{{ $materiels->id }}">
                  <i class="bi bi-pencil me-2 text-primary"></i> Modifier
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="/equipement_details/{{ $materiels->id }}">
                  <i class="bi bi-info-circle me-2 text-warning"></i> Détails
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item text-danger" 
                   href="/delete_ordinateur/{{ $materiels->id }}" 
                   onclick="return confirm('Voulez-vous vraiment supprimer ce matériel ?')">
                  <i class="bi bi-trash me-2"></i> Supprimer
                </a>
              </li>
            </ul>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@else
<div class="text-center py-3 mt-4">
  <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
  <p class="text-muted">Aucun matériel en maintenance</p>
</div>
@endif


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
                 document.querySelectorAll(".moreBtn").forEach(function(btn) {
    btn.addEventListener("click", function(event) {
        var content = this.nextElementSibling;
        document.querySelectorAll(".moreBtn-content").forEach(function(c) {
            if (c !== content) {
                c.classList.remove('show');
                setTimeout(function() { c.style.display = "none"; }, 300);
            }
        });
        if (content.classList.contains('show')) {
            content.classList.remove('show');
            setTimeout(function() { content.style.display = "none"; }, 300);
        } else {
            content.style.display = "block";
            setTimeout(function() { content.classList.add('show'); }, 5); // slight delay to ensure display:block is applied
        }
        event.stopPropagation();
    });
});

    const toggleSidebar = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    toggleSidebar.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');  // Ajoute ou supprime la classe 'collapsed'
      content.classList.toggle('collapsed');  // Ajoute ou supprime le décalage du contenu
    });
  </script>
       </div>
       <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content mt-5">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Attribuer un Matériel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form class="ui form" method="POST" action="{{ route('assign.equipement') }}">
    @csrf

    <!-- Sélection de l'utilisateur -->
    <div class="form-group text-center">
        <label style="margin-bottom: 10px;">Utilisateur</label>
        <br>
        <select class="fluid ui selection dropdown" name="user_id" id="user_id" class="form-control custom-select" required>
            <option value="" disabled selected>-- Sélectionnez un utilisateur --</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">
                    {{ $user->matricule }} - {{ $user->nom }}
                </option>
            @endforeach
        </select>
    </div>
<br>
    <!-- Sélection de l'équipement -->
    <div class="form-group text-center">
        <label style="margin-bottom: 10px;">Équipement</label>
        <br>
        <select class="fluid ui selection dropdown" name="equipement_id" id="equipement_id" class="form-control custom-select" required>
            <option value="" disabled selected>-- Sélectionnez un équipement --</option>
            @foreach($materielsEnStock as $materiels)
                <option value="{{ $materiels->id }}">
                    {{ $materiels->des_equipement }} {{ $materiels->modele}} -  {{ $materiels->numero_serie }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Bouton de soumission -->
    <button type="submit" class="fluid ui medium primary button " style="margin-top: 20px;text-align: center;">
         Attribuer <span uk-icon="check"></span>
    </button>
</form>

                </div>
            </div>
        </div>
@endsection