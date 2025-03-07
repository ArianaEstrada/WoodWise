@extends('layouts.app')

@section('content')
<main class="container-fluid d-flex justify-content-center align-items-center min-vh-100 bg-white">
    <div class="row w-75 rounded border p-5 d-flex align-items-center">
        
        <!-- Sección de imagen -->
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <img src="{{ asset('img/portada.jpg') }}" class="img-fluid rounded" alt="Imagen de un bosque" style="max-width: 100%; height: auto;">
        </div>

        <!-- Sección de bienvenida -->
        <div class="col-md-6 text-center text-md-start">
            <h1 class="fw-bold text-dark mb-3">Bienvenido a <span class="text-primary">WoodWise</span></h1>
            <p class="fs-5 text-muted mb-4">
                Optimiza y automatiza el cálculo de volúmenes maderables con precisión y eficiencia. 
                Nuestra plataforma está diseñada para facilitar la gestión y análisis de datos forestales, 
                asegurando resultados confiables en cada proceso.
            </p>
            <div class="d-flex justify-content-center justify-content-md-start gap-3">
                <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary px-4 py-2">Registrarse</a>
            </div>
        </div>

    </div>
</main>
@endsection
