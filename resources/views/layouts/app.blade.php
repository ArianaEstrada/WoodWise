<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="WoodWise - Solución tecnológica para gestión forestal sostenible y cálculo preciso de volúmenes maderables">
    <title>@yield('title', 'WoodWise - Gestión Forestal Inteligente')</title>

    <!-- Estilos -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
      :root {
    /* Paleta profesional de verdes forestales */
    --wood-dark: #1a3a16;        /* Verde bosque profundo - profesional y legible */
    --wood-medium: #4a3c27;      /* Marrón corteza - elegante y neutral */
    --wood-light: #e8d8b5;       /* Beige claro - más suave que el anterior */
    --wood-accent: #4a7c30;      /* Verde profesional - menos vibrante, más serio */
    --wood-text: #2b2b2b;        /* Texto casi negro - mejor contraste */
    --wood-bg-light: #f5f7f2;    /* Fondo claro con tono verde muy suave */
    --wood-bg-dark: #0f1a0c;     /* Fondo oscuro verde oscuro - profesional */
    
    /* Variables de diseño (sin cambios) */
    --wood-border-radius: 12px;
    --wood-box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    --wood-transition: all 0.3s ease-in-out;
}
        body {
              font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    letter-spacing: 0.01em;
        }
/* Mejores títulos */
h1, h2, h3, h4, h5, h6 {
    font-weight: 700;
    letter-spacing: -0.025em;
    margin-bottom: 1.25rem;
}

/* Espaciado consistente */
.container {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}

main {
    padding-top: 3rem;
    padding-bottom: 5rem;
}
       /* Navbar Premium Mejorado */
.navbar {
    background: linear-gradient(135deg, var(--wood-dark), var(--wood-medium));
    box-shadow: var(--wood-box-shadow);
    padding: 0.8rem 0;
    transition: var(--wood-transition);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.navbar-brand {
    font-weight: 700;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    transition: var(--wood-transition);
}

.navbar-brand:hover {
    transform: translateY(-2px);
}

.nav-link {
    font-weight: 500;
    padding: 0.5rem 1rem;
    margin: 0 0.3rem;
    border-radius: var(--wood-border-radius);
    transition: var(--wood-transition);
    color: white !important;
    position: relative;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.nav-link.active {
    background: var(--wood-accent);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}
.nav-link:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: var(--wood-light);
    transform: translateX(-100%);
    transition: var(--wood-transition);
}
/* Efecto hover más suave */
.nav-link:hover:not(.active) {
    background: rgba(255, 255, 255, 0.08);
    transform: translateY(-2px);
}

/* Indicador activo para menú */
.nav-link.active:after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 50%;
    transform: translateX(-50%);
    width: 20px;
    height: 3px;
    background: var(--wood-light);
    border-radius: 3px;
}
.nav-link:hover:after {
    transform: translateX(0);
}

/* Animaciones mejoradas */
@keyframes float {
    0% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(3deg); }
    100% { transform: translateY(0px) rotate(0deg); }
}

