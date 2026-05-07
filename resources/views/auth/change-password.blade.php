<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.18.1/dist/css/uikit.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.18.1/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.18.1/dist/js/uikit-icons.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>
    <title>Modifier votre mot de passe</title>
</head>
<style>
    body {
        font-family: 'poppins', sans-serif;
        background-color:rgb(237, 252, 215);
    }
    /* Ajout d'une animation d'entrée avec Semantic UI */
    .ui.container {
        animation: fadeIn 1s ease-in-out;
    }

    /* Animation de fade-in */
    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    /* Animation de slide-up pour le formulaire */
    .ui.form {
        animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
        0% {
            transform: translateY(20px);
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<body>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;padding: 20px; border-radius: 10px;">
        <!-- 📌 Colonne de droite : Formulaire -->
        <div class="col-md-6 bg-white p-4 mt-4">
            <h4 class="text-center mb-4">
                 Saisissez un nouveau mot de passe
            </h4>

            @if (session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check"></i> {{ session('status') }}
                </div>
            @endif

            <form class="ui form" method="POST" action="{{ route('password.update') }}">
                @csrf

                <div class="mb-3">
                    <label for="password" class="form-label"><span uk-icon="lock"></span> Nouveau mot de passe</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" required minlength="8">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">
                        <span uk-icon="unlock"></span> Confirmer le mot de passe
                    </label>
                    <input type="password" class="form-control" id="password_confirmation" 
                           name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    <i class="fas fa-sync-alt"></i> Sauvegarder
                </button>
            </form>
        </div>
    </div>

<!-- Ajout de FontAwesome pour les icônes -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Semantic UI JS -->
<script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>
<script>
    // Initialiser les dropdowns
    $('.ui.dropdown').dropdown();

    // Initialiser les checkboxes
    $('.ui.checkbox').checkbox();
</script>
</body>
</html>
