@extends('layouts.app')

@section('content')

<div class="container py-5 min-vh-100 d-flex flex-column align-items-center justify-content-center">
    <h1 class="text-center fw-bold text-primary mb-4">Contáctanos</h1>

    <!-- Información de contacto -->
    <div class="contact-info p-4 bg-white shadow rounded-4 text-center mb-4">
        <h2 class="fw-bold text-dark mb-3">Información de Contacto</h2>
        
        <p><i class="bi bi-geo-alt-fill text-danger me-2"></i><strong>Dirección:</strong> Carretera Federal Valle de Bravo Km 30, Ejido San Antonio Laguna, 51200 Valle de Bravo, Méx.</p>
        <p><i class="bi bi-telephone-fill text-success me-2"></i><strong>Teléfono:</strong> +52 5511329075</p>
        <p><i class="bi bi-envelope-at-fill text-warning me-2"></i><strong>Email:</strong> woodwise@gmail.com</p>
        <p><i class="bi bi-whatsapp text-success me-2"></i><strong>WhatsApp:</strong> +52 5511329075</p>
        <p><i class="bi bi-facebook text-primary me-2"></i><strong>Facebook:</strong> WoodWise</p>
    </div>

    <!-- Formulario de Contacto -->
    <div class="contact-form p-4 bg-white shadow rounded-4 w-100" style="max-width: 600px;">
        <h2 class="fw-bold text-dark mb-3 text-center">Envíanos un mensaje</h2>
        <form action="" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Tu nombre" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" placeholder="Tu correo" required>
            </div>
            <div class="mb-3">
                <textarea class="form-control" rows="4" placeholder="Tu mensaje" required></textarea>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg shadow-sm">Enviar mensaje <i class="bi bi-send-fill ms-2"></i></button>
            </div>
        </form>
    </div>

    <!-- Botón de Regresar -->
    <button class="back-button btn btn-outline-primary mt-4 px-4 py-2" onclick="window.history.back()">
        <i class="bi bi-arrow-left-circle me-2"></i> Regresar
    </button>
</div>

@endsection