.floating {
    animation: float 5s ease-in-out infinite;
    filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.2));
}
        .text-gradient {
            background: linear-gradient(to right, var(--wood-light), #d4a762);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .navbar-brand img {
            transition: transform 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .navbar-brand:hover img {
            transform: rotate(15deg);
        }

        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem;
            margin: 0 0.3rem;
            border-radius: 6px;
            transition: all 0.3s;
            color: white !important;
            position: relative;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-link.active {
            background: var(--wood-accent);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .nav-link i {
            margin-right: 6px;
        }

        /* Main Content */
        main {
            padding-top: 2rem;
            padding-bottom: 4rem;
        }

        /* Footer Premium */
       .footer {
    position: relative;
    overflow: hidden;
}

.footer:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 10px;
    background: linear-gradient(to right, var(--wood-accent), var(--wood-light));
    z-index: 1;
}

.footer:before {
    content: '';
    position: absolute;
    bottom: 10px;
    left: 0;
    width: 200%;
    height: 100px;
    background: url("data:image/svg+xml,%3Csvg viewBox='0 0 1200 120' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' fill='%23f8f5f0'/%3E%3C/svg%3E");
    background-size: 50% 100px;
    animation: wave 15s linear infinite;
    opacity: 0.1;
}

@keyframes wave {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

        .footer-logo {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .footer-logo span {
            color: var(--wood-light);
        }

        .footer h5 {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .footer h5:after {
            content: '';
            position: absolute;
            width: 40%;
            height: 2px;
            background: var(--wood-light);
            bottom: -8px;
            left: 0;
        }

        .footer ul {
            list-style: none;
            padding: 0;
        }

        .footer li {
            margin-bottom: 0.8rem;
        }

        .footer a {
            color: #adb5bd;
            text-decoration: none;
            transition: all 0.3s;
        }

        .footer a:hover {
            color: var(--wood-light);
            padding-left: 5px;
        }

        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            margin-right: 10px;
            transition: all 0.3s;
        }

        .social-icons a:hover {
            background: var(--wood-light);
            transform: translateY(-3px);
        }

        .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            margin-top: 3rem;
            font-size: 0.9rem;
            color: #adb5bd;
        }
.wood-card {
    border: none;
    border-radius: var(--wood-border-radius);
    overflow: hidden;
    transition: var(--wood-transition);
    background: white;
    position: relative;
}

.wood-card:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(to right, var(--wood-accent), var(--wood-light));
}

.wood-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}
        /* Botones */
       /* Botones mejorados */
.btn-wood {
    background-color: var(--wood-accent);
    color: white;
    font-weight: 600;
    border: none;
    padding: 0.7rem 1.8rem;
    border-radius: var(--wood-border-radius);
    transition: var(--wood-transition);
    box-shadow: var(--wood-box-shadow);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-wood:hover {
    background-color:#5a7720;
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    color: white;
}

/* Variantes de botones */
.btn-wood-outline {
    background: transparent;
    border: 2px solid var(--wood-accent);
    color: var(--wood-accent);
}

.btn-wood-outline:hover {
    background: var(--wood-accent);
    color: white;
}

.btn-wood-light {
    background-color: var(--wood-light);
    color: var(--wood-text);
}

.btn-wood-light:hover {
    background-color: #c99b4a;
    color: var(--wood-text);
}

        /* Efectos */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .floating {
            animation: float 4s ease-in-out infinite;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 0.5rem 0;
            }

            .footer {
                padding: 3rem 0 1.5rem;
            }

            .footer .col-md-4 {
                margin-bottom: 2rem;
            }
        }
        /* Tarjetas mejoradas */
.wood-card {
    border: none;
    border-radius: var(--wood-border-radius);
    box-shadow: var(--wood-box-shadow);
    transition: var(--wood-transition);
    overflow: hidden;
    background: white;
}

.wood-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
}

.wood-card-header {
    background: linear-gradient(135deg, var(--wood-medium), var(--wood-dark));
    color: white;
    padding: 1.2rem;
    border-bottom: 2px solid var(--wood-light);
}

.wood-card-body {
    padding: 1.5rem;
}

.wood-card-footer {
    background: var(--wood-bg-light);
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    padding: 1rem 1.5rem;
}
/* Tablas mejoradas */
.wood-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: var(--wood-border-radius);
    overflow: hidden;
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05);
}

.wood-table thead th {
    background: linear-gradient(to bottom, var(--wood-medium), var(--wood-dark));
    color: white;
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    border: none;
}

.wood-table tbody tr {
    transition: var(--wood-transition);
}

.wood-table tbody tr:hover {
    background-color: rgba(184, 139, 74, 0.1);
}

.wood-table tbody td {
    padding: 1rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    vertical-align: middle;
}

.wood-table tbody tr:last-child td {
    border-bottom: none;
}
/* Footer mejorado */
.footer {
    background: linear-gradient(135deg, var(--wood-dark), #001524);
    color: white;
    padding: 4rem 0 2rem;
    position: relative;
    margin-top: 4rem;
}

.footer:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(to right, var(--wood-accent), var(--wood-light));
}

.footer h5 {
    font-size: 1.2rem;
    margin-bottom: 1.5rem;
    position: relative;
    display: inline-block;
    font-weight: 600;
}

.footer h5:after {
    content: '';
    position: absolute;
    width: 50px;
    height: 3px;
    background: var(--wood-light);
    bottom: -8px;
    left: 0;
    border-radius: 3px;
}

.social-icons a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 50%;
    color: white;
    margin-right: 12px;
    transition: var(--wood-transition);
    font-size: 1.1rem;
}

.social-icons a:hover {
    background: var(--wood-light);
    transform: translateY(-3px) scale(1.1);
    color: var(--wood-text);
}
/* Efectos visuales mejorados */
@keyframes float {
    0% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-12px) rotate(2deg); }
    100% { transform: translateY(0px) rotate(0deg); }
}

.floating {
    animation: float 4s ease-in-out infinite;
    transition: var(--wood-transition);
}

.floating:hover {
    animation-play-state: paused;
}

/* Efecto de onda para elementos interactivos */
.wave-effect {
    position: relative;
    overflow: hidden;
}

.wave-effect:after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 5px;
    height: 5px;
    background: rgba(255, 255, 255, 0.4);
    opacity: 0;
    border-radius: 100%;
    transform: scale(1, 1) translate(-50%);
    transform-origin: 50% 50%;
}

.wave-effect:focus:after,
.wave-effect:active:after {
    animation: wave 0.6s ease-out;
}

