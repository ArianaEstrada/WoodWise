@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-center bg-light">
    <div class="container py-5">
        <h2 class="text-center fw-bold mb-5" style="color: #2c3e50; font-size: 3rem; letter-spacing: 2px;">
            Acerca de <span class="text-primary">WoodWise</span>
        </h2>

        <div id="infoCarousel" class="carousel slide position-relative" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner shadow-lg rounded-4 overflow-hidden">

                <!-- Misión -->
                <div class="carousel-item active">
                    <div class="text-center p-5 bg-white rounded-4">
                        <i class="bi bi-rocket-takeoff-fill text-primary d-block mb-3" style="font-size: 5rem;"></i>
                        <h3 class="fw-bold text-dark fs-2">Nuestra Misión</h3>
                        <p class="fs-5 text-muted">
                            En <span class="fw-bold text-primary">WoodWise</span>, optimizamos la gestión de recursos forestales con tecnología avanzada para promover la sostenibilidad y eficiencia.
                        </p>
                    </div>
                </div>

                <!-- Quiénes Somos -->
                <div class="carousel-item">
                    <div class="text-center p-5 bg-white rounded-4">
                        <i class="bi bi-people-fill text-success d-block mb-3" style="font-size: 5rem;"></i>
                        <h3 class="fw-bold text-dark fs-2">¿Quiénes Somos?</h3>
                        <p class="fs-5 text-muted">
                            Somos una plataforma innovadora que asiste a profesionales del sector forestal en la gestión eficiente de sus recursos con tecnología avanzada.
                        </p>
                    </div>
                </div>

                <!-- Qué Hacemos -->
                <div class="carousel-item">
                    <div class="text-center p-5 bg-white rounded-4">
                        <i class="bi bi-laptop text-info d-block mb-3" style="font-size: 5rem;"></i>
                        <h3 class="fw-bold text-dark fs-2">¿Qué Hacemos?</h3>
                        <p class="fs-5 text-muted">
                            Desarrollamos herramientas especializadas para optimizar la planificación y el aprovechamiento de la madera con datos precisos.
                        </p>
                    </div>
                </div>

                <!-- Visión -->
                <div class="carousel-item">
                    <div class="text-center p-5 bg-white rounded-4">
                        <i class="bi bi-eye-fill text-warning d-block mb-3" style="font-size: 5rem;"></i>
                        <h3 class="fw-bold text-dark fs-2">Nuestra Visión</h3>
                        <p class="fs-5 text-muted">
                            Ser líderes en la digitalización del sector forestal, ofreciendo soluciones innovadoras que transformen la industria.
                        </p>
                    </div>
                </div>

                <!-- Valores -->
                <div class="carousel-item">
                    <div class="text-center p-5 bg-white rounded-4">
                        <i class="bi bi-award-fill text-danger d-block mb-3" style="font-size: 5rem;"></i>
                        <h3 class="fw-bold text-dark fs-2">Nuestros Valores</h3>
                        <ul class="list-unstyled fs-5 text-muted">
                            <li><strong class="text-dark">🌱 Sostenibilidad:</strong> Uso responsable de los recursos.</li>
                            <li><strong class="text-dark">📏 Precisión:</strong> Exactitud en cada cálculo.</li>
                            <li><strong class="text-dark">💡 Innovación:</strong> Desarrollo tecnológico avanzado.</li>
                            <li><strong class="text-dark">🤝 Compromiso:</strong> Apoyo constante a nuestros usuarios.</li>
                        </ul>
                    </div>
                </div>

            </div>

            <!-- Controles del Carrusel (posicionados afuera) -->
            <button class="carousel-control-prev position-absolute top-50 start-0 translate-middle-y" type="button" data-bs-target="#infoCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3 shadow" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next position-absolute top-50 end-0 translate-middle-y" type="button" data-bs-target="#infoCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-3 shadow" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>

        </div>
    </div>
</div>
@endsection
