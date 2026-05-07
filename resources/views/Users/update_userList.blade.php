@extends('layouts.main-board')

@section('content')
@include('layouts.message')
    <form class="ui form mb-3" action="/update_user/traitement" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $users->id }}">     
        
        <div class="en-tete d-flex flex-column flex-md-row align-items-center justify-content-between py-4">

        <header class="">
        <h1 class="h3 fw-bold text-dark mb-1 d-flex align-items-center">
            Modier l'utilisateur<span class="fw-bold text-success mx-2"> {{ $users->nom }} {{ $users->prenom }}</span>
        </h1>
        <p class="text-muted mb-0">
            matricule • {{ $users->matricule }}
        </p>
        </header>


            <button type="submit" class="btn btn-success d-flex align-items-center gap-2 px-3 py-2">
            <i class="bi bi-person fs-5"></i>
            <span>Modifier l'utilisateur</span>
            </button>
        </div>
        <!-- Informations personnelles -->
        <h4 class="p-2" style="border-left: 4px solid orange; background-color:rgb(252, 236, 226);">Informations personnelles</h4>
        <div class="three fields">
            <div class="field">
                <label>Nom</label>
                <div class="ui left icon input">
                    <i class="user icon" style="color: #009E60;"></i>
                    <input type="text" name="nom" placeholder="Entrer le nom" value="{{ $users->nom }}">
                </div>
            </div>
            <div class="field">
                <label>Email</label>
                <div class="ui left icon input">
                    <i class="envelope icon" style="color: #009E60;"></i>
                    <input type="email" name="email" placeholder="Entrer l'email" value="{{ $users->email }}">
                </div>
            </div>
            <div class="field">
                <label>Contact</label>
                <div class="ui left icon input">
                    <i class="phone icon" style="color: #009E60;"></i>
                    <input type="text" name="contact" placeholder="Entrer le contact" value="{{ $users->contact }}">
                </div>
            </div>
        </div>
        
        <div class="three fields">
            <div class="field">
                <label>Prénom</label>
                <div class="ui left icon input">
                    <i class="user icon" style="color: #009E60;"></i>
                    <input type="text" name="prenom" placeholder="Entrer le prénom" value="{{ $users->prenom }}">
                </div>
            </div>
            <div class="field">
                <label>Matricule</label>
                <div class="ui left icon input">
                    <i class="id badge icon" style="color: #009E60;"></i>
                    <input type="text" name="matricule" placeholder="Entrer le matricule" value="{{ $users->matricule }}">
                </div>
            </div>
        </div>

        <!-- Informations professionnelles -->
        <h4 class="p-2" style="border-left: 4px solid orange; background-color:rgb(252, 236, 226);">Informations professionnelles</h4>
        <div class="five fields">
            <div class="field">
                <label>Emploi</label>
                <div class="ui left icon input">
                    <i class="briefcase icon" style="color: #009E60;"></i>
                    <input type="text" name="emploie" placeholder="Entrer l'emploi de l'utilisateur" value="{{ $users->emploie }}">
                </div>
            </div>
            <div class="field">
                 <label for="fonction" class="form-label">Fonction</label>
                <select class="ui search selection" name="fonction_id" id="">
                    @foreach( $fonctions as $fonc)
                  <i class="id suitcase icon" style="color: #009E60;"></i>
                  <option value="{{ $fonc->id}}">{{ $fonc->fonction}}</option>
                  @endforeach
                </select>
            </div>
            <div class="field">
                <label>Grade</label>
                <div class="ui left icon input">
                    <i class="certificate icon" style="color: #009E60;"></i>
                    <input type="text" name="grade" placeholder="Entrer le grade" value="{{ $users->grade }}">
                </div>
            </div>
            <div class="field">
                <label>Date première prise de service</label>
                <div class="ui left icon input">
                    <i class="calendar icon" style="color: #009E60;"></i>
                    <input type="date" name="date_prise_service_un" placeholder="Entrer la date de première prise de service" value="{{ $users->date_prise_service_un }}">
                </div>
            </div>
              <div class="field">
                <label>Date de prise de service</label>
                <div class="ui left icon input">
                    <i class="calendar icon" style="color: #009E60;"></i>
                    <input type="date" name="date_prise_service" placeholder="Entrer la date de prise de service" value="{{ $users->date_prise_service}}">
                </div>
            </div>
        </div>
        
        <!-- Rôle utilisateur -->
        <h4 class="p-2" style="border-left: 4px solid orange; background-color:rgb(252, 236, 226);">Droits d'accès</h4>
        <div class="field">
            <label>Rôle</label>
            <div class="ui selection dropdown" style="border-color: #009E60;">
                <input type="hidden" name="role" value="{{ $users->role ?? 'user' }}">
                <i class="dropdown icon"></i>
                <div class="default text">Sélectionner un rôle</div>
                <div class="menu">
                    <div class="item" data-value="admin">
                         Directeur
                    </div>
                    <div class="item" data-value="user">
                        Agent
                    </div>
                    <div class="item" data-value="chef_de_service">
                        chef de service
                    </div>
                    <div class="item" data-value="sous_directeur">
                        Sous directeur
                    </div> 
                    <div class="item" data-value="gestionnaire_parc">
                         Gestionnaire du Parc
                    </div>
                    <div class="item" data-value="technicien">
                       Technicien
                    </div>
                </div>
            </div>
        </div>
    </form>


<script>
    // Initialiser les dropdowns
    $('.ui.dropdown').dropdown();
    
    // Définir la valeur actuelle du rôle
    $('.ui.dropdown').dropdown('set selected', '{{ $users->role }}');

    // Initialiser les checkboxes
    $('.ui.checkbox').checkbox();
    
    // Animation au survol du bouton
    $('.ui.button').hover(
        function() {
            $(this).css('background-color', '#009E60');
        },
        function() {
            $(this).css('background-color', '#FF8200');
        }
    );
</script>
@endsection