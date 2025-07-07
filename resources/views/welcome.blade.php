<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="WoodWise - Solución tecnológica para cálculo preciso de volúmenes maderables y gestión forestal sostenible">
    <title>WoodWise - Gestión Inteligente de Bosques</title>

    <!-- Fuentes y estilos -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    
    <style>
        :root {
            --wood-primary: #3A5A40;
            --wood-secondary: #588157;
            --wood-accent: #A3B18A;
            --wood-light: #DAD7CD;
            --wood-dark: #1A2E22;
            --wood-text: #344E41;
            --wood-bg-light: #F8F9FA;
            --wood-gradient: linear-gradient(135deg, #3A5A40 0%, #588157 100%);
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--wood-text);
            background-color: var(--wood-bg-light);
            overflow-x: hidden;
            line-height: 1.6;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }
        
        /* Video de fondo */
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        
        .video-background video {
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
            opacity: 0.15;
        }
        
        /* Navbar Premium */
        .navbar {
            background: var(--wood-gradient);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            transition: all 0.4s ease;
        }
        
        .navbar.scrolled {
            padding: 0.5rem 0;
            backdrop-filter: blur(10px);
            background: rgba(58, 90, 64, 0.9);
        }
        
        .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            font-size: 1.5rem;
        }
        
        .text-gradient {
            background: linear-gradient(to right, var(--wood-accent), #DAD7CD);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 700;
        }
        
        .navbar-brand img {
            transition: all 0.4s ease;
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand:hover img {
            transform: rotate(15deg) scale(1.1);
        }
        
        .nav-link {
            font-weight: 600;
            padding: 0.5rem 1.2rem;
            margin: 0 0.3rem;
            border-radius: 8px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            color: white !important;
            position: relative;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }
        
        .nav-link:before {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--wood-accent);
            transition: all 0.3s ease;
            opacity: 0;
        }
        
        .nav-link:hover:before {
            width: 60%;
            opacity: 1;
        }
        
        .nav-link:hover {
            transform: translateY(-2px);
        }
        
        .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .nav-link.active:before {
            width: 60%;
            opacity: 1;
        }
        
        .nav-link i {
            margin-right: 8px;
            font-size: 1.1rem;
        }
        
        /* Hero Section */
        .hero-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 6rem 0;
            overflow: hidden;
        }
        
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(26, 46, 34, 0.6);
            z-index: 0;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .hero-card:hover {
            transform: translateY(-10px) scale(1.01);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
        }
        
        .hero-img {
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }
        
        .hero-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }
        
        .hero-img:hover img {
            transform: scale(1.05);
        }
        
        .hero-img:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(58, 90, 64, 0.1), rgba(26, 46, 34, 0.4));
        }
        
        .hero-text-content {
            padding: 3.5rem;
        }
        
        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--wood-primary);
            margin-bottom: 1.8rem;
            line-height: 1.2;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .hero-title span {
            color: var(--wood-secondary);
            position: relative;
        }
        
        .hero-title span:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 4px;
            bottom: 5px;
            left: 0;
            background: var(--wood-accent);
            z-index: -1;
            opacity: 0.6;
        }
        
        .hero-text {
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 2.5rem;
            color: var(--wood-text);
        }
        
        .btn-wood {
            background: var(--wood-gradient);
            color: white;
            font-weight: 600;
            padding: 0.9rem 2.2rem;
            border-radius: 10px;
            border: none;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 15px rgba(58, 90, 64, 0.3);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.9rem;
            position: relative;
            overflow: hidden;
        }
        
        .btn-wood:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.6s ease;
        }
        
        .btn-wood:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(58, 90, 64, 0.4);
        }
        
        .btn-wood:hover:before {
            left: 100%;
        }
        
        .btn-outline-wood {
            border: 2px solid var(--wood-primary);
            color: var(--wood-primary);
            font-weight: 600;
            padding: 0.8rem 2.2rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            background: transparent;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.9rem;
        }
        
        .btn-outline-wood:hover {
            background: var(--wood-primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(58, 90, 64, 0.2);
        }
        
        /* Efectos de partículas */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }
        
        .particle {
            position: absolute;
            background: rgba(163, 177, 138, 0.6);
            border-radius: 50%;
            animation: floatParticle linear infinite;
        }
        
        @keyframes floatParticle {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
            }
        }
        
        /* Footer Premium */
        .footer {
            background: var(--wood-gradient);
            color: white;
            padding: 5rem 0 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .footer:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 10px;
            background: linear-gradient(90deg, var(--wood-accent), rgba(255, 255, 255, 0.3), var(--wood-accent));
        }
        
        .footer-logo {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-family: 'Playfair Display', serif;
        }
        
        .footer-logo span {
            color: var(--wood-accent);
        }
        
        .footer p {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2rem;
        }
        
        .footer h5 {
            font-size: 1.3rem;
            margin-bottom: 1.8rem;
            position: relative;
            display: inline-block;
            font-family: 'Playfair Display', serif;
        }
        
        .footer h5:after {
            content: '';
            position: absolute;
            width: 60%;
            height: 2px;
            background: var(--wood-accent);
            bottom: -10px;
            left: 0;
            border-radius: 2px;
        }
        
        .footer ul {
            list-style: none;
            padding: 0;
        }
        
        .footer li {
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }
        
        .footer li:hover {
            transform: translateX(5px);
        }
        
        .footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            position: relative;
            padding-left: 0;
        }
        
        .footer a:before {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: var(--wood-accent);
            transition: all 0.3s ease;
        }
        
        .footer a:hover {
            color: white;
            padding-left: 10px;
        }
        
        .footer a:hover:before {
            width: 20px;
        }
        
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 1.5rem;
        }
        
        .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            font-size: 1.1rem;
            position: relative;
            overflow: hidden;
        }
        
        .social-icons a:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--wood-accent);
            transform: scale(0);
            transition: all 0.3s ease;
            border-radius: 50%;
            z-index: -1;
        }
        
        .social-icons a:hover {
            transform: translateY(-5px) scale(1.1);
            color: var(--wood-primary);
        }
        
        .social-icons a:hover:after {
            transform: scale(1);
        }
        
        .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            margin-top: 3rem;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
            text-align: center;
        }
        
        /* Animaciones */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        /* Efecto de aparición al hacer scroll */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Responsive */
        @media (max-width: 1199.98px) {
            .hero-title {
                font-size: 2.5rem;
            }
        }
        
        @media (max-width: 991.98px) {
            .hero-text-content {
                padding: 2.5rem;
            }
            
            .hero-title {
                font-size: 2.2rem;
            }
            
            .hero-text {
                font-size: 1.1rem;
            }
        }
        
        @media (max-width: 767.98px) {
            .hero-section {
                padding: 4rem 0;
            }
            
            .hero-text-content {
                padding: 2rem;
                text-align: center;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .btn-group {
                justify-content: center;
            }
            
            .footer {
                text-align: center;
            }
            
            .footer h5:after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .footer ul {
                margin-bottom: 2rem;
            }
            
            .footer li {
                justify-content: center;
            }
            
            .social-icons {
                justify-content: center;
            }
        }
        
        @media (max-width: 575.98px) {
            .hero-title {
                font-size: 1.8rem;
            }
            
            .btn-wood, .btn-outline-wood {
                padding: 0.8rem 1.5rem;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Video de fondo -->
    <div class="video-background">
        <video autoplay muted loop playsinline>
            <source src="{{ asset('videos/tree.mp4') }}" type="video/mp4">
            <!-- Fallback image -->
            <img src="{{ asset('img/forest-bg.jpg') }}" alt="Forest background">
        </video>
    </div>
    
    <!-- Efecto de partículas -->
    <div class="particles" id="particles-js"></div>
    
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
                            <i class="fas fa-home"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('acerca') }}" 
                           class="nav-link">
                            <i class="fas fa-info-circle"></i> Acerca
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contacto') }}" 
                           class="nav-link">
                            <i class="fas fa-envelope"></i> Contacto
                        </a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a href="{{ route('login') }}" 
                           class="nav-link btn-login">
                            <i class="fas fa-sign-in-alt"></i> Ingresar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="flex-grow-1">
        @section('content')
        <section class="hero-section">
            <div class="hero-overlay"></div>
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-10 fade-in">
                        <div class="hero-card">
                            <div class="row g-0">
                                <div class="col-md-6 hero-img">
                                    <img src="{{ asset('img/portada.jpg') }}" 
                                         class="img-fluid" 
                                         alt="Sistema WoodWise en acción"
                                         loading="lazy">
                                </div>
                                <div class="col-md-6 hero-text-content">
                                    <h1 class="hero-title">Bienvenido a <span>WoodWise</span></h1>
                                    <p class="hero-text">
                                        La solución tecnológica más avanzada para el cálculo preciso de volúmenes maderables. 
                                        Nuestra plataforma combina algoritmos inteligentes con datos satelitales para ofrecer 
                                        la gestión forestal más eficiente del mercado, garantizando precisión y sostenibilidad 
                                        en cada análisis.
                                    </p>
                                    <div class="d-flex flex-wrap gap-3 btn-group">
                                        <a href="{{ route('login') }}" class="btn btn-wood">
                                            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                                        </a>
                                        <a href="{{ route('register') }}" class="btn btn-outline-wood">
                                            <i class="fas fa-user-plus"></i> Registrarse
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
                <div class="col-lg-4 fade-in">
                    <h3 class="footer-logo">Wood<span>Wise</span></h3>
                    <p>Tecnología avanzada para la gestión forestal sostenible. Optimización de recursos con precisión científica.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.instagram.com/x_edsonj?igsh=Ynh0cXBsZXFpZDR6"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-4 fade-in" style="transition-delay: 0.1s;">
                    <h5>Enlaces</h5>
                    <ul>
                        <li><a href="{{ route('welcome') }}">Inicio</a></li>
                        <li><a href="{{ route('acerca') }}">Acerca de</a></li>
                        <li><a href="{{ route('contacto') }}">Contacto</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-4 fade-in" style="transition-delay: 0.2s;">
                    <h5>Contacto</h5>
                    <ul>
                        <li><i class="fas fa-map-marker-alt me-2"></i> Av. Forestal 123, Santiago</li>
                        <li><i class="fas fa-phone-alt me-2"></i> +56 9 1234 5678</li>
                        <li><i class="fas fa-envelope me-2"></i> contacto@woodwise.cl</li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-4 fade-in" style="transition-delay: 0.3s;">
                    <h5>Legal</h5>
                    <ul>
                        <li><a href="#">Términos y condiciones</a></li>
                        <li><a href="#">Política de privacidad</a></li>
                        <li><a href="#">Sustentabilidad</a></li>
                        <li><a href="#">Certificaciones</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright text-center fade-in" style="transition-delay: 0.4s;">
                <p class="mb-2">© 2025 WoodWise - Todos los derechos reservados</p>
                <small>Desarrollado con <i class="fas fa-heart text-danger"></i> por CDN</small>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
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
        
        // Animación de navbar al hacer scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Animación de aparición al hacer scroll
        const fadeElements = document.querySelectorAll('.fade-in');
        
        const appearOnScroll = new IntersectionObserver(function(entries, appearOnScroll) {
            entries.forEach(entry => {
                if (!entry.isIntersecting) {
                    return;
                } else {
                    entry.target.classList.add('visible');
                    appearOnScroll.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        });
        
        fadeElements.forEach(fadeElement => {
            appearOnScroll.observe(fadeElement);
        });
        
        // Efecto de partículas
        particlesJS('particles-js', {
            "particles": {
                "number": {
                    "value": 80,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#A3B18A"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 2,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": false
                },
                "move": {
                    "enable": true,
                    "speed": 1,
                    "direction": "top",
                    "random": true,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "repulse"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "repulse": {
                        "distance": 100,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    }
                }
            },
            "retina_detect": true
        });
        
        // Crear partículas manuales para el hero
        function createParticles() {
            const particlesContainer = document.querySelector('.particles');
            const particleCount = 30;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Tamaño aleatorio entre 2px y 6px
                const size = Math.random() * 4 + 2;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Posición aleatoria
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                
                // Duración de animación aleatoria
                const duration = Math.random() * 20 + 10;
                particle.style.animationDuration = `${duration}s`;
                
                // Retraso aleatorio
                particle.style.animationDelay = `${Math.random() * 5}s`;
                
                particlesContainer.appendChild(particle);
            }
        }
        
        // Llamar a la función cuando el DOM esté cargado
        document.addEventListener('DOMContentLoaded', createParticles);
    </script>
</body>
</html>