<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement de Direction - Côte d'Ivoire</title>
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
        
        .registration-container {
            background-color: var(--white-ivory);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(112, 112, 112, 0.1);
            overflow: hidden;
            scroll-behavior: smooth;
        }
        
        .form-section {
            padding: 25px 30px;
            height: 650px;
            overflow-y: auto;
            
        }
        
        .image-section {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
            height: 650px;
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
            margin-top: 30px;
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
            margin: 20px 0;
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
    </style>
</head>
<body>
    @include('layouts.message')
    <div class="container">
        <div class="row registration-container">
            <!-- Section du formulaire (gauche) -->
            <div class="col-md-7 form-section">
                <h2>Enregistrement de Direction</h2>
                
                <form action="{{ route('directions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Erreurs de validation -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Informations de base -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nom_direction" class="form-label">Nom de la direction</label>
                            <input type="text" class="form-control" id="nom_direction" name="nom_direction" 
                                   value="{{ old('nom_direction') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="code_direction" class="form-label">Cycle</label>
                            <input type="text" class="form-control" id="code_direction" name="code_direction" 
                                   value="{{ old('code_direction') }}" required>
                        </div>
                    </div>

                    <!-- Type et Statut -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type">
                                <option value="">Sélectionner</option>
                                <option value="centrale">Centrale</option>
                                <option value="déconcentrée">Déconcentrée</option>
                                <option value="partenaire">Partenaire</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select class="form-select" id="statut" name="statut">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Informations de contact -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email_contact" class="form-label">Email de contact</label>
                            <input type="email" class="form-control" id="email_contact" name="email_contact" 
                                   value="{{ old('email_contact') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="telephone" name="telephone" 
                                   value="{{ old('telephone') }}">
                        </div>
                    </div>

                    <!-- Adresse et Responsable -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" 
                                   value="{{ old('adresse') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="responsable" class="form-label">Responsable</label>
                            <input type="text" class="form-control" id="responsable" name="responsable" 
                                   value="{{ old('responsable') }}">
                        </div>
                    </div>

                    <!-- Logo et Couleur -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo">
                            <div class="form-text">Formats acceptés : JPG, PNG, GIF (max 2MB)</div>
                        </div>

                        <div class="col-md-6 mb-3">
                        <label for="web_url" class="form-label">URL du site web</label>
                        <input type="url" class="form-control" id="web_url" name="web_url" 
                               value="{{ old('web_url') }}">
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="/directions/list-direction" class="btn btn-secondary btn-cancel">Annuler</a>
                        <button type="submit" class="btn btn-primary btn-submit">Créer la direction</button>
                    </div>
                </form>
            </div>
            
            <!-- Section image (droite) -->
            <div class="col-md-5 image-section">
                <div class="image-container">
                    <!-- Bande aux couleurs de la Côte d'Ivoire -->
                    <div class="flag-strip">
                        <div class="orange-strip"></div>
                        <div class="white-strip"></div>
                        <div class="green-strip"></div>
                    </div>
                    <!-- Image illustrative -->
                    <img src="/logo-gpi.png" alt="Direction administrative en Côte d'Ivoire" class="img-fluid rounded mb-3">
                    
                    <div class="image-caption">
                        <h4 style="color: var(--green-ivory);">Gestion des Directions</h4>
                        <p>Enregistrez les informations de votre direction pour une meilleure organisation administrative.</p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>