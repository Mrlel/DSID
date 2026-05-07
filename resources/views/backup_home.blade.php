<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEPD-GPI | Gestion du Patrimoine Informatique</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --orange-ci: #F77F00;
            --white-ci: #FFFFFF;
            --green-ci: #009A44;
        }
    #accueil{
            background:linear-gradient(rgba(0, 0, 0, 0.429),rgba(0, 0, 0, 0.429)), url({{ asset('css/bg.jpg') }});
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
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
        
        .flag-stripe {
            height: 8px;
        }
        
        .flag-orange {
            background-color: var(--orange-ci);
        }
        
        .flag-white {
            background-color: var(--white-ci);
        }
        
        .flag-green {
            background-color: var(--green-ci);
        }
        
        .navbar-scrolled {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            background-color: white;
        }
        
        .feature-card {
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
        }
        
        .dashboard-preview {
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .stat-value {
            font-size: 2.5rem;
            font-weight: bold;
            background: linear-gradient(to right, var(--orange-ci), var(--green-ci));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .nav-menu {
            display: none;
        }
        
        .nav-menu.active {
            display: block;
        }
        
        .btn-orange {
            background-color: var(--orange-ci);
            border-color: var(--orange-ci);
            color: white;
        }
        
        .btn-orange:hover {
            background-color: #e67300;
            border-color: #e67300;
            color: white;
        }
        
        .bg-orange-50 {
            background-color: rgba(247, 127, 0, 0.05);
        }
        
        .bg-green-50 {
            background-color: rgba(0, 154, 68, 0.05);
        }
        
        .border-orange-500 {
            border-color: var(--orange-ci) !important;
        }
        
        .border-green-500 {
            border-color: var(--green-ci) !important;
        }
        
        .text-orange-500 {
            color: var(--orange-ci) !important;
        }
        
        .text-green-500 {
            color: var(--green-ci) !important;
        }
        
        .hover-orange:hover {
            color: var(--orange-ci) !important;
        }
        
        @media (max-width: 768px) {
            .desktop-menu {
                display: none;
            }
            
            .nav-menu {
                position: absolute;
                top: 80px;
                left: 0;
                right: 0;
                background: white;
                z-index: 1000;
                padding: 1rem;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            }
        }
        
        .header-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .main-title {
            font-size: 3.5rem;
            font-weight: 800;
            text-transform: uppercase;
            color: #2D3748;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            letter-spacing: 1px;
        }
        
        .main-title.text-white {
            color: white;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        }
        
        .subtitle {
            font-size: 1.5rem;
            color: #4A5568;
            margin-bottom: 3rem;
            line-height: 1.6;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .subtitle.text-white {
            color: white;
        }
        
        .cta-button {
            display: inline-flex;
            align-items: center;
            background-color: var(--orange-ci);
            color: white;
            padding: 16px 32px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1.25rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 15px rgba(247, 127, 0, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        
        .cta-button:hover {
            background-color: #E67300;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(247, 127, 0, 0.4);
            color: white;
            text-decoration: none;
        }
        
        .cta-button:hover::before {
            left: 100%;
        }
        
        .cta-button .icon {
            margin-right: 12px;
            font-size: 1.4rem;
            transition: transform 0.3s ease;
        }
        
        .cta-button:hover .icon {
            transform: translateX(3px);
        }
    </style>
</head>
<body class="font-sans">

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
                        <a href="/login" class="btn btn-orange">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Connexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

      <!-- Hero Section -->
    <section class="header-section bg-gradient-to-r from-orange-50 to-green-50 py-20 md:py-32" id="accueil" data-aos="fade-up">
        <div class="container mx-auto px-4 text-center">
            <h1 class="main-title text-white mb-4">Gestion du Patrimoine Informatique</h1>
            <p class="subtitle text-white">Simplifiez la gestion de vos équipements avec la solution DSID</p>
            <a href="/login" class="cta-button ">
                <i class="bi bi-box-arrow-in-right me-2"></i> Se connecter
            </a>
        </div>
    </section>
    

    <!-- Features Section -->
    <section class="py-5 bg-white" id="fonctionnalites" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center fw-bold text-dark mb-5">Fonctionnalités clés</h2>
            
            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card bg-white p-4 rounded shadow-sm border-start border-4 border-orange-500 h-100">
                        <div class="text-orange-500 mb-3">
                            <i class="bi bi-display fs-1"></i>
                        </div>
                        <h3 class="h4 fw-semibold mb-3">Inventaire Complet</h3>
                        <p class="text-muted">Suivre tous les équipements informatique et télécommunication avec un inventaire détaillé et centralisé. Accéder instantanément aux informations essentielles.</p>
                    </div>
                </div>
                
                <!-- Feature 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card bg-white p-4 rounded shadow-sm border-start border-4 border-green-500 h-100">
                        <div class="text-green-500 mb-3">
                            <i class="bi bi-bar-chart fs-1"></i>
                        </div>
                        <h3 class="h4 fw-semibold mb-3">Tableaux de Bord</h3>
                        <p class="text-muted">Visualiser l'état de votre parc informatique et télécommunication grâce à des tableaux de bord interactifs et des rapports personnalisables.</p>
                    </div>
                </div>
                
                <!-- Feature 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card bg-white p-4 rounded shadow-sm border-start border-4 border-orange-500 h-100">
                        <div class="text-orange-500 mb-3">
                            <i class="bi bi-clock fs-1"></i>
                        </div>
                        <h3 class="h4 fw-semibold mb-3">Suivi des Maintenances</h3>
                        <p class="text-muted">Avoir l'état complet de la maintenance préventive et curative pour optimiser la durée de vie des équipements.</p>
                    </div>
                </div>
                
                <!-- Feature 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card bg-white p-4 rounded shadow-sm border-start border-4 border-green-500 h-100">
                        <div class="text-green-500 mb-3">
                            <i class="bi bi-people fs-1"></i>
                        </div>
                        <h3 class="h4 fw-semibold mb-3">Gestion des Utilisateurs</h3>
                        <p class="text-muted">Assurer la répartition équitable des équipements aux utilisateurs et fournir l'historique pour une meilleure vue de la responsabilité de l'utilisateur.</p>
                    </div>
                </div>
                
                <!-- Feature 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card bg-white p-4 rounded shadow-sm border-start border-4 border-orange-500 h-100">
                        <div class="text-orange-500 mb-3">
                            <i class="bi bi-bell fs-1"></i>
                        </div>
                        <h3 class="h4 fw-semibold mb-3">Alertes & Notifications</h3>
                        <p class="text-muted">Assurer les rappels des maintenances planifiés pour les fins de garantie et les problèmes détectés.</p>
                    </div>
                </div>
                
                <!-- Feature 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card bg-white p-4 rounded shadow-sm border-start border-4 border-green-500 h-100">
                        <div class="text-green-500 mb-3">
                            <i class="bi bi-file-text fs-1"></i>
                        </div>
                        <h3 class="h4 fw-semibold mb-3">Rapports Personnalisés</h3>
                        <p class="text-muted">Générer des rapports détaillés sur l'état de votre parc informatique et télécommunication pour faciliter la prise de décision stratégique.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 bg-light" data-aos="fade-up">
        <div class="container">
            <div class="row g-4 text-center">
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
    </section>

    <div class="watermark">Lela gnawa dominique</div>

    <!-- Overview Section -->
    <section class="py-5 bg-white" id="apercu" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center fw-bold text-dark mb-5">Aperçu de l'Application</h2>
            
            <div class="row align-items-center">
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
                
                <div class="col-lg-6">
                    <img src="/app.png" alt="Aperçu du tableau de bord" class="dashboard-preview w-100">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5" id="contact">
        <div class="container">
            <div class="row g-4">
                <!-- About -->
                <div class="col-md-6 col-lg-3">
                    <h3 class="h5 fw-semibold mb-3">À propos</h3>
                    <p class="text-light mb-3">La Direction des Systèmes d'Information et de la Digitalisation (DSID) du Ministère du Plan et du Developpement(MEPD) est responsable de la stratégie numérique et de la gestion des infrastructures informatiques.</p>
                    <div class="d-flex align-items-center">
                        <span class="d-inline-block rounded-circle bg-orange-500 me-1" style="width: 12px; height: 12px;"></span>
                        <span class="d-inline-block rounded-circle bg-white me-1" style="width: 12px; height: 12px;"></span>
                        <span class="d-inline-block rounded-circle bg-green-500 me-2" style="width: 12px; height: 12px;"></span>
                        <span>Côte d'Ivoire</span>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    const navbarToggler = document.querySelector('.navbar-toggler');
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
                        navbarToggler.click();
                    }
                }
            });
        });

        // Number animation for stats
        function animateValue(id, start, end, duration) {
            const obj = document.getElementById(id);
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                obj.innerHTML = Math.floor(progress * (end - start) + start);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Trigger animation when stats section is in view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const statValues = document.querySelectorAll('.stat-value');
                    statValues.forEach((value, index) => {
                        const target = parseInt(value.textContent.replace('+', ''));
                        animateValue(`stat-${index}`, 0, target, 2000);
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            observer.observe(statsSection);
        }
    </script>
</body>
</html>