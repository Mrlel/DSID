<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestion de Patrimoine Informatique</title>
<link rel="shortcut icon" href="/r.jfif" type="image/x-icon">

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.5.0/semantic.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>
</head>
<style>

    .dropdown-menu {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s ease-out, transform 0.2s ease-out, visibility 0.2s;
        position: absolute; 
        transform: translateY(5px); 
    }
    .dropdown-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0); 
    }

    nav .dropdown-menu {
        margin-top: 0.5rem; 
    }
    .nav-item :hover {
        color : #f77f00;
        transition : 0.3s ease-in-out;
        
    }
</style>
<body>
    <header class="bg-light sticky-top">
        <div class="d-flex" style="height:4px;">
            <div class="flex-fill" style="background:#f77f00;"></div>
            <div class="flex-fill bg-white"></div>
            <div class="flex-fill" style="background:#008000;"></div>
        </div>

        <div class="container">
            <div class="d-flex align-items-center justify-content-between py-3">
                <div class="d-flex align-items-center gap-3 flex-grow-1 flex-md-grow-0">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center overflow-hidden border border-success" style="width:40px; height:40px;">
                        <img src="{{ asset('storage/' . Auth::user()->direction->logo) }}" class="img-fluid" alt="Logo" style="max-height: 40px; width: auto; me-4">
                    </div>
                    <div class="d-none d-sm-block">
                        <h1 class="h6 fw-bold mb-0 uppercase">{{ Auth::user()->role}} • {{ Auth::user()->direction->code_direction }}</h1>
                        <p class="small mb-0 opacity-75">{{ Auth::user()->direction->nom_direction }}</p>
                    </div>
                </div>

                <div class="d-none d-md-flex flex-grow-1 mx-4" style="max-width:400px;">
                    <div class="input-group w-100">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" placeholder="Rechercher...">
                    </div>
                </div>

                <div class="d-flex align-items-center gap-4">
                    <button class="btn btn-outline-dark position-relative">
                        <a class="nav-link" href="{{ route('notifications.index') }}">
                            <i class="bi bi-bell"></i>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </span>
                                @endif
                            </a>
                    </button>

                    <div class="dropdown">
                        <button class="btn d-flex align-items-center gap-2 dropdown-toggle outline-none" data-bs-toggle="dropdown">
                            <span class="d-none d-md-inline">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="/userLog_out" method="POST" class="ms-3">
                                    @csrf
                                    <button type="submit" class="btn text-danger"><i class="fas fa-sign-out-alt"></i> Déconnexion</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <nav class="bg-success border-bottom sticky-top shadow-sm" style="top:68px; z-index:40;">
        <div class="container">
            <ul class="navbar-nav text-white d-flex flex-row justify-content-center gap-5 py-2">

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="/adminDashboard">
                        <i class="bi bi-grid-1x2 fs-5"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>

                @if(auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a href="/userlist" class="nav-link d-flex align-items-center gap-2">
                        <i class="bi bi-people fs-5"></i>
                        <span>Gestion Utilisateurs</span>
                    </a>
                </li>
                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="patrimoineDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-hdd-network fs-5"></i>
                        <span>Patrimoine</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="patrimoineDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="/stock_materiel">
                                <i class="bi bi-pc-display fs-6"></i>
                                Matériel Informatique
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('vehicules.index') }}">
                                <i class="bi bi-car-front fs-6"></i>
                                Gestion du parc auto 
                            </a>
                        </li>
                         <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('mobiliers.index') }}">
                               <i class="bi bi-lamp fs-6"></i>
                                Mobilier & materiel de bureau
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('patrimoine-divers.index') }}">
                                <i class="bi bi-journal-album fs-6"></i>
                                Fourniture & consomable
                            </a>
                        </li>
                
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="/list_logiciel">
                                <i class="bi bi-box-seam fs-6"></i>
                                Logiciels
                            </a>
                        </li>
                          <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('fin-vie.index') }}">
                                <i class="bi bi-hourglass-split fs-5 text-danger"></i>
                                Fin de durée de vie
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/list_poste" class="nav-link d-flex align-items-center gap-2">
                      <i class="bi bi-pc-display fs-5"></i>
                        <span>Poste & Desktop</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="demandesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-envelope fs-5"></i>
                        <span>Demandes</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="demandesDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="/demande_maintenances">
                                <i class="bi bi-tools fs-6"></i>
                                Demandes Maintenances
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="/demande-materiel">
                                <i class="bi bi-laptop fs-6"></i>
                                Demandes Matériels
                            </a>
                        </li>
                         <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="/Mes_demandes_en_cours">
                                <i class="bi bi-clock-history fs-6"></i>
                                Mes demandes en cours
                            </a>
                        </li>
                    </ul>
                </li>
                   @if(auth()->user()->role == 'admin')
                        <li>
                            <a class="nav-link d-flex align-items-center gap-2" href="/journal">
                                <i class="bi bi-ui-checks fs-5"></i>
                                Journal d'activités
                            </a>
                        </li>
                        @endif

                <li class="nav-item">
                    <a href="{{ route('patrimoine-enleves.index') }}" class="nav-link d-flex align-items-center gap-2">
                        <i class="bi bi-archive fs-5"></i>
                        <span>Enlevés</span>
                    </a>
                </li>

            </ul>
        </div>
    </nav>
    @include('layouts.message')
        <div class="main-content px-5" id="main-content">
            @yield('content')
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>
</html>