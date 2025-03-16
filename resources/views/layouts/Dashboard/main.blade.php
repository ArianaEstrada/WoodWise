<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('Dashboard/css/styles.css') }}">
</head>
<body>
    <!-- Barra superior -->
    @include('components.top-bar')

    <!-- Barra lateral -->
    @include('components.sidebar')

    <!-- Contenido principal -->
    <div class="content" style="margin-left: 260px; padding: 20px;">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('components.footer')

    <!-- Scripts -->
    <script src="{{ asset('Dashboard/js/scripts.js') }}"></script>
</body>
</html>
