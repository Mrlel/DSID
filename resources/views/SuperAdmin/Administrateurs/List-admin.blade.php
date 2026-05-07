@extends('layouts.superDashboard')

@section('content')



<!-- Main Panels -->
<div class="panels-row">
    <!-- Users Table Panel -->
    <div class="panel">

  <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3">
    <div>
      <h1 class="fw-bold font-serif mb-1">Gestion des utilisateurs ({{ $admins->count() }})</h1>
      <p class="small text-muted">Gérez les comptes utilisateurs des directions</p>
    </div>
      <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Rechercher un utilisateur...">
                <i class="search icon text-black"></i>
            </div>
     <a href="/directions/create-admin" class="panel-btn"><i class="fas fa-plus"></i> Nouveau utilisateur</a>
  </div>
        
        @if($admins->isEmpty())
            <p class="no-users">Aucune direction n'a été trouvée.</p>
        @else
        <table class="users-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Matricule</th>
                    <th>Contact</th>
                    <th>Direction</th>
                    <th>email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-pic u1" style="overflow: hidden">
                                @if($admin->direction && $admin->direction->logo)
                                    <img src="{{ asset('storage/' . $admin->direction->logo) }}" 
                                        alt="logo" 
                                        class="direction-logo">
                                @else
                                    <img src="/nopic.jpeg" 
                                        alt="Logo par défaut" 
                                        class="direction-logo">
                                @endif
                            </div>
                            <div>
                                <div class="user-name">{{ $admin->nom }}</div>
                                <div class="user-email text-success">{{ $admin->role }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $admin->prenom }}</td>    
                    <td>{{ $admin->matricule }}</td>
                    <td>{{ $admin->contact }}</td>
                    <td>
                        @if($admin->direction)
                            {{ $admin->direction->nom_direction }}
                        @else
                            Non affecté
                        @endif
                    </td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        <div class="user-action">
                            <a href="{{ route('directions.edit-admin', $admin->id) }}" class="action-btn"><i class="fas fa-pen"></i></a>
                            <a href="{{ route('directions.destroy-admin', $admin->id) }}" OnClick="return confirm('Voulez-vous vraiment supprimer ce utilisateur ?')" class="action-btn delete"><i class="fas fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Titre du Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="ui form" action="{{ route('directions.store-admin') }}" method="POST">
                        @csrf
                        <div class="fields">
                            <div class="field">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" name="nom" id="nom" class="form-control" required>
                            </div>
                            <div class="field">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" name="prenom" id="prenom" class="form-control" required>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="field">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="field">
                                <label for="matricule" class="form-label">Matricule</label>
                                <input type="text" name="matricule" id="matricule" class="form-control" required>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="field">
                                <label for="contact" class="form-label">Contact</label>
                                <input type="text" name="contact" id="contact" class="form-control" required>
                            </div>
                            <div class="field">
                                <label for="emploie" class="form-label">Emploi</label>
                                <input type="text" name="emploie" id="emploie" class="form-control" required>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="field">
                                <label for="fonction" class="form-label">Fonction</label>
                                <input type="text" name="fonction" id="fonction" class="form-control" required>
                            </div>
                            <div class="field">
                                <label for="grade" class="form-label">Grade</label>
                                <input type="text" name="grade" id="grade" class="form-control" required>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="field">
                                <label for="role" class="form-label">Rôle</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="admin">Administrateur</option>
                                    <option value="user">Utilisateur</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="direction_id" class="form-label">Direction</label>
                                <select name="direction_id" id="direction_id" required>
                                    <option value="">-- Sélectionner une direction --</option>
                                    @foreach($directions as $direction)
                                        <option value="{{ $direction->id }}">{{ $direction->nom_direction }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </form>
                </div>
            </div>
        </div>
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