@extends('layouts.app')

@section('title', 'Iniciar Sesión - WoodWise')

@section('content')
<div class="container-fluid bg-light min-vh-100 d-flex align-items-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <!-- Encabezado con gradiente -->
                    <div class="card-header bg-gradient-primary py-4">
                        <div class="text-center">
                            <img src="{{ asset('img/woodwise.png') }}" alt="WoodWise Logo" height="60" class="mb-3">
                            <h2 class="text-white mb-0">Bienvenido a WoodWise</h2>
                            <p class="text-white-50 mb-0">Gestión Forestal Inteligente</p>
                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <!-- Mensajes de error -->
                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4 rounded-3" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <div>Credenciales incorrectas. Por favor intente nuevamente.</div>
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                            @csrf
                            
                            <!-- Campo de Email -->
                            <div class="mb-4">
                                <div class="form-floating">
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           placeholder="Correo electrónico"
                                           value="{{ old('email') }}" 
                                           required 
                                           autofocus>
                                    <label for="email">
                                        <i class="fas fa-envelope me-2 text-muted"></i>Correo electrónico
                                    </label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Campo de Contraseña -->
                            <div class="mb-4">
                                <div class="form-floating position-relative">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Contraseña"
                                           required>
                                    <label for="password">
                                        <i class="fas fa-lock me-2 text-muted"></i>Contraseña
                                    </label>
                                    <span class="position-absolute end-0 top-50 translate-middle-y me-3 toggle-password" 
                                          style="cursor: pointer;"
                                          onclick="togglePassword('password')">
                                        <i class="fas fa-eye text-primary"></i>
                                    </span>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Recordar y olvidó contraseña -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="remember" 
                                           id="remember">
                                    <label class="form-check-label text-muted" for="remember">
                                        <i class="fas fa-check-circle me-1"></i>Recordar sesión
                                    </label>
                                </div>
                                <a href="{{ route('password.request') }}" 
                                   class="text-decoration-none text-primary fw-bold">
                                    <i class="fas fa-key me-1"></i>¿Olvidó su contraseña?
                                </a>
                            </div>

                            <!-- Botón de Acceso -->
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill py-3 fw-bold">
                                    <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                                </button>
                            </div>

                            <!-- Registro -->
                            <div class="text-center mt-4">
                                <p class="text-muted">¿No tiene una cuenta? 
                                    <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">
                                        <i class="fas fa-user-plus me-1"></i>Regístrese aquí
                                    </a>
                                </p>
                            </div>

                            <!-- Separador -->
                            <div class="position-relative my-4">
                                <hr>
                                <div class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted">
                                    O continuar con
                                </div>
                            </div>

                            <!-- Redes Sociales -->
                            <div class="d-flex justify-content-center gap-3">
                                <a href="#" class="btn btn-outline-primary rounded-circle p-3 social-btn">
                                    <i class="fab fa-google"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary rounded-circle p-3 social-btn">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary rounded-circle p-3 social-btn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #3A5F0B, #6B8E23);
    }
    
    .card {
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .form-floating label {
        color: #6c757d;
    }
    
    .form-control:focus {
        border-color: #6B8E23;
        box-shadow: 0 0 0 0.25rem rgba(107, 142, 35, 0.25);
    }
    
    .btn-primary {
        background-color: #6B8E23;
        border-color: #6B8E23;
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        background-color: #5A7720;
        border-color: #5A7720;
        transform: translateY(-2px);
    }
    
    .toggle-password {
        color: #6B8E23;
        transition: all 0.3s;
    }
    
    .toggle-password:hover {
        color: #3A5F0B;
    }
    
    .social-btn {
        width: 50px;
        height: 50px;
        transition: all 0.3s;
    }
    
    .social-btn:hover {
        background-color: #6B8E23;
        color: white;
        transform: translateY(-3px);
    }
</style>

<script>
    // Función para mostrar/ocultar contraseña
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling.querySelector('i');
        
        if (field.type === "password") {
            field.type = "text";
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            field.type = "password";
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Validación del formulario
    (function() {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
@endsection