@extends('layouts.main-board')
@section('title', 'Gestion des materiels en stock')
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
    .select2-selection__rendered {
        line-height: 30px !important;
        color: #374151 !important;
        font-weight: 500;
    }
    .select2-selection__arrow {
        height: 100% !important;
        right: 15px !important;
    }
    .select2-container--default .select2-search--dropdown .select2-search__field {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #d1d5db;
    }
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
    .select2-container {
        width: 100% !important;
    }
</style>

<div class="en-tete d-flex flex-column flex-md-row align-items-center justify-content-between py-4">

<header class="">
  <h1 class="h3 fw-bold text-dark mb-1 d-flex align-items-center">
    Gestion des Equipements Informatiques
  </h1>
  <p class="text-muted mb-0">
    Liste des Equipements • En Stock
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

@if($materielsEnStock->count() > 0)
<div class="table-responsive shadow-sm rounded">
  <table class="table table-striped table-hover align-middle mb-0">
    <thead class="table-dark">
      <tr>
        <th>Designation</th>
        <th>Catégorie</th>
        <th>Marque</th>
        <th>N° Série</th>
        <th>État</th>
        <th>Date Acquisition</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($materielsEnStock as $materiel)
      <tr>
        <td>{{ $materiel->des_equipement }}</td>
        <td>{{ $materiel->categorie }}</td>
        <td>{{ $materiel->marque }}</td>
        <td>{{ $materiel->numero_serie }}</td>
        <td>{{ $materiel->etat }}</td>
        <td>{{ $materiel->date_acquis ?? 'Non spécifié' }}</td>
        <td class="text-center">
          <div class="dropdown">
            <button class="btn btn-sm btn-light dropdown-toggle" 
                    type="button" 
                    id="dropdownMenuButtonMateriel{{ $materiel->id }}" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="/update_equipemnt/{{ $materiel->id }}">
                  <i class="bi bi-pencil me-2 text-primary"></i> Modifier
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="/equipement_details/{{ $materiel->id }}">
                  <i class="bi bi-info-circle me-2 text-warning"></i> Détails
                </a>
              </li>
              <li>
                <button class="dropdown-item d-flex align-items-center py-2 px-3 rounded-2" 
                        data-bs-toggle="modal" 
                        data-bs-target="#assignEquipementModal" 
                        data-equipement-id="{{ $materiel->id }}">
                  <i class="bi bi-person-workspace me-2"></i> Assigner cet équipement
                </button>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item text-danger" 
                   href="/delete_ordinateur/{{ $materiel->id }}" 
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
<div class="text-center py-4 mt-4">
  <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
  <p class="text-muted">Aucun matériel en stock</p>
</div>
@endif


{{-- jQuery + Select2 --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {

    /* -------------------------
       1️⃣ Modal Assign → récup ID
    ------------------------- */
    const assignModal = document.getElementById('assignEquipementModal');

    assignModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const equipementId = button.getAttribute('data-equipement-id');
        assignModal.querySelector('#equipement_id').value = equipementId;
    });


    /* -------------------------
       2️⃣ Select2 AJAX
    ------------------------- */
    $('#user_id').select2({
        dropdownParent: $('#assignEquipementModal'),
        placeholder: "-- Choisissez un utilisateur --",
        allowClear: true,
        ajax: {
            url: "{{ route('users.search') }}",  // 🔥 route Laravel pour AJAX
            dataType: 'json',
            delay: 250,
            data: params => ({ q: params.term }),
            processResults: function (data) {
                return {
                    results: data.map(user => ({
                        id: user.id,
                        text: `${user.nom} ${user.prenom} - ${user.matricule}`
                    }))
                };
            }
        }
    });

});
</script>

{{-- =====================
      MODAL ASSIGNATION
====================== --}}
<div class="modal fade" id="assignEquipementModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content mt-5">
            <div class="modal-header">
                <h5 class="modal-title">Attribuer un Matériel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('assign.equipement') }}">
                    @csrf
                    <input type="hidden" name="equipement_id" id="equipement_id">

                    <div class="mb-3">
                        <select class="form-select" id="user_id" name="user_id" required></select>
                    </div>

                    <button type="submit" class="fluid ui medium primary button" style="margin-top: 20px; text-align: center;">
                        Attribuer <span uk-icon="check"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
