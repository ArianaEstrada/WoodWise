@extends('layouts.app')

@section('content')
<main class="container mt-5 d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="row w-75">
        <div class="col-md-6 d-flex flex-column justify-content-center text-center">
            <h1 class="fw-bold">Bienvenido a <span class="text-primary">WoodWise</span></h1>
            <p class="fs-5 text-muted">
                Optimiza y automatiza el cálculo de volúmenes maderables con precisión y eficiencia. 
                Nuestra plataforma está diseñada para facilitar la gestión y análisis de datos forestales, 
                asegurando resultados confiables en cada proceso.
            </p>
            <div class="mt-4">
                <a href="{{ route('login') }}" class="btn btn-lg btn-primary me-2">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="btn btn-lg btn-outline-secondary">Registrarse</a>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-center">
            <img src="{{ asset('assets/img/forest.jpg') }}" class="img-fluid rounded shadow" alt="Imagen de un bosque">
        </div>
    </div>
</main>
@endsection
