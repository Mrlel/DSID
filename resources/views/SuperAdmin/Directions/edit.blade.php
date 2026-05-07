<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de Direction - Côte d'Ivoire</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Couleurs de la Côte d'Ivoire */
        :root {
            --orange-ivory: #FF7900;
            --white-ivory: #FFFFFF;
            --green-ivory: #009E60;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .container {
            margin-top: 30px;
            margin-bottom: 30px;
        }
        
        .edit-container {
            background-color: var(--white-ivory);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(107, 107, 107, 0.1);
            overflow: hidden;
        }
        
        .form-section {
            padding: 25px 30px;
            height: 680px;
            overflow-y: auto;
        }
        
        .image-section {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
            height: 680px;
        }
        
        .flag-strip {
            height: 10px;
            width: 100%;
            display: flex;
        }
        
        .orange-strip {
            background-color: var(--orange-ivory);
            flex: 1;
        }
        
        .white-strip {
            background-color: var(--white-ivory);
            flex: 1;
        }
        
        .green-strip {
            background-color: var(--green-ivory);
            flex: 1;
        }
        
        h2 {
            color: var(--green-ivory);
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .btn-submit {
            background-color: var(--green-ivory);
            border: none;
            padding: 10px 20px;
            font-weight: 600;
        }
        
        .btn-submit:hover {
            background-color: var(--green-ivory);
        }
        
        .btn-cancel {
            background-color: #6c757d;
            border: none;
            padding: 10px 20px;
        }
        
        .form-control:focus {
            border-color: var(--green-ivory);
            box-shadow: 0 0 0 0.25rem rgba(0, 158, 96, 0.25);
        }
        
        .form-label {
            font-weight: 500;
            color: #555;
        }
        
        .image-container {
            text-align: center;
        }
        
        .image-caption {
            margin-top: 20px;
            color: #555;
            font-size: 1.1rem;
            text-align: center;
        }
        
        .logo-ci {
            max-width: 100px;
            margin-bottom: 20px;
        }
        
        .divider {
            height: 1px;
            background-color: #ddd;
            margin: 15px 0;
        }
        
        .footer-text {
            color: #777;
            font-size: 0.9rem;
            text-align: center;
            margin-top: 10px;
        }
        
        .alert {
            margin-bottom: 20px;
        }
        .direction-info {
            margin-top: 10px;
        }
        
        .current-logo {
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 5px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">

        
        <div class="row edit-container">
            <!-- Section du formulaire (gauche) -->
            <div class="col-md-7 form-section">
                <h2>Modification de Direction</h2>
                
                <!-- Erreurs de validation -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('directions.update', $direction->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <!-- Première rangée -->
                        <div class="col-md-6 mb-3">
                            <label for="nom_direction" class="form-label">Nom de la Direction</label>
                            <input type="text" name="nom_direction" id="nom_direction" class="form-control" value="{{ old('nom_direction', $direction->nom_direction) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="code_direction" class="form-label">Cycle</label>
                            <input type="text" name="code_direction" id="code_direction" class="form-control" value="{{ old('code_direction', $direction->code_direction) }}" required>
                        </div>
                    </div>
                    
                    <!-- Slug caché -->
                    <input type="hidden" name="slug" value="{{ old('slug', $direction->slug) }}">
                    
                    <div class="row">
                        <!-- Deuxième rangée -->
                        <div class="col-md-6 mb-3">
                            <label for="email_contact" class="form-label">Email de Contact</label>
                            <input type="email" name="email_contact" id="email_contact" class="form-control" value="{{ old('email_contact', $direction->email_contact) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone', $direction->telephone) }}">
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Troisième rangée -->
                        <div class="col-md-6 mb-3">
                            <label for="responsable" class="form-label">Responsable</label>
                            <input type="text" name="responsable" id="responsable" class="form-control" value="{{ old('responsable', $direction->responsable) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="web_url" class="form-label">Site web</label>
                            <input type="url" name="web_url" id="web_url" class="form-control" value="{{ old('web_url', $direction->web_url) }}">
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Quatrième rangée -->
                        <div class="col-md-6 mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select name="statut" id="statut" class="form-select">
                                <option value="active" {{ $direction->statut === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $direction->statut === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label">Type de Direction</label>
                            <select name="type" id="type" class="form-select">
                                <option value="">-- Choisir --</option>
                                <option value="centrale" {{ $direction->type === 'centrale' ? 'selected' : '' }}>Centrale</option>
                                <option value="déconcentrée" {{ $direction->type === 'déconcentrée' ? 'selected' : '' }}>Déconcentrée</option>
                                <option value="partenaire" {{ $direction->type === 'partenaire' ? 'selected' : '' }}>Partenaire</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Logo et adresse -->
                        <div class="col-md-6 mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" name="logo" id="logo" class="form-control">
                            @if($direction->logo)
                                <p class="mt-2">Logo actuel: <img src="{{ asset('storage/' . $direction->logo) }}" alt="Logo actuel" class="current-logo" style="max-height: 50px;"></p>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" name="adresse" id="adresse" class="form-control" value="{{ old('adresse', $direction->adresse) }}">
                        </div>
                    </div>
                    
                    <!-- Bouton -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="/directions/list-direction" class="btn btn-secondary">Retour</a>
                        <button type="submit" class="btn btn-submit btn-primary">Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
            
            <!-- Section image (droite) -->
            <div class="col-md-5 image-section">
                
                <div class="image-container">
                    <!-- Illustration de la direction -->
                    <div style="position: relative; margin-bottom: 20px;">
                        <img src="/logo-gpi.png" alt="Modification de Direction" class="img-fluid rounded">
                        <div style="position: absolute; top: 10px; right: 10px; width: 60px; height: 60px; border-radius: 50%; background-color: #fff; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: var(--orange-ivory); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                <span>EDIT</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="direction-preview" style="padding: 10px; text-align: left; background-color: rgba(0, 158, 96, 0.05); border-color: rgba(0, 158, 96, 0.2);">
                        <h5 style="color: var(--green-ivory);">Informations actuelles</h5>
                        <div class="mt-3">
                            <div><strong>Direction:</strong> {{ $direction->nom_direction }}</div>
                            <div><strong>Type:</strong> {{ ucfirst($direction->type ?: 'Non défini') }}</div>
                            <div><strong>Statut:</strong> {{ $direction->statut === 'active' ? 'Active' : 'Inactive' }}</div>
                            <div><strong>Email:</strong> {{ $direction->email_contact ?: 'Non défini' }}</div>
                            <div><strong>Responsable:</strong> {{ $direction->responsable ?: 'Non défini' }}</div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>