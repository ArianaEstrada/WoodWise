@extends('layouts.app')

@section('content')
<section class="contact-section py-6" style="background: linear-gradient(rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.95)), url('{{ asset('img/wood-contact-bg.jpg') }}')">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5 animate__animated animate__fadeIn">
                <h1 class="display-4 fw-bold mb-3" style="color: var(--wood-dark);">
                    <span class="text-gradient">Contáctanos</span>
                </h1>
                <div class="divider mx-auto"></div>
                <p class="lead mt-3" style="color: var(--wood-medium);">
                    Estamos aquí para responder tus preguntas y ayudarte con tus necesidades forestales
                </p>
            </div>
        </div>

        <div class="row g-5">
            <!-- Información de Contacto -->
            <div class="col-lg-5">
                <div class="contact-info-card p-5 rounded-4 shadow h-100" style="background-color: white;">
                    <h3 class="fw-bold mb-4" style="color: var(--wood-dark); border-bottom: 2px solid var(--wood-light); padding-bottom: 0.5rem;">
                        <i class="bi bi-info-circle-fill me-2" style="color: var(--wood-accent);"></i> Información
                    </h3>
                    
                    <div class="contact-item mb-4">
                        <div class="d-flex align-items-start">
                            <div class="contact-icon me-3" style="color: var(--wood-accent);">
                                <i class="bi bi-geo-alt-fill fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color: var(--wood-dark);">Ubicación</h5>
                                <p class="mb-0" style="color: var(--wood-medium);">
                                    Carretera Federal Valle de Bravo Km 30<br>
                                    Ejido San Antonio Laguna<br>
                                    51200 Valle de Bravo, Méx.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-item mb-4">
                        <div class="d-flex align-items-start">
                            <div class="contact-icon me-3" style="color: var(--wood-accent);">
                                <i class="bi bi-telephone-fill fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color: var(--wood-dark);">Teléfono</h5>
                                <p class="mb-0" style="color: var(--wood-medium);">
                                    +52 5511329075
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-item mb-4">
                        <div class="d-flex align-items-start">
                            <div class="contact-icon me-3" style="color: var(--wood-accent);">
                                <i class="bi bi-envelope-fill fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color: var(--wood-dark);">Email</h5>
                                <p class="mb-0" style="color: var(--wood-medium);">
                                    woodwise@gmail.com
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-item mb-4">
                        <div class="d-flex align-items-start">
                            <div class="contact-icon me-3" style="color: var(--wood-accent);">
                                <i class="bi bi-whatsapp fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color: var(--wood-dark);">WhatsApp</h5>
                                <p class="mb-0" style="color: var(--wood-medium);">
                                    +52 5511329075
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="social-links mt-5">
                        <h5 class="fw-bold mb-3" style="color: var(--wood-dark);">Síguenos</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="social-icon" style="background-color: #3b5998;">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://www.instagram.com/x_edsonj?igsh=Ynh0cXBsZXFpZDR6" class="social-icon" style="background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D);">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" class="social-icon" style="background-color: #25D366;">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <a href="#" class="social-icon" style="background-color: #0077B5;">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Formulario de Contacto -->
            <div class="col-lg-7">
                <div class="contact-form-card p-5 rounded-4 shadow" style="background-color: white;">
                    <h3 class="fw-bold mb-4" style="color: var(--wood-dark); border-bottom: 2px solid var(--wood-light); padding-bottom: 0.5rem;">
                        <i class="bi bi-send-fill me-2" style="color: var(--wood-accent);"></i> Escríbenos
                    </h3>
                    
                    <form action="#" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Nombre" required style="border-color: var(--wood-light);">
                                    <label for="name" style="color: var(--wood-medium);">Nombre completo</label>
                                    <div class="invalid-feedback">
                                        Por favor ingresa tu nombre
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Email" required style="border-color: var(--wood-light);">
                                    <label for="email" style="color: var(--wood-medium);">Correo electrónico</label>
                                    <div class="invalid-feedback">
                                        Por favor ingresa un email válido
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="Asunto" required style="border-color: var(--wood-light);">
                                    <label for="subject" style="color: var(--wood-medium);">Asunto</label>
                                    <div class="invalid-feedback">
                                        Por favor ingresa un asunto
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="message" placeholder="Mensaje" required style="border-color: var(--wood-light); height: 150px;"></textarea>
                                    <label for="message" style="color: var(--wood-medium);">Tu mensaje</label>
                                    <div class="invalid-feedback">
                                        Por favor escribe tu mensaje
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <button class="btn btn-wood px-4 py-3 w-100 fw-bold" type="submit">
                                    <i class="bi bi-send-fill me-2"></i> Enviar Mensaje
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Mapa -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="map-card p-4 rounded-4 shadow" style="background-color: white;">
                    <h3 class="fw-bold mb-4" style="color: var(--wood-dark); border-bottom: 2px solid var(--wood-light); padding-bottom: 0.5rem;">
                        <i class="bi bi-map-fill me-2" style="color: var(--wood-accent);"></i> Nuestra Ubicación
                    </h3>
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3766.123456789012!2d-100.12345678901234!3d19.123456789012345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDA3JzI0LjQiTiAxMDDCsDA3JzI0LjQiVw!5e0!3m2!1sen!2smx!4v1234567890123!5m2!1sen!2smx" 
                                style="border:0; border-radius: 8px;" allowfullscreen="" loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .contact-section {
        padding: 5rem 0;
        background-size: cover;
        background-position: center;
    }
    
    .contact-info-card, .contact-form-card, .map-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(184, 139, 74, 0.2);
    }
    
    .contact-info-card:hover, .contact-form-card:hover, .map-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
    }
    
    .contact-icon {
        width: 40px;
        height: 40px;
        background: rgba(107, 142, 35, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    
    .social-icon {
        width: 40px;
        height: 40px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s;
    }
    
    .social-icon:hover {
        transform: translateY(-3px) scale(1.1);
    }
    
    .btn-wood {
        background-color: var(--wood-accent);
        color: white;
        transition: all 0.3s;
    }
    
    .btn-wood:hover {
        background-color: var(--wood-dark);
        color: white;
        transform: translateY(-3px);
    }
    
    .form-control:focus {
        border-color: var(--wood-accent);
        box-shadow: 0 0 0 0.25rem rgba(107, 142, 35, 0.25);
    }
    
    .divider {
        height: 4px;
        width: 100px;
        background: var(--wood-accent);
        margin: 0 auto;
    }
</style>

<script>
    // Validación de formulario
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endsection