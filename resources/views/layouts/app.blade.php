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
<body>
    <!-- Encabezado -->
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3 fw-bold mb-0">WoodWise</h1>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a href="#" class="nav-link text-white">Inicio</a></li>
                    <li class="nav-item"><a href="{{ route('acerca') }}" class="nav-link text-white">Acerca de</a></li>
                    <li class="nav-item"><a href="{{ route('contacto') }}" class="nav-link text-white">Contacto</a></li>

                </ul>
            </nav>
        </div>
    </header>
    
    <!-- Contenido principal -->
    <main class="container mt-5 d-flex justify-content-center align-items-center" style="height: 80vh;">
        @yield('content')
    </main>

    <!-- Pie de página -->
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p class="mb-0">&copy; {{ date('Y') }} WoodWise - Todos los derechos reservados.</p>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
