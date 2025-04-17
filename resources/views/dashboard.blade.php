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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Roboto+Condensed:400,700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
    <link href="{{ asset('/css/alertify.min.css') }}" rel="stylesheet" />
    
    <style>
      :root {
        /* Paleta de colores forestal profesional */
        --wood-primary: #2C5E1A;
        --wood-primary-dark: #1F4712;
        --wood-primary-light: #4D8C2B;
        --wood-secondary: #6B8E23;
        --wood-accent: #8FBC8F;
        --wood-light: #E8F5E9;
        --wood-dark: #1E3A00;
        --wood-text: #333333;
        --wood-text-light: #5D6D63;
        
        --sidebar-width: 280px;
        --navbar-height: 60px;
      }
      
      body {
        font-family: 'Roboto Condensed', 'Open Sans', sans-serif;
        background-color: #f8f9fa;
        color: var(--wood-text);
        min-height: 100vh;
      }
      
      /* Sidebar - Mejorado con gradiente y sombras */
      .sidenav {
        width: var(--sidebar-width);
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1040;
        background: linear-gradient(160deg, var(--wood-primary-dark), var(--wood-primary));
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      }
      
      .sidenav-header {
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.12);
      }
      
      .navbar-brand {
        color: white;
        font-weight: 700;
        font-size: 1.4rem;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
      }
      
      .navbar-brand img {
        margin-right: 12px;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        transition: transform 0.3s ease;
      }
      
      .navbar-brand:hover img {
        transform: scale(1.05);
      }
      
      .nav-item {
        margin: 0.3rem 0.8rem;
      }
      
      .nav-link {
        color: rgba(255, 255, 255, 0.85);
        border-radius: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 0.8rem 1rem;
        display: flex;
        align-items: center;
        font-weight: 500;
        position: relative;
        overflow: hidden;
      }
      
      .nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: var(--wood-accent);
        transform: scaleY(0);
        transition: transform 0.3s ease;
      }
      
      .nav-link:hover, .nav-link.active {
        background: rgba(255, 255, 255, 0.08);
        color: white;
        transform: translateX(4px);
      }
      
      .nav-link:hover::before, .nav-link.active::before {
        transform: scaleY(1);
      }
      
      .nav-link-text {
        margin-left: 12px;
        font-size: 0.95rem;
      }
      
      .icon {
        background: rgba(255, 255, 255, 0.95);
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
      }
      
      .nav-link:hover .icon {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
      }
      
      /* Navbar superior - Estilo profesional */
      .navbar-main {
        position: fixed;
        left: var(--sidebar-width);
        top: 0;
        right: 0;
        height: var(--navbar-height);
        z-index: 1030;
        background: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        padding: 0.5rem 1.5rem;
        transition: all 0.3s ease;
      }
      
      .breadcrumb {
        font-size: 0.85rem;
        margin-bottom: 0.25rem;
      }
      
      .breadcrumb-item a {
        color: var(--wood-text-light);
        text-decoration: none;
        transition: color 0.2s ease;
      }
      
      .breadcrumb-item a:hover {
        color: var(--wood-primary);
      }
      
      .breadcrumb-item.active {
        color: var(--wood-primary);
        font-weight: 500;
      }
      
      .navbar-main h6 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--wood-primary-dark);
        margin-bottom: 0;
      }
      
      /* Contenido principal */
      .main-content {
        margin-left: var(--sidebar-width);
        padding: 25px;
        margin-top: var(--navbar-height);
        transition: all 0.3s ease;
      }
      
      /* Botones - Estilo mejorado */
      .btn-outline-primary {
        border-color: var(--wood-primary);
        color: var(--wood-primary);
        border-width: 1.5px;
        font-weight: 500;
        padding: 0.375rem 0.75rem;
        transition: all 0.3s ease;
      }
      
      .btn-outline-primary:hover {
        background-color: var(--wood-primary);
        color: white;
        box-shadow: 0 4px 12px rgba(44, 94, 26, 0.2);
      }
      
      .btn-outline-secondary {
        border-color: var(--wood-text-light);
        color: var(--wood-text-light);
      }
      
      .btn-outline-secondary:hover {
        background-color: var(--wood-text-light);
        color: white;
      }
      
      .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
      }
      
      .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
      }
      
      /* Footer de la barra lateral */
      .sidenav-footer {
        margin-top: auto;
        padding: 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.12);
      }
      
      .sidenav-footer small {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.8rem;
      }
      
      /* Efectos y transiciones */
      .transition-all {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      }
      
      /* Scrollbar personalizada */
      ::-webkit-scrollbar {
        width: 8px;
      }
      
      ::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.05);
      }
      
      ::-webkit-scrollbar-thumb {
        background: var(--wood-primary-light);
        border-radius: 4px;
      }
      
      ::-webkit-scrollbar-thumb:hover {
        background: var(--wood-primary);
      }
      
      /* Responsividad */
      @media (max-width: 1199.98px) {
        .sidenav {
          transform: translateX(-100%);
        }
        
        .sidenav.show {
          transform: translateX(0);
        }
        
        .navbar-main, .main-content {
          margin-left: 0;
          left: 0;
        }
      }
    </style>
  </head>

  <body class="g-sidenav-show bg-light">
    <!-- Sidebar - Versión mejorada visualmente -->
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start" id="sidenav-main">
      <div class="sidenav-header">
        <a class="navbar-brand m-0" href="{{ route('dashboard1') }}">
          <img src="{{ asset('img/woodwise.png') }}" class="me-2" height="32" alt="WoodWise Logo">
          <span class="font-weight-bold">WoodWise</span>
        </a>
      </div>
      <hr class="horizontal dark mt-0 mb-2 mx-3" style="border-color: rgba(255,255,255,0.15);">
      <div class="collapse navbar-collapse w-auto h-100" id="sidenav-collapse-main">
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
      <!-- Navbar superior - Versión mejorada -->
      <nav class="navbar navbar-main navbar-expand-lg px-3 py-2 shadow-sm" id="navbarBlur">
        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0">
              <li class="breadcrumb-item text-sm">
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