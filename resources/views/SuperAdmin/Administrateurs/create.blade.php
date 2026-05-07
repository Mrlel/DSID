<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Enregistrement - Côte d'Ivoire</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Couleurs de la Côte d'Ivoire */
        :root {
            --orange-ivory: #FF7900;
            --white-ivory: #FFFFFF;
            --green-ivory: #009E60;
        }
        
        body {yy
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .container {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        
        .registration-container {
            background-color: var(--white-ivory);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(163, 163, 163, 0.1);
            overflow: hidden;
        }
        
        .form-section {
            padding: 30px;
            height: 600px;
        }
        
        .image-section {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            height: 600px;
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
        
        h3 {
            color: var(--green-ivory);
            margin-bottom: 30px;
            font-weight: 600;
        }
        
        .btn-submit {
            background-color: var(--green-ivory);
            border: none;
            padding: 10px 20px;
            width: 100%;
            font-weight: 600;
        }
        
        .btn-submit:hover {
            background-color: #009E60;
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
    </style>
</head>
<body>
    @include('layouts.message')
    <div class="container">
        
        <div class="row registration-container">
            <!-- Section du formulaire (gauche) -->
            <div class="col-md-6 form-section">
                <h3>Enregistrement d'un utilisateur <i class="fas fa-user-plus"></i></h3>
                <form action="{{ route('directions.store-admin') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Première rangée -->
                        <div class="col-md-6 mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom de l'utilisateur" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom de l'utilisateur" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Deuxième rangée -->
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="exemple@email.com" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="matricule" class="form-label">Numéro matricule</label>
                            <input type="tel" class="form-control" id="matricule" name="matricule" placeholder="matricule utilisateur">
                        </div>
                    </div>

                    <div class="row">
                        <!-- Troisième rangée -->
                        <div class="col-md-6 mb-3">
                            <label for="contact" class="form-label">Contact</label>
                            <input type="tel" class="form-control" id="contact" name="contact" placeholder="+225 XX XX XX XX">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="emploi" class="form-label">Emploi</label>
                            <input type="text" class="form-control" id="emploi" name="emploie" placeholder="Emploi de l'utilisateur">
                        </div>
                    </div>

                    <div class="row">
                        <!-- Quatrième rangée -->
                        <div class="col-md-6 mb-3">
                            <label for="fonction" class="form-label">Fonction</label>
                            <input type="text" class="form-control" id="fonction" name="fonction" placeholder="Fonction de l'utilisateur">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="grade" class="form-label">Grade</label>
                            <input type="text" class="form-control" id="grade" name="grade" placeholder="Grade de l'utilisateur">
                        </div>
                    </div>

                    <div class="row">
                        <!-- Cinquième rangée -->
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Rôle</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="user">Utilisateur</option>
                                <option value="chef_de_service">Chef de service</option>
                                <option value="admin">Directeur</option>
                                <option value="sous_directeur">Sous directeur</option>
                                <option value="gestionnaire_parc">Gestionnaire de parc</option>
                                <option value="technicien">Technicien</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                           <label for="direction_id" class="form-label">Direction</label>
                            <select name="direction_id" class="form-select" id="direction_id">
                                <option value="">-- Sélectionner une direction --</option>
                                @foreach($directions as $direction)
                                    <option value="{{ $direction->id }}">{{ $direction->nom_direction }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-submit"><i class="fas fa-save"></i> Enregistrer</button>
                </form>
                <div class="divider"></div>
            </div>
            
            <!-- Section image (droite) -->
            <div class="col-md-6 image-section">
                <div class="flag-strip">
                    <div class="orange-strip"></div>
                    <div class="white-strip"></div>
                    <div class="green-strip"></div>
                </div>
                <div class="image-container">
                    <!-- Image illustrative -->
                    <img src="/logo-gpi.png" alt="Direction administrative en Côte d'Ivoire" class="img-fluid rounded mb-3">
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 
 
 
 
 
 
 
 
 
 
 
 
 







































<!-- 
<div class="container">
    <h2 class="text-center mb-4">Créer un nouvel administrateur</h2>
    <form action="{{ route('directions.store-admin') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select name="role" id="role" class="form-select" required>
                <option value="admin">Administrateur</option>
                <option value="superadmin">Super Administrateur</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="direction_id" class="form-label">Direction</label>
            <select name="direction_id" id="direction_id" class="form-select" required>
                @foreach ($directions as $direction)
                    <option value="{{ $direction->id }}">{{ $direction->nom }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>-->