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
    
    <!-- Encabezado -->
    <header class="bg-dark text-white py-3 shadow-sm">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <!-- Logo/Título alineado a la izquierda -->
                <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">
                    <i class="bi bi-tree-fill"></i> WoodWise
                </a>

                <!-- Botón de menú en dispositivos pequeños -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menú de navegación -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('welcome') }}" class="nav-link">
                                <i class="bi bi-house-door-fill"></i> Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('acerca') }}" class="nav-link">
                                <i class="bi bi-info-circle-fill"></i> Acerca de
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contacto') }}" class="nav-link">
                                <i class="bi bi-envelope-fill"></i> Contacto
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    
    <!-- Contenido Principal -->
    <main class="container py-5 flex-grow-1">
        @yield('content')
    </main>
    
    <!-- Pie de página -->
    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <p class="mb-0">&copy; {{ date('Y') }} <strong>WoodWise</strong> - Todos los derechos reservados.</p>
    </footer>
    
    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
