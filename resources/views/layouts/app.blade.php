<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoodWise - Gestión Forestal</title>

    <!-- Estilos -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    
    <!-- Encabezado mejorado -->
    <header class="bg-dark text-white py-4 shadow-lg">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <!-- Logo animado -->
                <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('welcome') }}">
                    <img src="{{ asset('img/woodwise.png') }}" 
                         alt="WoodWise Logo" 
                         width="60" 
                         height="60" 
                         class="me-2 rounded-circle border border-2 border-light">
                    <span class="text-gradient">WoodWise</span>
                </a>

                <!-- Botón de menú con animación -->
                <button class="navbar-toggler" type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#navbarNav"
                        aria-controls="navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menú con separación mejorada -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav gap-3">
                        <li class="nav-item">
                            <a href="{{ route('welcome') }}" 
                               class="nav-link active px-3 py-2 rounded-3">
                                <i class="bi bi-house-door-fill"></i> Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('acerca') }}" 
                               class="nav-link px-3 py-2 rounded-3">
                                <i class="bi bi-info-circle-fill"></i> Acerca de
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contacto') }}" 
                               class="nav-link px-3 py-2 rounded-3">
                                <i class="bi bi-envelope-fill"></i> Contacto
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- Contenido Principal con espaciado mejorado -->
    <!-- Modificar el main para compensar el espacio de la barra -->
<main class="container py-6 flex-grow-1 mt-5"> <!-- Añadir mt-5 -->
    @yield('content')
</main>


    <!-- Pie de página con efecto hover -->
    <footer class="bg-dark text-white text-center py-5 mt-auto">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5 class="text-uppercase mb-4">Información</h5>
                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="col-md-4">
                    <h5 class="text-uppercase mb-4">Contacto</h5>
                    <p class="mb-0">Teléfono: +56 9 1234 5678</p>
                    <p class="mb-0">Email: contacto@woodwise.cl</p>
                </div>
                <div class="col-md-4">
                    <h5 class="text-uppercase mb-4">Redes Sociales</h5>
                    <div class="d-flex gap-3">
                       
                        <a href="https://www.instagram.com/x_edsonj?igsh=Ynh0cXBsZXFpZDR6" class="text-decoration-none text-light">
                            <i class="bi bi-instagram fs-4"></i>
                            <h8>    x_edsonj</h8>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
