<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DSID - Gestion du Patrimoine Informatique</title>
    <link rel="shortcut icon" href="/r.jfif">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
               :root {
            --orange-ci: #F77F00;
            --white-ci: #FFFFFF;
            --green-ci: #009A44;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        
        .header-section {
            position: relative;
            height: 70vh;
            overflow: hidden;
            background: linear-gradient(135deg, rgba(0, 158, 96, 0.9), rgba(255, 130, 0, 0.8)), url('/assets/img/server-room.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .country-banner {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            height: 10px;
        }
        
        .banner-orange {
            background-color: var(--orange-ci);
            flex: 1;
        }
        
        .banner-white {
            background-color: var(--white-ci);
            flex: 1;
        }
        
        .banner-green {
            background-color: var(--green-ci);
            flex: 1;
        }
        
        .navbar {
            padding: 0.5rem 2rem;
            background-color: rgba(255, 255, 255, 0.95);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            padding: 0.5rem 2rem;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
        }
        
        .logo-container img {
            height: 45px;
            margin-right: 10px;
        }
        
        .logo-text {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--green-ci);
        }
        
        .slogan {
            font-size: 1rem;
            color: var(--orange-ci);
            font-style: italic;
        }
           #accueil{
            background:linear-gradient(rgba(0, 0, 0, 0.429),rgba(0, 0, 0, 0.429)), url({{ asset('css/bg.jpg') }});
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 90vh;
            display: flex;
            align-items: center;
        }
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            z-index: 10;
            padding: 2rem;
        }
        
        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }
        
        .feature-section {
            padding: 5rem 2rem;
            background-color: white;
        }
        
        .feature-card {
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-top: 3px solid transparent !important;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }
        
        .feature-card.card-orange:hover {
            border-top-color: var(--orange-ci) !important;
        }
        
        .feature-card.card-green:hover {
            border-top-color: var(--green-ci) !important;
        }
        
        .card-icon {
            font-size: 2.5rem !important;
            margin-bottom: 1rem;
        }
        
        .icon-orange {
            color: var(--orange-ci);
        }
        
        .icon-green {
            color: var(--green-ci);
        }
        
       
        
          .stat-value {
            font-size: 2.5rem;
            font-weight: bold;
            background: linear-gradient(to right, var(--orange-ci), var(--green-ci));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        

        .overview-section {
            padding: 5rem 2rem;
            background-color: #f9f9f9;
        }
        
        .dashboard-preview {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .dashboard-preview:hover {
            transform: scale(1.02);
        }
        
        .section-title {
            font-size: 2.2rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            color: #333;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, var(--orange-ci), var(--green-ci));
        }
        
        .cta-section {
            padding: 4rem 2rem;
            background: linear-gradient(135deg, var(--orange-ci), var(--green-ci));
            color: white;
            text-align: center;
        }
        
        .cta-title {
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }
        
        .btn-white {
            background-color: white !important;
            color: var(--green-ci) !important;
            font-weight: 600 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15) !important;
        }
        
        .btn-white:hover {
            background-color: #f0f0f0 !important;
            transform: translateY(-2px);
        }
        
        footer {
            background-color: #333;
            color: white;
            padding: 3rem 2rem 2rem;
        }
        
        .footer-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
            color: var(--orange-ci);
        }
        
        .footer-link {
            color: #ddd;
            display: block;
            margin-bottom: 0.5rem;
            transition: color 0.2s ease;
        }
        
        .footer-link:hover {
            color: white;
            text-decoration: none;
        }
        
        .copyright {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
            color: #aaa;
        }
        
        .social-links {
            margin-top: 1rem;
        }
        
        .social-icon {
            display: inline-block;
            margin-right: 1rem;
            font-size: 1.5rem;
            transition: transform 0.2s ease;
        }
        
        .social-icon:hover {
            transform: translateY(-3px);
        }
        
        .flag-colors {
            display: inline-block;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            margin-right: 5px;
        }
        
        .orange-dot {
            background-color: var(--orange-ci);
        }
        
        .white-dot {
            background-color: var(--white-ci);
            border: 1px solid #ddd;
        }
        
        .green-dot {
            background-color: var(--green-ci);
        }

        .animated-number {
            animation: countUp 2s ease-out forwards;
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @media (max-width: 768px) {
            #accueil{
                min-height:25vh;
            }
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .navbar {
                padding: 0.8rem;
            }
            
            .header-section {
                height: 60vh;
            }
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-35deg);
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            pointer-events: none;
            opacity: 0.1;
            font-size: 3px;
            color: #000;
            z-index: 9999;
        }

        .dashb{
            height: 300px;
            width: auto;
            overflow: auto;
            scrollbar-width: thin;
            -ms-overflow-style: none;
        }
        .dashb::-webkit-scrollbar {
            display: none;
        }
    </style>

