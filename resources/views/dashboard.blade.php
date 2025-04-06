<!--
=========================================================
* Soft UI Dashboard - v1.0.7
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('img/roda.jpg') }}">
    <title>WoodWise - Gestión Forestal Inteligente</title>
  
    <!-- SEO Meta Tags -->
    <meta name="description" content="Sistema de gestión forestal WoodWise para cálculo de volúmenes maderables y administración de parcelas">
    <meta name="keywords" content="forestal, madera, gestión, woodwise, parcelas, especies">
  
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
    <link href="{{ asset('/css/alertify.min.css') }}" rel="stylesheet" />
    
    <style>
      :root {
        --wood-primary: #3A5F0B;
        --wood-secondary: #6B8E23;
        --wood-light: #B5C78E;
        --wood-dark: #1E3A00;
        --wood-accent: #8FBC8F;
        --sidebar-width: 280px;
      }
      
      body {
        font-family: 'Open Sans', sans-serif;
        background-color: #f8f9fa;
      }
      
      /* Sidebar mejorado */
      .sidenav {
        width: var(--sidebar-width);
        background: linear-gradient(180deg, var(--wood-dark), var(--wood-primary));
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        transition: all 0.3s;
      }
      
      .sidenav-header {
        padding: 1.5rem 1rem;
        border-bottom: 1px solid rgba(255,255,255,0.1);
      }
      
      .navbar-brand {
        color: white;
        font-weight: 700;
        font-size: 1.25rem;
        letter-spacing: 0.5px;
      }
      
      .nav-item {
        margin: 0.25rem 0.5rem;
      }
      
      .nav-link {
        color: rgba(255,255,255,0.8);
        border-radius: 0.5rem;
        transition: all 0.3s;
      }
      
      .nav-link:hover, .nav-link.active {
        background: rgba(255,255,255,0.1);
        color: white;
      }
      
      .nav-link-text {
        font-weight: 500;
      }
      
      .icon {
        background: rgba(255,255,255,0.9);
      }
      
      /* Navbar superior */
      .navbar-main {
        background: white;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        padding: 0.75rem 1rem;
      }
      
      .breadcrumb {
        font-size: 0.85rem;
      }
      
      /* Contenido principal */
      .main-content {
        margin-left: var(--sidebar-width);
        transition: all 0.3s;
      }
      
      @media (max-width: 1199.98px) {
        .sidenav {
          transform: translateX(-100%);
          position: fixed;
          z-index: 1031;
          height: 100vh;
        }
        
        .sidenav.show {
          transform: translateX(0);
        }
        
        .main-content {
          margin-left: 0;
        }
      }
      
      /* Colores para íconos */
      .text-primary { color: var(--wood-primary) !important; }
      .text-secondary { color: var(--wood-secondary) !important; }
      .text-success { color: #28a745 !important; }
      .text-info { color: #17a2b8 !important; }
      .text-warning { color: #ffc107 !important; }
      .text-danger { color: #dc3545 !important; }
      .text-dark { color: var(--wood-dark) !important; }
      
      /* Botones */
      .btn-outline-primary {
        border-color: var(--wood-primary);
        color: var(--wood-primary);
      }
      
      .btn-outline-primary:hover {
        background-color: var(--wood-primary);
        color: white;
      }
      
      /* Efectos */
      .transition-all {
        transition: all 0.3s ease;
      }
    </style>
  </head>

  <body class="g-sidenav-show bg-light">
    <!-- Sidebar -->
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start" id="sidenav-main">
    <div class="sidenav-header">
        <a class="navbar-brand m-0" href="#">
            <img src="{{ asset('img/woodwise.png') }}" class="me-2" height="30" alt="WoodWise Logo">
            <span class="font-weight-bold">WoodWise</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <!-- Sección Administrador -->
            @if(Auth::user()->persona->rol->nom_rol == 'Administrador')
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->is('usuarios*') ? 'active' : '' }}" href="{{ route('usuarios.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-shield fa-sm text-primary"></i>
                    </div>
                    <span class="nav-link-text">Gestión de Usuarios</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->is('asigna_parcelas*') ? 'active' : '' }}" href="{{ route('asigna_parcelas.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-map-marked-alt fa-sm text-info"></i>
                    </div>
                    <span class="nav-link-text">Asignación de Parcelas</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->is('formulas*') ? 'active' : '' }}" href="{{ route('formulas.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-square-root-alt fa-sm text-secondary"></i>
                    </div>
                    <span class="nav-link-text">Fórmulas de Cálculo</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->is('especies*') ? 'active' : '' }}" href="{{ route('especies.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-tree fa-sm text-success"></i>
                    </div>
                    <span class="nav-link-text">Catálogo de Especies</span>
                </a>
            </li>
            @endif

            <!-- Sección Administrador/Técnico -->
            @if(in_array(Auth::user()->persona->rol->nom_rol, ['Administrador', 'Tecnico']))
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->is('trozas*') ? 'active' : '' }}" href="{{ route('trozas.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-cut fa-sm text-warning"></i>
                    </div>
                    <span class="nav-link-text">Registro de Trozas</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->is('tipo_estimaciones*') ? 'active' : '' }}" href="{{ route('tipo_estimaciones.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-ruler-combined fa-sm text-info"></i>
                    </div>
                    <span class="nav-link-text">Tipos de Estimación</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->is('estimaciones*') ? 'active' : '' }}" href="{{ route('estimaciones.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-calculator fa-sm text-danger"></i>
                    </div>
                    <span class="nav-link-text">Estimaciones Volumétricas</span>
                </a>
            </li>
            @endif

            <!-- Sección Administrador/Productor -->
            @if(in_array(Auth::user()->persona->rol->nom_rol, ['Administrador', 'Productor']))
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->is('productores*') ? 'active' : '' }}" href="{{ route('productores.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-tractor fa-sm text-success"></i>
                    </div>
                    <span class="nav-link-text">Gestión de Productores</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->is('parcelas*') ? 'active' : '' }}" href="{{ route('parcelas.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-map fa-sm text-dark"></i>
                    </div>
                    <span class="nav-link-text">Administrar Parcelas</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->is('tecnicos*') ? 'active' : '' }}" href="{{ route('tecnicos.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-tie fa-sm text-secondary"></i>
                    </div>
                    <span class="nav-link-text">Equipo Técnico</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->is('turno_cortas*') ? 'active' : '' }}" href="{{ route('turno_cortas.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-calendar-alt fa-sm text-primary"></i>
                    </div>
                    <span class="nav-link-text">Planificación de Cortas</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
    <div class="sidenav-footer px-3 py-4">
        <div class="text-center text-white opacity-8">
            <small>© {{ date('Y') }} WoodWise v1.0</small>
        </div>
    </div>
</aside>


<main class="main-content position-relative border-radius-lg">
  <!-- Navbar superior -->
  <nav class="navbar navbar-main navbar-expand-lg px-3 py-2 shadow-sm bg-white" id="navbarBlur">
    <div class="container-fluid">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0">
          <li class="breadcrumb-item text-sm text-muted">
            <a class="text-secondary" href="{{ route('dashboard1') }}">Inicio</a>
          </li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
            @yield('breadcrumb', 'Dashboard')
          </li>
        </ol>
        <h6 class="font-weight-bold mb-0">@yield('title', 'Panel de Control')</h6>
      </nav>

      <div class="collapse navbar-collapse justify-content-end" id="navbar">
        <ul class="navbar-nav">
          <li class="nav-item mx-1">
            <a class="btn btn-sm btn-outline-secondary" href="{{ route('especies.catalogo') }}">
              <i class="fas fa-seedling me-1"></i> Catálogo
            </a>
          </li>
          <li class="nav-item mx-1">
            <a class="btn btn-sm btn-outline-primary" href="{{ route('perfil.index') }}">
              <i class="fas fa-user me-1"></i> Perfil
            </a>
          </li>
          <li class="nav-item mx-1">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-sm btn-outline-danger">
                <i class="fas fa-sign-out-alt me-1"></i> Salir
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Contenido principal -->
  <div class="container-fluid py-4">
    @yield('crud_content')
  </div>
</main>
   <!-- Scripts -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <script src="{{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
   <script src="{{ asset('/js/alertify.min.js') }}"></script>
   
   <script>
     // Toggle sidebar en móviles
     document.getElementById('iconSidenav').addEventListener('click', function() {
       document.getElementById('sidenav-main').classList.toggle('show');
     });
 
     // Cerrar sidebar al hacer clic fuera en móviles
     document.addEventListener('click', function(event) {
       const sidebar = document.getElementById('sidenav-main');
       const toggleBtn = document.getElementById('iconSidenav');
       
       if (window.innerWidth < 1200 && 
           !sidebar.contains(event.target) && 
           event.target !== toggleBtn && 
           !toggleBtn.contains(event.target)) {
         sidebar.classList.remove('show');
       }
     });
 
     // Mostrar mensajes de alerta
     @if(session('success'))
       alertify.success('{{ session('success') }}');
     @endif
     
     @if(session('error'))
       alertify.error('{{ session('error') }}');
     @endif
   </script>
   @stack('scripts')
 </body>
 </html>