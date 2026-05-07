@extends('layouts.main-board')

@section('title', 'Gestion des utilisateurs')

@section('content')
<header class="my-4">
  <h1 class="h3 fw-bold text-dark mb-1 d-flex align-items-center">
    Gestion du personnel informaticiens
  </h1>
  <p class="text-muted mb-0">
    Liste des agents • equipé
  </p>
</header>
@include('layouts.user-stat-card')

                @if($users_equipes->count() > 0)
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                          
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Matricule</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Emploi</th>
                        <th>Fonction</th>
                            <th>Grade</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users_equipes as $user_equipe)
                    <tr>
                        <td>
                        {{$user_equipe->nom}}
                        </td>
                        <td>{{$user_equipe->prenom ?? 'non spécifié'}}</td>
                        <td>{{$user_equipe->matricule ?? 'non spécifié'}}</td>
                        <td><i class="mail icon"></i> {{$user_equipe->email}}</td>
                        <td>{{$user_equipe->contact}}</td>
                        <td>{{$user_equipe->emploie}}</td>
                        <td>{{$user_equipe->fonction_id ? $user_equipe->fonction->fonction : ''}}</td>
                        <td>{{$user_equipe->grade}}</td>
                        <td>
                            @if($user_equipe->role == 'admin')
                            <span class="badge bg-dark">Directeur</span>
                        @elseif($user_equipe->role == 'chef_de_service')
                            <span class="badge bg-info">Chef de service</span>
                        @elseif ($user_equipe->role == 'sous_directeur')
                            <span class="badge bg-success">Sous Directeur</span>
                        @elseif ($user_equipe->role == 'gestionnaire_parc')
                            <span class="badge bg-warning">Gestionnaire du Parc</span>
                        @elseif ($user_equipe->role == 'technicien')
                            <span class="badge bg-danger">Chef de service maintenance</span>
                        @else
                            <span class="badge bg-secondary">Agent</span>
                         @endif
                        </td>
                   <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton{{ $user_equipe->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end" style="z-index: 9999999999;" aria-labelledby="dropdownMenuButton{{ $user_equipe->id }}">
                                
                                <li>
                                    <a class="dropdown-item" href="/update_user/{{$user_equipe->id}}">
                                        <i class="bi bi-pencil text-primary me-2"></i> Modifier
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="/users/{{$user_equipe->id}}/all-equipements">
                                        <i class="bi bi-boxes me-2"></i> Équipements assignés
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('directions.reset-password-admin', $user_equipe->id) }}" onclick="return confirm('Voulez-vous vraiment réinitialiser le mot de passe de ce utilisateur ?')">
                                        <i class="bi bi-key me-2"></i> Réinitialiser le mot de passe
                                    </a>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <a href="/user_Delete/{{$user_equipe->id}}" onclick="return confirm('Voulez-vous vraiment supprimer ce utilisateur ?')" class="dropdown-item text-danger" style="color: #e74c3c;"><i class="bi bi-trash"></i> Supprimer</a>
                                </li>

                            </ul>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="text-center py-3 mt-4">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Aucun utilisateur connecté</p>
                </div>
            @endif
        </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    toggleSidebar.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('collapsed');
    });

    setTimeout(() => {
        const messageDiv = document.getElementById('statusMessage');
        if (messageDiv) {
            messageDiv.style.transition = "opacity 0.5s ease";
            messageDiv.style.opacity = "0";
            setTimeout(() => messageDiv.remove(), 500);
        }
    }, 5000);
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.5.0/semantic.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.16.3/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.16.3/js/uikit-icons.min.js"></script>

<script>
    $(document).ready(function() {
        $('.ui.dropdown').dropdown();
    });
    
    $('#searchInput').on('keyup', function() {
        let value = $(this).val().toLowerCase();
        $("table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
</script>
</body>
</html>
@endsection