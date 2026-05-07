<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Patrimoine Informatique</title>
    <link rel="shortcut icon" href="/r.jfif" type="image/x-icon">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Semantic UI CSS -->
    <link rel="stylesheet" href="css/userDashboard.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.5.0/semantic.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>
</head>
<style>
    
:root {
    --primary-color: #3a7bd5;
    --primary-dark: #2c5fb3;
    --secondary-color: #f8f9fa;
    --text-color: #333;
    --text-muted: #6c757d;
    --border-radius: 10px;
    --box-shadow: 0 4px 12px rgba(128, 128, 128, 0.08);
    --transition: all 0.3s ease;
}
/* Panel principal */
.panel {
    background: var(--panel-color);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    margin-bottom: 2rem;
}

.panel-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e3e6f0;
}

.panel-title h2 {
    margin: 0;
    font-size: 1.25rem;
    color: #5a5c69;
}

/* Barre de recherche */
.search-bar {
    position: relative;
    width: 300px;
}

.search-bar input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #e3e6f0;
    border-radius: var(--border-radius);
    padding-right: 2.5rem;
}

.search-bar .icon {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--secondary-color);
}

/* Tableau des utilisateurs */
.users-table {
    width: 100%;
    border-collapse: collapse;
}

.users-table th {
    background-color: #009e5fcb;
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    color: #fff;
}

.users-table td {
    padding: 1rem;
    border-bottom: 1px solid #e3e6f0;
}

.user-cell {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.user-pic {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #e3e6f0;
    overflow: hidden;
}

.direction-logo {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Boutons d'action */
.panel-btn {
    background-color:  #009e5fcb;
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s;
}


.user-action {
    display: flex;
    gap: 0.5rem;
}

.action-btn {
    padding: 0.5rem;
    border-radius: 6px;
    color: #5213aad5;
    transition: all 0.3s;
    background-color: #f8f9fc;
}

.action-btn.delete:hover {
    color: var(--danger-color);
}

/* Modal */
.modal-content {
    border-radius: var(--border-radius);
}

.modal-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

.fields {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
}

.field input,
.field select {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #e3e6f0;
    border-radius: var(--border-radius);
}

.no-users {
    padding: 2rem;
    text-align: center;
    color: var(--secondary-color);
}

/* Main content styling */
.main-content {
    padding: 1rem;
    transition: var(--transition);
    min-height: 100vh;
}

.header-section {
    padding: 0.5rem ;
    margin-bottom: 2rem;
}

.mycontent {
    padding: 1.5rem;
    background-color: white;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
}

        
        .stat-card {
            background: #fafafaf6;
            border-radius: 7px;
            padding: 30px 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 44px;
        }
        
        .icon-purple {
            color: #9333ea;
        }
        
        .icon-green {
            color: #ea580c;
        }
        
        .icon-orange {
            color:  #16a34a;
        }
        
        .icon-blue {
            color: #2563eb;
        }
        
        .stat-number {
            font-size: 42px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
            line-height: 1;
        }
        
        .stat-label {
            font-size: 15px;
            color: #6b7280;
            font-weight: 400;
        }
</style>
<body>
  @include('layouts.message')
 <header class="bg-dark text-white sticky-top">
  <!-- Top bar with flag colors -->
  <div class="d-flex" style="height:4px;">
    <div class="flex-fill" style="background:#f77f00;"></div>
    <div class="flex-fill bg-white"></div>
    <div class="flex-fill" style="background:#008000;"></div>
  </div>

  <div class="container">
    <div class="d-flex align-items-center justify-content-between py-3">
      <!-- Logo and Title -->
      <div class="d-flex align-items-center gap-3 flex-grow-1 flex-md-grow-0">
        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center overflow-hidden" style="width:45px; height:45px;">
          <span class="fw-bold"style=" overflow: hidden;" ><img src="/mepd1.jpg" height="40" width="auto" alt="Logo GPI" class="me-2"></span>
        </div>
        <div class="d-none d-sm-block">
          <h1 class="h6 fw-bold mb-0">MINISTÈRE </h1>
          <p class="small mb-0 opacity-75">du Plan et du Développement</p>
        </div>
      </div>

      <!-- Search (hidden on mobile) -->
      <div class="d-none d-md-flex flex-grow-1 mx-4" style="max-width:400px;">
        <div class="input-group w-100">
          <span class="input-group-text bg-white border-end-0">
            <i class="fas fa-search text-muted"></i>
          </span>
          <input type="text" class="form-control border-start-0" placeholder="Rechercher...">
        </div>
      </div>

      <!-- Actions -->
      <div class="d-flex align-items-center gap-2">
        <!-- Notifications -->
        <button class="btn btn-outline-light position-relative">
          <i class="fas fa-bell"></i>
          <span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle"></span>
        </button>

        <!-- Dropdown user -->
        <div class="dropdown">
          <button class="btn d-flex align-items-center gap-2 dropdown-toggle outline-none" data-bs-toggle="dropdown">
            <div class="rounded-circle bg-success d-flex align-items-center justify-content-center text-white" style="width:32px; height:32px;">
              <i class="fas fa-user"></i>
            </div>
            <span class="d-none d-md-inline text-white">{{ Auth::user()->nom }}</span>
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

<nav class="bg-success text-white border-bottom sticky-top shadow-sm" style="top:68px; z-index:40;">
  <div class="container">
    <ul class="navbar-nav d-flex flex-row justify-content-center gap-5 py-2">
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="/superadmin/dashboard">
          <i class="fas fa-home"></i>
          <span>Tableau de bord</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link d-flex align-items-center gap-2 active-link" href="/directions/list-direction">
          <i class="fas fa-hotel"></i>
          <span>Directions</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="/directions/list-admin">
          <i class="fas fa-users"></i>
          <span>Utilisateurs</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="/superadmin/rapport">
          <i class="fas fa-file"></i>
          <span>Rapports</span>
        </a>
      </li>
    </ul>
  </div>
</nav>



    <!-- Main Content -->
    <div class="main-content px-5" id="main-content">
        @yield('content')
    </div>

      <!-- Footer -->
  <footer class="border-top bg-white mt-auto">
    <div class="container py-3 d-flex  flex-md-row justify-content-center align-items-center text-muted small">
      <p class="mb-0">© 2025 Ministère du Plan et du Développement - Côte d'Ivoire</p>
    </div>
  </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>