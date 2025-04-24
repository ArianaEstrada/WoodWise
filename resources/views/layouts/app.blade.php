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

    <style>
        :root {
            --wood-dark: #5E3023;
            --wood-medium: #895737;
            --wood-light: #B88B4A;
            --wood-accent: #6B8E23;
            --wood-text: #3A2D13;
            --wood-bg-light: #F8F5F0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--wood-bg-light);
            color: var(--wood-text);
            overflow-x: hidden;
        }

        /* Navbar Premium */
        .navbar {
            background: linear-gradient(135deg, var(--wood-dark), var(--wood-medium));
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            padding: 0.8rem 0;
            transition: all 0.3s;
        }

        .navbar.scrolled {
            padding: 0.5rem 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
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
            background: linear-gradient(135deg, var(--wood-dark), #001524);
            color: white;
            padding: 4rem 0 2rem;
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

        /* Botones */
        .btn-wood {
            background-color: var(--wood-accent);
            color: white;
            font-weight: 600;
            border: none;
            padding: 0.7rem 1.8rem;
            border-radius: 8px;
            transition: all 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-wood:hover {
            background-color: #5a7720;
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
            color: white;
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
