@extends('layouts.superDashboard')

@section('content')
<style>
    .stat-card {
  border-radius: 12px;
  animation: fadeIn 0.4s ease forwards;
  text-align: left;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(5px); }
  to { opacity: 1; transform: translateY(0); }
}



</style>
<div class="py-4">
  <!-- Header -->
  <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3">
    <div>
      <h1 class="fw-bold font-serif mb-1">Gestion des directions ({{ $directions->count() }})</h1>
      <p class="small text-muted">Structure organisationnelle du ministère</p>
    </div>
    
     <a href="/directions/create" class="panel-btn"><i class="fas fa-plus"></i> Nouvelle direction</a>
  </div>

  <!-- Grid -->
  <div class="row g-4">
    <!-- Exemple de card direction -->
    @foreach ($directions as $direction)
    <div class="col-12 col-md-6 col-lg-4">
      <div class="card border-0 p-3 stat-card h-100">
        <div class="d-flex justify-content-between align-items-start">
          <!-- Icône -->
           <div>
          <div class="rounded" style="width:48px; height:48px; overflow: hidden;">
            @if($direction->logo)
                                <img src="{{ asset('storage/' . $direction->logo) }}" 
                                    alt="logo" 
                                    class="direction-logo">
                            @else
                                <img src="/nopic.jpeg" 
                                    alt="Logo par défaut" 
                                    class="direction-logo">
            @endif
          </div>
          @if ($direction->statut == 'active')
            <span class="badge border border-success text-success mt-4">Active</span>
          @else
            <span class="badge border border-danger text-danger mt-4">Inactive</span>
          @endif
        </div>
          
          <!-- Dropdown -->
        <div class="dropdown">
            <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
           <li>
            <a href="{{ route('directions.edit', $direction->id) }} " class="btn "><i class="fas fa-pen me-2"></i> Modifier</a>
          </li>
          <divider class="dropdown-divider"></divider>
          <li>
            <form action="{{ route('directions.destroy', $direction->id) }}" method="POST" style="display:inline; ">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn outline-none" style="border: none;" onclick="return confirm('Voulez-vous vraiment supprimer cette direction ?')">
                    <i class="fas fa-trash me-2"></i> Supprimer
                </button>
             </form>
          </li>
           </ul>
          </div>
        </div>

        <!-- Contenu -->
        <h5 class="fw-semibold mb-1">{{ $direction->code_direction }}</h5>
        <p class="small text-muted mb-3">{{ $direction->nom_direction }}</p>

        <!-- Footer -->
        <div class="d-flex justify-content-between align-items-center border-top pt-3">
          <div class="small">
            <span class="text-muted">Responsable:</span>
            <p class="mb-0 fw-bold">{{ $direction->responsable }}</p>
          </div>
          <div class="d-flex align-items-center gap-1 text-muted">
            <i class="fas fa-users"></i>
            <span class="fw-medium">{{ $direction->users()->count() }}</span>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#searchInput').on('keyup', function() {
        let value = $(this).val().toLowerCase();
        $("table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
</script>
@endsection
