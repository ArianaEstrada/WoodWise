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
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('img/roda.jpg') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- FontAwesome para los íconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <title>
    WoodWise
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.0-beta2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('/assets/css/nucleo-icons.css') }}" rel="stylesheet" />

  <link href="{{ asset('/assets/css/nucleo-svg.css') }}" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <link href="{{ asset('/css/alertify.min.css') }}" rel="stylesheet" />

  <!-- CSS Files -->
  <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/css/soft-ui-dashboard.css?v=1.0.7') }}">
  <link id="pagestyle" href="{{ asset('/asset/css/soft-ui-dashboard.css?v=1.0.7')}}" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-light">

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl fixed-start bg-light px-2" id="sidenav-main">
    <div class="sidenav-header d-flex align-items-center justify-content-between p-2">
        <a class="navbar-brand m-0" href="#">
            <span class="ms-1 font-weight-bold">WoodWise</span>
        </a>
        <button class="btn-close d-xl-none" id="iconSidenav"></button>
    </div>
    <hr class="horizontal dark mt-1 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
        @if( Auth::user()->persona->rol->nom_rol == 'Administrador')
            <li class="nav-item mb-1">
                <a class="nav-link active d-flex align-items-center py-2" href="{{ route('usuarios.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                        <i class="fas fa-users text-primary"></i>
                    </div>
                    <span class="nav-link-text">Gestión de Usuario</span>
                </a>
            </li>
            <li class="nav-item mb-1">
              <a class="nav-link active d-flex align-items-center py-2" href="{{ route('asigna_parcelas.index') }}">
                  <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                      <i class="fas fa-users text-primary"></i>
                  </div>
                  <span class="nav-link-text">Asignacion de parcelas</span>
              </a>
          </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center py-2" href="{{ route('formulas.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                        <i class="fas fa-flask text-secondary"></i>
                    </div>
                    <span class="nav-link-text">Gestión de Fórmulas</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center py-2" href="{{ route('especies.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                        <i class="fas fa-tree text-success"></i>
                    </div>
                    <span class="nav-link-text">Gestión de Especies</span>
                </a>
            </li>
            @endif
            @if( Auth::user()->persona->rol->nom_rol == 'Administrador' || Auth::user()->persona->rol->nom_rol == 'Tecnico')
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center py-2" href="{{ route('trozas.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                        <i class="fas fa-cubes text-warning"></i>
                    </div>
                    <span class="nav-link-text">Gestión de Trozas</span>
                </a>
            </li>
            
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center py-2" href="{{ route('tipo_estimaciones.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                        <i class="fas fa-chart-line text-info"></i>
                    </div>
                    <span class="nav-link-text">Tipo Estimaciones</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center py-2" href="{{ route('estimaciones.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                        <i class="fas fa-chart-pie text-danger"></i>
                    </div>
                    <span class="nav-link-text">Estimaciones</span>
                </a>
            </li>
            @endif
            @if( Auth::user()->persona->rol->nom_rol == 'Administrador' || Auth::user()->persona->rol->nom_rol == 'Productor')
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center py-2" href="{{ route('productores.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                        <i class="fas fa-leaf text-success"></i>
                    </div>
                    <span class="nav-link-text">Productor</span>
                </a>
            </li>

            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center py-2" href="{{ route('parcelas.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                        <i class="fas fa-map-marked-alt text-dark"></i>
                    </div>
                    <span class="nav-link-text">Gestión de Parcelas</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center py-2" href="{{ route('tecnicos.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                        <i class="fas fa-file-alt text-secondary"></i>
                    </div>
                    <span class="nav-link-text">Tecnicos</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center py-2" href="{{ route('turno_cortas.index') }}">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                        <i class="fas fa-clock text-primary"></i>
                    </div>
                    <span class="nav-link-text">Gestión de Turno Corta</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</aside>



  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-3 py-2 shadow-sm bg-white border-bottom" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid">
        <!-- Breadcrumb y título -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0">
                <li class="breadcrumb-item text-muted">
                    <a class="text-secondary" href="#"><i class="fas fa-globe"></i> Aplicación Web</a>
                </li>
                <li class="breadcrumb-item text-dark active" aria-current="page">
                    <i class="fas fa-tree"></i> WoodWise
                </li>
            </ol>
            <h5 class="font-weight-bold text-primary mb-0"><i class="fas fa-cogs"></i> Gestión del Sistema</h5>
        </nav>

        <!-- Navbar colapsable -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbar">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="btn btn-outline-primary btn-sm me-2" href="{{ route('especies.catalogo') }}">
                        <i class="fas fa-seedling"></i> Catálogo de especies
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-secondary btn-sm me-2" href="{{ route('perfil.index') }}">
                        <i class="fas fa-user"></i> Perfil
                    </a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>





<div class="col-md-10 ">

        @yield('crud_content')

</div>


  </main>
  <!--   Core JS Files   -->
  <script src=" {{ asset('/assets/js/core/popper.min.js') }}">

  </script>
  <script src=" {{ asset('/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="  {{ asset('/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/chartjs.min.js') }}"></script>
  <script src="{{ asset('/js/alertify.min.js') }}"></script>
  <script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Sales",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#fff",
          data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
          maxBarThickness: 6
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 15,
              font: {
                size: 14,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false
            },
            ticks: {
              display: false
            },
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(135, 108, 17, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(135, 108, 17, 0.2)');
    gradientStroke1.addColorStop(0, 'rgba(135, 108, 17, 0.2)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(135, 108, 17, 0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(135, 108, 17, 0.2)');
    gradientStroke2.addColorStop(0, 'rgba(135, 108, 17, 0.2)'); //purple colors

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Mobile apps",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#cb0c9f",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6

          },
          {
            label: "Websites",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#3A416F",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            fill: true,
            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
            maxBarThickness: 6
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#b2b9bf',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#b2b9bf',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>
