@extends('layouts.app')

@section('content')
<section class="about-section py-6" style="background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url('{{ asset('img/wood-texture-bg.jpg') }}')">
    <div class="container">
        <!-- Encabezado con efecto -->
        <div class="text-center mb-6 animate__animated animate__fadeInDown">
            <h2 class="display-4 fw-bold text-uppercase mb-3" style="color: var(--wood-dark); letter-spacing: 3px;">
                <span class="text-gradient">Nuestra Historia</span>
            </h2>
            <div class="divider mx-auto" style="height: 4px; width: 100px; background: var(--wood-accent);"></div>
            <p class="lead mt-3" style="color: var(--wood-medium); max-width: 700px; margin: 0 auto;">
                Innovación y sostenibilidad en la gestión forestal desde 2023
            </p>
        </div>

        <!-- Carrusel mejorado -->
        <div id="aboutCarousel" class="carousel slide carousel-dark" data-bs-ride="carousel" data-bs-interval="6000">
            <div class="carousel-inner rounded-4 shadow-lg overflow-hidden">
                <!-- Misión -->
                <div class="carousel-item active">
                    <div class="p-5 bg-white" style="min-height: 400px;">
                        <div class="row align-items-center h-100">
                            <div class="col-md-6">
                                <img src="{{ asset('img/woodwise.png') }}" class="img-fluid rounded-3 shadow" alt="Misión WoodWise" loading="lazy">
                            </div>
                            <div class="col-md-6">
                                <div class="icon-box mb-4">
                                    <i class="bi bi-bullseye" style="color: var(--wood-accent); font-size: 3rem;"></i>
                                </div>
                                <h3 class="fw-bold mb-3" style="color: var(--wood-dark); font-size: 1.8rem;">Nuestra Misión</h3>
                                <p class="fs-5" style="color: var(--wood-text); line-height: 1.7;">
                                    En <strong class="text-gradient">WoodWise</strong>, revolucionamos la gestión forestal mediante tecnología de punta que combina precisión científica con sostenibilidad ambiental. Nuestras soluciones digitales optimizan cada etapa del proceso maderable, desde la planificación hasta la cosecha.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quiénes Somos -->
                <div class="carousel-item">
                    <div class="p-5 bg-white" style="min-height: 400px;">
                        <div class="row align-items-center h-100">
                            <div class="col-md-6 order-md-2">
                                <img src="{{ asset('img/woodwise.png') }}" class="img-fluid rounded-3 shadow" alt="Equipo WoodWise" loading="lazy">
                            </div>
                            <div class="col-md-6 order-md-1">
                                <div class="icon-box mb-4">
                                    <i class="bi bi-people-fill" style="color: var(--wood-accent); font-size: 3rem;"></i>
                                </div>
                                <h3 class="fw-bold mb-3" style="color: var(--wood-dark); font-size: 1.8rem;">¿Quiénes Somos?</h3>
                                <p class="fs-5" style="color: var(--wood-text); line-height: 1.7;">
                                    Somos un equipo multidisciplinario de <strong>ingenieros forestales, desarrolladores de software y expertos en sostenibilidad</strong>, unidos por la pasión por la conservación de los bosques. Combinamos décadas de experiencia en el sector con lo último en tecnología geoespacial.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Qué Hacemos -->
                <div class="carousel-item">
                    <div class="p-5 bg-white" style="min-height: 400px;">
                        <div class="row align-items-center h-100">
                            <div class="col-md-6">
                                <img src="{{ asset('img/woodwise.png') }}" class="img-fluid rounded-3 shadow" alt="Tecnología WoodWise" loading="lazy">
                            </div>
                            <div class="col-md-6">
                                <div class="icon-box mb-4">
                                    <i class="bi bi-cpu-fill" style="color: var(--wood-accent); font-size: 3rem;"></i>
                                </div>
                                <h3 class="fw-bold mb-3" style="color: var(--wood-dark); font-size: 1.8rem;">Nuestra Tecnología</h3>
                                <p class="fs-5" style="color: var(--wood-text); line-height: 1.7;">
                                    Desarrollamos <strong>herramientas inteligentes</strong> que integran:
                                </p>
                                <ul class="fs-5" style="color: var(--wood-text); line-height: 1.7;">
                                    <li>Análisis satelital de precisión</li>
                                    <li>Algoritmos de cálculo volumétrico</li>
                                    <li>Modelos predictivos de crecimiento</li>
                                    <li>Dashboards interactivos</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Valores -->
                <div class="carousel-item">
                    <div class="p-5 bg-white" style="min-height: 400px;">
                        <div class="row align-items-center h-100">
                            <div class="col-md-6 order-md-2">
                                <img src="{{ asset('img/woodwise.png') }}" class="img-fluid rounded-3 shadow" alt="Valores WoodWise" loading="lazy">
                            </div>
                            <div class="col-md-6 order-md-1">
                                <div class="icon-box mb-4">
                                    <i class="bi bi-stars" style="color: var(--wood-accent); font-size: 3rem;"></i>
                                </div>
                                <h3 class="fw-bold mb-3" style="color: var(--wood-dark); font-size: 1.8rem;">Nuestros Valores</h3>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <div class="value-card p-3 rounded-3 h-100" style="background-color: rgba(107, 142, 35, 0.1);">
                                            <i class="bi bi-tree-fill d-block mb-2" style="color: var(--wood-accent); font-size: 1.5rem;"></i>
                                            <h6 class="fw-bold" style="color: var(--wood-dark);">Sostenibilidad</h6>
                                            <small style="color: var(--wood-medium);">Gestión responsable de bosques</small>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="value-card p-3 rounded-3 h-100" style="background-color: rgba(94, 48, 35, 0.1);">
                                            <i class="bi bi-pin-map-fill d-block mb-2" style="color: var(--wood-dark); font-size: 1.5rem;"></i>
                                            <h6 class="fw-bold" style="color: var(--wood-dark);">Precisión</h6>
                                            <small style="color: var(--wood-medium);">Datos exactos en cada cálculo</small>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="value-card p-3 rounded-3 h-100" style="background-color: rgba(184, 139, 74, 0.1);">
                                            <i class="bi bi-lightbulb-fill d-block mb-2" style="color: var(--wood-light); font-size: 1.5rem;"></i>
                                            <h6 class="fw-bold" style="color: var(--wood-dark);">Innovación</h6>
                                            <small style="color: var(--wood-medium);">Soluciones tecnológicas avanzadas</small>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="value-card p-3 rounded-3 h-100" style="background-color: rgba(234, 226, 183, 0.3);">
                                            <i class="bi bi-hand-thumbs-up-fill d-block mb-2" style="color: var(--wood-medium); font-size: 1.5rem;"></i>
                                            <h6 class="fw-bold" style="color: var(--wood-dark);">Compromiso</h6>
                                            <small style="color: var(--wood-medium);">Apoyo continuo a nuestros clientes</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controles mejorados -->
            <button class="carousel-control-prev" type="button" data-bs-target="#aboutCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark bg-opacity-75 rounded-circle p-3" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#aboutCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark bg-opacity-75 rounded-circle p-3" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>

        <!-- Sección adicional de impacto -->
        <div class="row mt-6 g-4">
            <div class="col-md-4">
                <div class="impact-card p-4 rounded-4 text-center h-100 shadow-sm">
                    <i class="bi bi-tree fs-1 mb-3" style="color: var(--wood-accent);"></i>
                    <h3 class="h4 fw-bold mb-3" style="color: var(--wood-dark);">+5,000 Hectáreas</h3>
                    <p style="color: var(--wood-medium);">Gestionadas con nuestra tecnología</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="impact-card p-4 rounded-4 text-center h-100 shadow-sm">
                    <i class="bi bi-people fs-1 mb-3" style="color: var(--wood-accent);"></i>
                    <h3 class="h4 fw-bold mb-3" style="color: var(--wood-dark);">+120 Clientes</h3>
                    <p style="color: var(--wood-medium);">Confían en nuestras soluciones</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="impact-card p-4 rounded-4 text-center h-100 shadow-sm">
                    <i class="bi bi-graph-up-arrow fs-1 mb-3" style="color: var(--wood-accent);"></i>
                    <h3 class="h4 fw-bold mb-3" style="color: var(--wood-dark);">30% Más Eficiente</h3>
                    <p style="color: var(--wood-medium);">Que los métodos tradicionales</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .about-section {
        padding: 5rem 0;
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
    }
    
    .icon-box {
        width: 80px;
        height: 80px;
        background: rgba(107, 142, 35, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-bottom: 1.5rem;
    }
    
    .impact-card {
        background: white;
        transition: all 0.3s ease;
        border-bottom: 4px solid transparent;
    }
    
    .impact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        border-bottom-color: var(--wood-accent);
    }
    
    .divider {
        height: 4px;
        width: 100px;
        background: var(--wood-accent);
        margin: 0 auto;
    }
    
    .carousel-control-prev, .carousel-control-next {
        width: auto;
    }
    
    .carousel-control-prev {
        left: -50px;
    }
    
    .carousel-control-next {
        right: -50px;
    }
    
    @media (max-width: 768px) {
        .carousel-control-prev {
            left: -20px;
        }
        
        .carousel-control-next {
            right: -20px;
        }
    }
</style>
@endsection