</head>
<body>
     <div class="watermark">Lela gnawa dominique</div>
    <!-- Bande aux couleurs du drapeau -->
    <div class="country-banner">
        <div class="banner-orange"></div>
        <div class="banner-white"></div>
        <div class="banner-green"></div>
    </div>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky-top bg-white" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('MEPD.jpg') }}" alt="Logo" height="48">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark hover-orange" href="#accueil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark hover-orange" href="#fonctionnalites">Fonctionnalités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark hover-orange" href="#apercu">Aperçu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark hover-orange" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a href="/login" class="btn text-white " style="background-color: #F77F00" >
                            <i class="bi bi-box-arrow-in-right me-2"></i> Connexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- En-tête / Section héro -->
    <section class="header-section" id="accueil">
        <div class="hero-content">
            <div class="hero-title">Gestion du Patrimoine Informatique</div>
            <div class="hero-subtitle">Simplifiez la gestion de vos équipements avec la solution DSID</div>
            <div class="ui buttons">
                <a href="/login" class="btn text-white fs-4" style="background-color: var(--orange-ci); color: white;">
                    <i class="bi bi-box-arrow-in-right"></i> Se connecter
                </a>
            </div>
        </div>
    </section>
    
    <!-- Section de fonctionnalités -->
    <section class="feature-section" id="fonctionnalites">
        <div class="ui container">
            <h2 class="section-title">Fonctionnalités clés</h2>

            <div class="ui stackable three column grid">
                <div class="column">
                    <div class="ui card feature-card card-orange">
                        <div class="content text-center">
                            <i class="desktop icon card-icon icon-orange mb-4"></i>
                            <div class="header">Inventaire Complet</div>
                            <div class="description">
                                Suivre tous les équipements informatique et télécommunication avec un inventaire détaillé et centralisé. Accéder instantanément aux informations essentielles.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui card feature-card card-green">
                        <div class="content text-center">
                            <i class="chart bar icon card-icon icon-green mb-4"></i>
                            <div class="header">Tableaux de Bord</div>
                            <div class="description">
                               Visualiser l'état de votre parc informatique et télécommunication grâce à des tableaux de bord interactifs et des rapports personnalisables.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui card feature-card card-orange">
                        <div class="content text-center">
                            <i class="history icon card-icon icon-orange mb-4"></i>
                            <div class="header">Suivi des Maintenances</div>
                            <div class="description">
                                Avoir l'état complet de la maintenance préventive et curative pour optimiser la durée de vie des équipements.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui card feature-card card-green">
                        <div class="content text-center">
                            <i class="users icon card-icon icon-green mb-4"></i>
                            <div class="header">Gestion des Utilisateurs</div>
                            <div class="description">
                               Assurer la répartition équitable des équipements aux utilisateurs et fournir l'historique pour une meilleure vue de la responsabilité de l'utilisateur.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui card feature-card card-orange">
                        <div class="content text-center">
                            <i class="bell icon card-icon icon-orange mb-4"></i>
                            <div class="header">Alertes & Notifications</div>
                            <div class="description">
                               Assurer les rappels des maintenances planifiés pour les fins de garantie et les problèmes détectés.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui card feature-card card-green">
                        <div class="content text-center">
                            <i class="file pdf icon card-icon icon-green mb-4"></i>
                            <div class="header">Rapports Personnalisés</div>
                            <div class="description">
                               Générer des rapports détaillés sur l'état de votre parc informatique et télécommunication pour faciliter la prise de décision stratégique.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Stats Section -->
        <div class="container py-5">
            <div class="row g-4 text-center py-2">
                <div class="col-6 col-md-3">
                    <div class="stat-value">{{ $equipement->count() }}+</div>
                    <div class="text-muted fw-medium">Équipements Gérés</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-value">98%</div>
                    <div class="text-muted fw-medium">Taux de Disponibilité</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-value">{{ $user->count() }}+</div>
                    <div class="text-muted fw-medium">Utilisateurs Actifs</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-value">35%</div>
                    <div class="text-muted fw-medium">Réduction des Coûts</div>
                </div>
            </div>
        </div>

    <!-- Section aperçu -->
    <section class="overview-section" id="apercu">
        <div class="ui container">
            <h2 class="section-title">Aperçu de l'Application</h2>
            <div class="ui stackable two column grid">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h3 class="h2 fw-semibold mb-4 text-dark">Interface intuitive et fonctionnelle</h3>
                    <p class="text-muted mb-4">Notre solution de gestion du patrimoine informatique offre une interface moderne et intuitive qui permet de:</p>
                    
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-check-circle-fill text-green-500 me-2 mt-1"></i>
                            <span class="text-dark">Suivre en temps réel l'état des équipements</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-check-circle-fill text-green-500 me-2 mt-1"></i>
                            <span class="text-dark">Gérer les attributions aux utilisateurs</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-check-circle-fill text-green-500 me-2 mt-1"></i>
                            <span class="text-dark">Planifier les maintenances préventives</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-check-circle-fill text-green-500 me-2 mt-1"></i>
                            <span class="text-dark">Centraliser la documentation technique</span>
                        </li>
                    </ul>
                </div>
                <div class="column">
                    <div class="dashb">
                        <img src="/dashboard.jpeg" alt="Aperçu du tableau de bord" class="dashboard-preview w-100">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pied de page -->
    
    <!-- Footer -->
    <footer class="bg-dark text-white py-5" id="contact">
        <div class="container">
            <div class="row g-4">
                <!-- About -->
                <div class="col-md-6 col-lg-3">
                    <h3 class="h5 fw-semibold mb-3">À propos</h3>
                    <p class="text-light mb-3">La Direction des Systèmes d'Information et de la Digitalisation (DSID) du Ministère du Plan et du Developpement(MEPD) est responsable de la stratégie numérique et de la gestion des infrastructures informatiques.</p>
                      <div>
                        <span class="flag-colors orange-dot"></span>
                        <span class="flag-colors white-dot"></span>
                        <span class="flag-colors green-dot"></span>
                        <span style="vertical-align: middle;">Côte d'Ivoire</span>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="col-md-6 col-lg-3">
                    <h3 class="h5 fw-semibold mb-3">Liens rapides</h3>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#accueil" class="text-light text-decoration-none hover-orange">Accueil</a></li>
                        <li class="mb-2"><a href="#fonctionnalites" class="text-light text-decoration-none hover-orange">Fonctionnalités</a></li>
                        <li class="mb-2"><a href="#apercu" class="text-light text-decoration-none hover-orange">Aperçu</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none hover-orange">FAQ</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div class="col-md-6 col-lg-3">
                    <h3 class="h5 fw-semibold mb-3">Contact</h3>
                    <div class="text-light">
                        <div class="d-flex align-items-start mb-2">
                            <i class="bi bi-geo-alt me-2 mt-1"></i>
                            <span>Immeuble SCIAM</span>
                        </div>
                        <div class="d-flex align-items-start mb-2">
                            <i class="bi bi-telephone me-2 mt-1"></i>
                            <span>(+225) 27 20 20 08 42</span>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="bi bi-envelope me-2 mt-1"></i>
                            <span>info.dsid@plan.gouv.ci</span>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <a href="https://www.facebook.com/profile.php?id=100065489319554" class="text-light hover-orange text-decoration-none">
                            <i class="bi bi-facebook fs-5"></i>
                        </a>
                        <a href="#" class="text-light hover-orange text-decoration-none">
                            <i class="bi bi-twitter fs-5"></i>
                        </a>
                        <a href="#" class="text-light hover-orange text-decoration-none">
                            <i class="bi bi-linkedin fs-5"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Newsletter -->
                <div class="col-md-6 col-lg-3">
                    <h3 class="h5 fw-semibold mb-3">Newsletter</h3>
                    <p class="text-light mb-3">Abonnez-vous pour recevoir nos dernières actualités</p>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Votre email...">
                        <button class="btn btn-orange">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="border-top border-secondary mt-4 pt-4 text-center text-light">
                2025 MPD - Ministère du Plan et du Développement
            </div>
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>
    <script>
        // Animation de la barre de navigation au défilement
        $(window).scroll(function() {
            if ($(window).scrollTop() > 50) {
                $('.navbar').addClass('scrolled');
            } else {
                $('.navbar').removeClass('scrolled');
            }
        });
        
        // Animation des chiffres statistiques
        function isElementInViewport(el) {
            const rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }
        
        function handleScroll() {
            const statSection = document.querySelector('.stats-section');
            if (isElementInViewport(statSection)) {
                document.querySelectorAll('.animated-number').forEach(function(el) {
                    el.classList.add('animate');
                });
                window.removeEventListener('scroll', handleScroll);
            }
        }
        
        window.addEventListener('scroll', handleScroll);
        handleScroll(); // Check on page load
        
        // Smooth scrolling pour les ancres
        $('a[href*="#"]').on('click', function(e) {
            e.preventDefault();
            $('html, body').animate(
                {
                    scrollTop: $($(this).attr('href')).offset().top - 70,
                },
                500,
                'linear'
            );
        });
    </script>
</body>
</html>