@keyframes wave {
    0% {
        transform: scale(0, 0);
        opacity: 0.5;
    }
    100% {
        transform: scale(20, 20);
        opacity: 0;
    }
}
/* Clases utilitarias */
.wood-bg-gradient {
    background: linear-gradient(135deg, var(--wood-medium), var(--wood-dark));
}

.wood-text-gradient {
    background: linear-gradient(to right, var(--wood-light), var(--wood-accent));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.wood-divider {
    height: 3px;
    background: linear-gradient(to right, transparent, var(--wood-light), transparent);
    border: none;
    margin: 2rem 0;
}

.wood-badge {
    display: inline-block;
    padding: 0.35em 0.65em;
    font-size: 0.75em;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 50rem;
    background: var(--wood-accent);
    color: white;
}

/* Sombras consistentes */
.wood-shadow-sm {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.wood-shadow {
    box-shadow: var(--wood-box-shadow);
}

.wood-shadow-lg {
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
}
    </style>
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Encabezado Premium -->
    <header class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <img src="{{ asset('img/woodwise.png') }}"
                     alt="WoodWise Logo"
                     width="50"
                     height="50"
                     class="me-2 rounded-circle floating">
                <span class="text-gradient">WoodWise</span>
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-1">
                    @auth
                        @if(Auth::user()->persona->rol->nom_rol == 'Tecnico')
                            <li class="nav-item ms-lg-3">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="nav-link bg-danger bg-opacity-90 border-0">
                                        <i class="bi bi-box-arrow-right"></i> Salir
                                    </button>
                                </form>
                            </li>
                        @else
                            <!-- Menú normal para otros usuarios -->
                            <li class="nav-item">
                                <a href="{{ route('welcome') }}"
                                   class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}">
                                    <i class="bi bi-house-door-fill"></i> Inicio
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('acerca') }}"
                                   class="nav-link {{ request()->routeIs('acerca') ? 'active' : '' }}">
                                    <i class="bi bi-info-circle-fill"></i> Acerca
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('contacto') }}"
                                   class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}">
                                    <i class="bi bi-envelope-fill"></i> Contacto
                                </a>
                            </li>
                            <li class="nav-item ms-lg-3">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="nav-link bg-danger bg-opacity-90 border-0">
                                        <i class="bi bi-box-arrow-right"></i> Salir
                                    </button>
                                </form>
                            </li>
                        @endif
                    @else
                        <!-- Menú para usuarios no autenticados -->
                        <li class="nav-item">
                            <a href="{{ route('welcome') }}"
                               class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}">
                                <i class="bi bi-house-door-fill"></i> Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('acerca') }}"
                               class="nav-link {{ request()->routeIs('acerca') ? 'active' : '' }}">
                                <i class="bi bi-info-circle-fill"></i> Acerca
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contacto') }}"
                               class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}">
                                <i class="bi bi-envelope-fill"></i> Contacto
                            </a>
                        </li>
                        <li class="nav-item ms-lg-3">
                            <a href="{{ route('login') }}"
                               class="nav-link bg-success bg-opacity-90">
                                <i class="bi bi-box-arrow-in-right"></i> Ingresar
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Pie de página Premium -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h3 class="footer-logo">Wood<span>Wise</span></h3>
                    <p>Tecnología avanzada para la gestión forestal sostenible. Optimización de recursos con precisión científica.</p>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="https://www.instagram.com/x_edsonj?igsh=Ynh0cXBsZXFpZDR6"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4">
                    <h5>Enlaces</h5>
                    <ul>
                        <li><a href="{{ route('welcome') }}">Inicio</a></li>
                        <li><a href="{{ route('acerca') }}">Acerca de</a></li>
                        <li><a href="{{ route('contacto') }}">Contacto</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4">
                    <h5>Contacto</h5>
                    <ul>
                        <li><i class="bi bi-geo-alt me-2"></i> Av. Forestal 123, Santiago</li>
                        <li><i class="bi bi-telephone me-2"></i> +56 9 1234 5678</li>
                        <li><i class="bi bi-envelope me-2"></i> contacto@woodwise.cl</li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4">
                    <h5>Legal</h5>
                    <ul>
                        <li><a href="#">Términos y condiciones</a></li>
                        <li><a href="#">Política de privacidad</a></li>
                        <li><a href="#">Sustentabilidad</a></li>
                        <li><a href="#">Certificaciones</a></li>
                    </ul>
                </div>
            </div>

            <div class="copyright text-center">
                <p class="mb-2">© 2025 WoodWise - Todos los derechos reservados</p>
                <small>Desarrollado con <i class="bi bi-heart-fill text-danger"></i> por CDN</small>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Efecto de scroll en navbar
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Validación de formularios
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Scroll suave
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
