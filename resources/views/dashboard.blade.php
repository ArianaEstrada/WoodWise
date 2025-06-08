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
    <link href="{{ asset('/css/db.css') }}" rel="stylesheet" />
    <style>
      .sidenav .navbar-nav {
        max-height: calc(100vh - 140px);
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #90caf9 #1e2a38;
      }
      .sidenav .navbar-nav::-webkit-scrollbar {
        width: 8px;
        background: #1e2a38;
      }
      .sidenav .navbar-nav::-webkit-scrollbar-thumb {
        background: #90caf9;
        border-radius: 6px;
      }
      
      /* Estilos para la pantalla de bienvenida */
      .welcome-card {
        background: linear-gradient(135deg, #2e7d32, #1b5e20);
        border-radius: 16px;
        color: white;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      }
      
      .welcome-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: rgba(255,255,255,0.9);
      }
      
      .quick-stats-card {
        background: white;
        border-radius: 12px;
        transition: all 0.3s ease;
      }
      
      .quick-stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
      }
      
      .stat-icon {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
      }
    </style>
</head>
<body class="g-sidenav-show bg-light">
    <!-- Sidebar -->
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start" id="sidenav-main">
      <div class="sidenav-header">
        <a class="navbar-brand m-0" href="{{ route('dashboard1') }}">
          <img src="{{ asset('img/woodwise.png') }}" class="me-2" height="32" alt="WoodWise Logo">
          <span class="font-weight-bold text-white">WoodWise</span>
        </a>
      </div>
      <hr class="horizontal dark mt-0 mb-2 mx-3" style="border-color: rgba(255,255,255,0.15);">
      <div class="collapse navbar-collapse w-auto h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          @if(Auth::user()->persona->rol->nom_rol == 'Administrador')
          <!-- Menú del administrador -->
          <li class="nav-item mb-1">
            <a class="nav-link {{ request()->is('dashboard1') ? 'active' : '' }}" href="{{ route('dashboard1') }}">
              <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-home fa-sm text-primary"></i>
              </div>
              <span class="nav-link-text text-white">Inicio</span>
            </a>
          </li>
          
          <li class="nav-item mb-1">
            <a class="nav-link {{ request()->is('usuarios*') ? 'active' : '' }}" href="{{ route('usuarios.index') }}">
              <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-user-shield fa-sm text-primary"></i>
              </div>
              <span class="nav-link-text text-white">Gestión de Usuarios</span>
            </a>
          </li>      

          <li class="nav-item mb-1">
            <a class="nav-link {{ request()->is('especies*') ? 'active' : '' }}" href="{{ route('especies.index') }}">
              <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-tree fa-sm text-success"></i>
              </div>
              <span class="nav-link-text text-white">Catálogo de Especies</span>
            </a>
          </li>



          <li class="nav-item mb-1">
            <a class="nav-link {{ request()->is('formulas*') ? 'active' : '' }}" href="{{ route('formulas.index') }}">
              <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-square-root-alt fa-sm text-secondary"></i>
              </div>
              <span class="nav-link-text text-white">Fórmulas de Cálculo</span>
            </a>
          </li>


          <li class="nav-item mb-1">
            <a class="nav-link {{ request()->is('tipo_estimaciones*') ? 'active' : '' }}" href="{{ route('tipo_estimaciones.index') }}">
              <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-ruler-combined fa-sm text-info"></i>
              </div>
              <span class="nav-link-text text-white">Tipos de Estimación</span>
            </a>
          </li>

          <li class="nav-item mb-1">
            <a class="nav-link {{ request()->is('tecnicos*') ? 'active' : '' }}" href="{{ route('tecnicos.index') }}">
              <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-user-tie fa-sm text-secondary"></i>
              </div>
              <span class="nav-link-text text-white">Equipo Técnico</span>
            </a>
          </li>

          <li class="nav-item mb-1">
            <a class="nav-link {{ request()->is('productores*') ? 'active' : '' }}" href="{{ route('productores.index') }}">
              <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-tractor fa-sm text-success"></i>
              </div>
              <span class="nav-link-text text-white">Gestión de Productores</span>
            </a>
          </li>


          <li class="nav-item mb-1">
            <a class="nav-link {{ request()->is('parcelas*') ? 'active' : '' }}" href="{{ route('parcelas.index') }}">
              <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-map fa-sm text-dark"></i>
              </div>
              <span class="nav-link-text text-white">Administrar Parcelas</span>
            </a>
          </li>


          <li class="nav-item mb-1">
            <a class="nav-link {{ request()->is('turno_cortas*') ? 'active' : '' }}" href="{{ route('turno_cortas.index') }}">
              <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-calendar-alt fa-sm text-primary"></i>
              </div>
              <span class="nav-link-text text-white">Planificación de Cortas</span>
            </a>
          </li>


          <li class="nav-item mb-1">
            <a class="nav-link {{ request()->is('trozas*') ? 'active' : '' }}" href="{{ route('trozas.index') }}">
              <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-cut fa-sm text-warning"></i>
              </div>
              <span class="nav-link-text text-white">Registro de Trozas</span>
            </a>
          </li>


          <li class="nav-item mb-1">
            <a class="nav-link {{ request()->is('estimaciones*') ? 'active' : '' }}" href="{{ route('estimaciones.index') }}">
              <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-calculator fa-sm text-danger"></i>
              </div>
              <span class="nav-link-text text-white">Estimaciones Volumétricas</span>
            </a>

          <li class="nav-item mb-1">
            <a class="nav-link {{ request()->is('asigna_parcelas*') ? 'active' : '' }}" href="{{ route('asigna_parcelas.index') }}">
              <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-map-marked-alt fa-sm text-info"></i>
              </div>
              <span class="nav-link-text text-white">Asignación de Parcelas</span>
            </a>
          </li>
       
         <li class="nav-item mb-1">
  <a class="nav-link {{ request()->is('arboles_completos*') ? 'active' : '' }}" href="{{ route('arboles.index') }}">
    <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="fas fa-tree fa-sm text-warning"></i>
    </div>
    <span class="nav-link-text text-white">Árboles Completos</span>
  </a>
