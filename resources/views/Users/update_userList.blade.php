@extends('layouts.main-board')

@section('content')
@include('layouts.message')

<form class="mb-5" action="/update_user/traitement" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $users->id }}">     
    
    <!-- En-tête -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between py-4 border-bottom mb-4 gap-3">
        <header>
            <h1 class="h3 fw-bold text-dark mb-1 d-flex flex-wrap align-items-center">
                Modifier l'utilisateur : <span class="fw-bold text-success ms-2"> {{ $users->nom }} {{ $users->prenom }}</span>
            </h1>
            <p class="text-muted mb-0">
                <i class="bi bi-card-text me-1"></i> Matricule • <strong>{{ $users->matricule }}</strong>
            </p>
        </header>

        <button type="submit" class="btn btn-success d-flex align-items-center gap-2 px-4 py-2 shadow-sm">
            <i class="bi bi-check-circle-fill"></i>
            <span>Enregistrer les modifications</span>
        </button>
    </div>

    <!-- Section: Informations personnelles -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header p-3 border-start border-1 border-light" style="background-color: rgb(252, 236, 226);">
            <h4 class="mb-0 text-dark fw-bold fs-5">Informations personnelles</h4>
        </div>
        <div class="card-body p-4">
            <div class="row g-3 mb-3">
                <!-- Nom -->
                <div class="col-12 col-md-4">
                    <label class="form-label fw-semibold text-secondary">Nom</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-success"><i class="bi bi-person"></i></span>
                        <input type="text" name="nom" class="form-control border-start-0" placeholder="Entrer le nom" value="{{ $users->nom }}">
                    </div>
                </div>
                <!-- Email -->
                <div class="col-12 col-md-4">
                    <label class="form-label fw-semibold text-secondary">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-success"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control border-start-0" placeholder="Entrer l'email" value="{{ $users->email }}">
                    </div>
                </div>
                <!-- Contact -->
                <div class="col-12 col-md-4">
                    <label class="form-label fw-semibold text-secondary">Contact</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-success"><i class="bi bi-telephone"></i></span>
                        <input type="text" name="contact" class="form-control border-start-0" placeholder="Entrer le contact" value="{{ $users->contact }}">
                    </div>
                </div>
            </div>
            
            <div class="row g-3">
                <!-- Prénom -->
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-secondary">Prénom</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-success"><i class="bi bi-person"></i></span>
                        <input type="text" name="prenom" class="form-control border-start-0" placeholder="Entrer le prénom" value="{{ $users->prenom }}">
                    </div>
                </div>
                <!-- Matricule -->
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-secondary">Matricule</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-success"><i class="bi bi-vignette"></i></span>
                        <input type="text" name="matricule" class="form-control border-start-0" placeholder="Entrer le matricule" value="{{ $users->matricule }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section: Informations professionnelles -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header p-3 border-start border-1 border-light" style="background-color: rgb(252, 236, 226);">
            <h4 class="mb-0 text-dark fw-bold fs-5">Informations professionnelles</h4>
        </div>
        <div class="card-body p-4">
            <div class="row g-3">
                <!-- Emploi -->
                <div class="col-12 col-md-4 col-lg">
                    <label class="form-label fw-semibold text-secondary">Emploi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-success"><i class="bi bi-briefcase"></i></span>
                        <input type="text" name="emploie" class="form-control border-start-0" placeholder="Entrer l'emploi" value="{{ $users->emploie }}">
                    </div>
                </div>
                <!-- Fonction -->
                <div class="col-12 col-md-4 col-lg">
                    <label for="fonction_id" class="form-label fw-semibold text-secondary">Fonction</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-success"><i class="bi bi-person-workspace"></i></span>
                        <select class="form-select border-start-0" name="fonction_id" id="fonction_id">
                            @foreach($fonctions as $fonc)
                                <option value="{{ $fonc->id }}" {{ $users->fonction_id == $fonc->id ? 'selected' : '' }}>
                                    {{ $fonc->fonction }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Grade -->
                <div class="col-12 col-md-4 col-lg">
                    <label class="form-label fw-semibold text-secondary">Grade</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-success"><i class="bi bi-award"></i></span>
                        <input type="text" name="grade" class="form-control border-start-0" placeholder="Entrer le grade" value="{{ $users->grade }}">
                    </div>
                </div>
                <!-- Date première prise de service -->
                <div class="col-12 col-md-6 col-lg">
                    <label class="form-label fw-semibold text-secondary">1ère prise de service</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-success"><i class="bi bi-calendar-event"></i></span>
                        <input type="date" name="date_prise_service_un" class="form-control border-start-0" value="{{ $users->date_prise_service_un }}">
                    </div>
                </div>
                <!-- Date de prise de service -->
                <div class="col-12 col-md-6 col-lg">
                    <label class="form-label fw-semibold text-secondary">Prise de service actuelle</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-success"><i class="bi bi-calendar-check"></i></span>
                        <input type="date" name="date_prise_service" class="form-control border-start-0" value="{{ $users->date_prise_service }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section: Droits d'accès -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header p-3 border-start border-1 border-light" style="background-color: rgb(252, 236, 226);">
            <h4 class="mb-0 text-dark fw-bold fs-5">Droits d'accès</h4>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-12">
                    <label for="role" class="form-label fw-semibold text-secondary">Rôle de l'utilisateur</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-success"><i class="bi bi-shield-lock"></i></span>
                        <select name="role" class="form-select border-start-0" id="role">
                            <option value="admin" {{ old('role', $users->role) == 'admin' ? 'selected' : '' }}>Administrateur</option>
                            <option value="directeur" {{ old('role', $users->role) == 'directeur' ? 'selected' : '' }}>Directeur</option>
                            <option value="point_focal" {{ old('role', $users->role) == 'point_focal' ? 'selected' : '' }}>Point focal</option>
                            <option value="service_gestionnaire" {{ old('role', $users->role) == 'service_gestionnaire' ? 'selected' : '' }}>Service gestionnaire</option>
                            <option value="ministre" {{ old('role', $users->role) == 'ministre' ? 'selected' : '' }}>Ministre</option>
                            <option value="chef_de_service" {{ old('role', $users->role) == 'chef_de_service' ? 'selected' : '' }}>Chef de service</option>
                            <option value="user" {{ old('role', $users->role) == 'user' ? 'selected' : '' }}>Agent</option>
                            <option value="sous_directeur" {{ old('role', $users->role) == 'sous_directeur' ? 'selected' : '' }}>Sous directeur</option>
                            <option value="gestionnaire_parc" {{ old('role', $users->role) == 'gestionnaire_parc' ? 'selected' : '' }}>Gestionnaire de parc</option>
                            <option value="technicien" {{ old('role', $users->role) == 'technicien' ? 'selected' : '' }}>Chef de service Maintenance</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection