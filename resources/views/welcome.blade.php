<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | GPI</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #2d7d32;
            --secondary-color: #4caf50;
            --accent-color: #81c784;
            --orange: #f3902e;
            --text-dark: #2c3e50;
            --text-light: #34495e;
            --white: #ffffff;
            --gray-light: #f8f9fa;
            --gray-medium: #e9ecef;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        html, body {
            height: 100%;
            overflow: hidden;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        /* Animation d'arrière-plan */
        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .floating-shape {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-shape:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-shape:nth-child(2) {
            top: 20%;
            right: 20%;
            animation-delay: 2s;
        }

        .floating-shape:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        .floating-shape:nth-child(4) {
            bottom: 10%;
            right: 10%;
            animation-delay: 1s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Container principal */
        .auth-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* Carte de connexion */
        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            
            box-shadow: var(--shadow);
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 600px;
        }

        .auth-illustration {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .auth-content {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            margin-bottom: 2rem;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        .auth-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--orange);
        }

        .auth-subtitle {
            color: var(--text-light);
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-dark);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--gray-medium);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(45, 125, 50, 0.25);
            outline: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--orange), #FF9900);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #256b2a, #3d8b40);
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .auth-footer {
            margin-top: 1.5rem;
            text-align: center;
            color: var(--text-light);
        }

        .auth-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        /* Computer setup */
        .computer-setup {
            position: relative;
            width: 300px;
            height: 250px;
            margin: 2rem auto;
            transform: perspective(1000px) rotateY(-15deg);
        }

        .monitor {
            width: 100%;
            height: 180px;
            background: linear-gradient(145deg, #f3902e, #FF9900);
            border-radius: 15px;
            padding: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            position: relative;
            margin-bottom: 20px;
        }

        .screen {
            width: 100%;
            height: 100%;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .screen-content {
            color: var(--primary-color);
            text-align: center;
            z-index: 1;
            padding: 1rem;
        }

        .screen-content i {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .screen-content p {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .monitor-stand {
            width: 60px;
            height: 30px;
            background: linear-gradient(145deg, #f3902e, #ff9900);
            border-radius: 5px;
            margin: 0 auto 10px;
            position: relative;
        }

        .monitor-base {
            width: 120px;
            height: 15px;
            background: linear-gradient(145deg, #f3902e, #ff9900);
            border-radius: 20px;
            margin: 0 auto;
        }

        /* Particules décoratives */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: white;
            border-radius: 50%;
            opacity: 0.6;
            animation: particle-float 8s linear infinite;
        }

        .particle:nth-child(1) { left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { left: 20%; animation-delay: 2s; }
        .particle:nth-child(3) { left: 30%; animation-delay: 4s; }
        .particle:nth-child(4) { left: 40%; animation-delay: 6s; }
        .particle:nth-child(5) { left: 50%; animation-delay: 1s; }
        .particle:nth-child(6) { left: 60%; animation-delay: 3s; }
        .particle:nth-child(7) { left: 70%; animation-delay: 5s; }
        .particle:nth-child(8) { left: 80%; animation-delay: 7s; }

        @keyframes particle-float {
            0% { transform: translateY(100vh) scale(0); opacity: 0; }
            10% { opacity: 0.6; }
            90% { opacity: 0.6; }
            100% { transform: translateY(-100px) scale(1); opacity: 0; }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .auth-card {
                grid-template-columns: 1fr;
                max-width: 500px;
            }
            
            .auth-illustration {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .auth-container {
                padding: 1rem;
            }
            
            .auth-title {
                font-size: 1.5rem;
            }
        }
        .watermark {
        position: fixed;
        top: 0;
        left: -5;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        pointer-events: none; /* Permet de cliquer à travers le filigrane */
        opacity: 0.1; /* Transparence */
        font-size: 40px;
        color: #000;
        transform: rotate(-35deg); /* Optionnel : inclinaison */
        z-index: 9999; /* Pour être au-dessus du contenu */
    }
    </style>
    
</head>
<body>
   
    @include('layouts.message')
    <!-- Animation d'arrière-plan -->
    <div class="background-animation">
        <div class="floating-shape">
            <i class="fas fa-microchip" style="font-size: 3rem; color: var(--primary-color);"></i>
        </div>
        <div class="floating-shape">
            <i class="fas fa-server" style="font-size: 2.5rem; color: var(--secondary-color);"></i>
        </div>
        <div class="floating-shape">
            <i class="fas fa-network-wired" style="font-size: 2rem; color: var(--accent-color);"></i>
        </div>
        <div class="floating-shape">
            <i class="fas fa-desktop" style="font-size: 2.5rem; color: var(--primary-color);"></i>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-illustration">
                <div class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <span>GPI</span>
                </div>
                
                <div class="computer-setup">
                    <div class="monitor">
                        <div class="screen">
                            <div class="screen-content">
                                <i class="fas fa-user-shield"></i>
                                <p>Authentification Sécurisée</p>
                            </div>
                        </div>
                    </div>
                    <div class="monitor-stand"></div>
                    <div class="monitor-base"></div>
                </div>
                
                <h3 style="color: white; margin-top: 2rem; text-align: center;">
                Ministère du Plan et du Développement
                </h3>
                
                <div class="particles">
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                </div>
            </div>
            
            <div class="auth-content">
                <h1 class="auth-title text-center">Connexion</h1>
                
                <form method="POST" action="/loginUser/traitement">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">Adresse Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="saisissez votre email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="saisissez votre mot de passe" required>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                    </button>
                    
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation des éléments au chargement
        document.addEventListener('DOMContentLoaded', () => {
            const authCard = document.querySelector('.auth-card');
            const formElements = document.querySelectorAll('.form-group, .auth-title, .auth-subtitle');
            
            // Animation d'apparition de la carte
            authCard.style.opacity = '0';
            authCard.style.transform = 'translateY(20px)';
            authCard.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            
            setTimeout(() => {
                authCard.style.opacity = '1';
                authCard.style.transform = 'translateY(0)';
            }, 100);
            
            // Animation séquentielle des éléments du formulaire
            formElements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(10px)';
                el.style.transition = `opacity 0.4s ease ${index * 0.1}s, transform 0.4s ease ${index * 0.1}s`;
                
                setTimeout(() => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, 200 + (index * 100));
            });
        });
    </script>
</body>
</html>