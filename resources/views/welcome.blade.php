<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="WoodWise - Solución tecnológica para cálculo preciso de volúmenes maderables y gestión forestal sostenible">
    <title>WoodWise - Gestión Inteligente de Bosques</title>

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
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), 
                        url('{{ asset("img/forest-bg.jpg") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 90vh;
            display: flex;
            align-items: center;
        }
        
        .hero-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.5s ease;
        }
        
        .hero-card:hover {
            transform: translateY(-10px);
        }
        
        .hero-img {
            border-right: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background-color: white;
        }
        
        .hero-img img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s ease;
        }
        
        .hero-img:hover img {
            transform: scale(1.03);
        }
        
        .hero-content {
            padding: 3rem;
        }
        
        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--wood-dark);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .hero-title span {
            color: var(--wood-accent);
        }
        
        .hero-text {
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 2rem;
            color: var(--wood-text);
        }
        
        .btn-wood {
            background-color: var(--wood-accent);
            color: white;
            font-weight: 600;
            padding: 0.7rem 1.8rem;
            border-radius: 8px;
            border: none;
            transition: all 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-wood:hover {
            background-color: #5a7720;
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
            color: white;
        }
        
        .btn-outline-wood {
            border: 2px solid var(--wood-accent);
            color: var(--wood-accent);
            font-weight: 600;
            padding: 0.6rem 1.8rem;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .btn-outline-wood:hover {
            background-color: var(--wood-accent);
            color: white;
            transform: translateY(-3px);
        }
        
        /* Footer Premium */
        .footer {
            background: linear-gradient(135deg, var(--wood-dark), #4a2519);
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
            width: 50%;
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
            color: #d1d1d1;
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
            color: #aaa;
        }
        
        /* Animaciones */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .floating {
            animation: float 4s ease-in-out infinite;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.2rem;
            }
            
            .hero-img {
                border-right: none;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }
        }
        
        @media (max-width: 768px) {
            .hero-content {
                padding: 2rem;
                text-align: center;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .btn-group {
                justify-content: center;
            }
        }
    </style>
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
                           class="nav-link active">
                            <i class="bi bi-house-door-fill"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('acerca') }}" 
                           class="nav-link">
                            <i class="bi bi-info-circle-fill"></i> Acerca
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contacto') }}" 
                           class="nav-link">
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
        @section('content')
        <section class="hero-section py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="hero-card animate__animated animate__fadeIn">
                            <div class="row g-0">
                                <div class="col-md-6 hero-img">
                                    <img src="{{ asset('img/portada.jpg') }}" 
                                         class="img-fluid" 
                                         alt="Sistema WoodWise en acción"
                                         loading="lazy">
                                </div>
                                <div class="col-md-6 hero-content">
                                    <h1 class="hero-title">Bienvenido a <span>WoodWise</span></h1>
                                    <p class="hero-text">
                                        La solución tecnológica más avanzada para el cálculo preciso de volúmenes maderables. 
                                        Nuestra plataforma combina algoritmos inteligentes con datos satelitales para ofrecer 
                                        la gestión forestal más eficiente del mercado, garantizando precisión y sostenibilidad 
                                        en cada análisis.
                                    </p>
                                    <div class="d-flex flex-wrap gap-3 btn-group">
                                        <a href="{{ route('login') }}" class="btn btn-wood">
                                            <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                                        </a>
                                        <a href="{{ route('register') }}" class="btn btn-outline-wood">
                                            <i class="bi bi-person-plus"></i> Registrarse
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @show
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
        // Efecto de scroll suave
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        
        // Animación al hacer scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.2)';
                navbar.style.padding = '0.5rem 0';
            } else {
                navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.15)';
                navbar.style.padding = '0.8rem 0';
            }
        });
    </script>
</body>
</html>