</li>

<li class="nav-item mb-1">
  <a class="nav-link {{ request()->is('estimaciones_arboles_completos*') ? 'active' : '' }}" href="{{ route('estimaciones1.index') }}">
    <div class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="fas fa-chart-bar fa-sm text-success"></i>
    </div>
    <span class="nav-link-text text-white">Estimaciones Árboles Completos</span>
  </a>
</li>
          
          <!-- ... resto de elementos del menú ... -->
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
        @if(request()->is('dashboard1') && Auth::user()->persona->rol->nom_rol == 'Administrador')
          <!-- Pantalla de bienvenida para administrador -->
          <div class="row mb-4">
            <div class="col-12">
              <div class="card welcome-card p-4">
                <div class="row align-items-center">
                  <div class="col-md-8">
                    <h2 class="text-white mb-3">Bienvenido, {{ Auth::user()->persona->nom }} {{ Auth::user()->persona->ap }}</h2>
                    <p class="text-white opacity-8 mb-0">Panel de administración del sistema WoodWise. Desde aquí podrás gestionar todos los aspectos del sistema forestal.</p>
                  </div>
                  <div class="col-md-4 text-center">
                    <div class="welcome-icon">
                      <i class="fas fa-tree"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Estadísticas rápidas -->
          <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
              <div class="card quick-stats-card h-100 p-3">
                <div class="card-body text-center">
                  <div class="stat-icon text-success">
                    <i class="fas fa-users"></i>
                  </div>
                  <h5 class="font-weight-bold mb-2">Usuarios</h5>
                  <h3 class="mb-0">{{ \App\Models\User::count() }}</h3>
                </div>
              </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
              <div class="card quick-stats-card h-100 p-3">
                <div class="card-body text-center">
                  <div class="stat-icon text-info">
                    <i class="fas fa-map-marked-alt"></i>
                  </div>
                  <h5 class="font-weight-bold mb-2">Parcelas</h5>
                  <h3 class="mb-0">{{ \App\Models\Parcela::count() }}</h3>
                </div>
              </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
              <div class="card quick-stats-card h-100 p-3">
                <div class="card-body text-center">
                  <div class="stat-icon text-warning">
                    <i class="fas fa-tree"></i>
                  </div>
                  <h5 class="font-weight-bold mb-2">Especies</h5>
                  <h3 class="mb-0">{{ \App\Models\Especie::count() }}</h3>
                </div>
              </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
              <div class="card quick-stats-card h-100 p-3">
                <div class="card-body text-center">
                  <div class="stat-icon text-danger">
                    <i class="fas fa-calendar-alt"></i>
                  </div>
                  <h5 class="font-weight-bold mb-2">Turnos Activos</h5>
                  <h3 class="mb-0">{{ \App\Models\Turno_Corta::whereNull('fecha_fin')->count() }}</h3>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Acciones rápidas -->
          <div class="row">
            <div class="col-12">
              <div class="card shadow-sm">
                <div class="card-header bg-white">
                  <h5 class="mb-0">Acciones Rápidas</h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3 mb-3">
                      <a href="{{ route('usuarios.index') }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-user-plus me-2"></i> Nuevo Usuario
                      </a>
                    </div>
                    <div class="col-md-3 mb-3">
                      <a href="{{ route('parcelas.index') }}" class="btn btn-outline-success w-100">
                        <i class="fas fa-map-marked-alt me-2"></i> Registrar Parcela
                      </a>
                    </div>
                    <div class="col-md-3 mb-3">
                      <a href="{{ route('turno_cortas.index') }}" class="btn btn-outline-info w-100">
                        <i class="fas fa-calendar-plus me-2"></i> Planificar Corta
                      </a>
                    </div>
                    <div class="col-md-3 mb-3">
                      <a href="{{ route('especies.index') }}" class="btn btn-outline-warning w-100">
                        <i class="fas fa-tree me-2"></i> Agregar Especie
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @else
          <!-- Contenido normal de CRUDs -->
          @yield('crud_content')
        @endif
      </div>
    </main>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
    // Sistema de gestión de modales mejorado
    document.addEventListener('DOMContentLoaded', function() {
        // Variable para rastrear el modal actual
        let currentModal = null;
        
        // Función para abrir modales de forma controlada
        function openModal(modalId) {
            // Cerrar modal actual si existe
            if (currentModal) {
                currentModal.hide();
            }
            
            const modalElement = document.querySelector(modalId);
            if (!modalElement) return;
            
            // Crear nueva instancia de modal
            currentModal = new bootstrap.Modal(modalElement, {
                backdrop: 'static', // Evita que se cierre haciendo clic fuera
                keyboard: false    // Evita que se cierre con ESC
            });
            
            // Configurar eventos para este modal
            modalElement.addEventListener('hidden.bs.modal', function() {
                currentModal = null;
            });
            
            // Mostrar el modal
            currentModal.show();
        }
        
        // Asignar eventos a todos los botones que abren modales
        document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const modalId = this.getAttribute('data-bs-target');
                openModal(modalId);
            });
        });
        
        // Función para eliminar con confirmación
        window.confirmDelete = function(url) {
            Swal.fire({
                title: '¿Confirmar eliminación?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                customClass: {
                    popup: 'rounded-3',
                    confirmButton: 'btn btn-danger px-4 rounded-pill',
                    cancelButton: 'btn btn-secondary px-4 rounded-pill ms-2'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    form.innerHTML = `
                        @csrf 
                        @method("DELETE")
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        };
        
        // Notificaciones automáticas
        @if(session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                title: '{{ session('success') }}',
                icon: 'success',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: 'var(--wood-light)',
                color: 'var(--wood-text)',
                iconColor: 'var(--wood-primary)'
            });
        @endif
        
        @if(session('error'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                title: '{{ session('error') }}',
                icon: 'error',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true
            });
        @endif
    });
    </script>
    @stack('scripts')
</body>
</html>