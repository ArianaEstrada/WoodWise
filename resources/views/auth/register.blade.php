@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <!-- Encabezado con gradiente -->
                <div class="card-header bg-gradient-primary py-4">
                    <div class="text-center">
                        <img src="{{ asset('img/woodwise.png') }}" alt="Logo" height="50" class="mb-3">
                        <h2 class="text-white mb-0">{{ __('Crear nueva cuenta') }}</h2>
                        <p class="text-white-50 mb-0">Únete a nuestra plataforma</p>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <!-- Mensajes Emergentes -->
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4 rounded-3" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <div>{{ session('error') }}</div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4 rounded-3" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-2"></i>
                            <div>{{ session('success') }}</div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    <form id="register-form" method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                        @csrf

                        <!-- Sección de información personal -->
                        <div class="mb-4">
                            <h5 class="text-primary mb-3"><i class="fas fa-user-circle me-2"></i> Información Personal</h5>
                            <div class="row g-3">
                                <!-- Nombre -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" 
                                               class="form-control @error('nom') is-invalid @enderror" 
                                               id="nom" 
                                               name="nom" 
                                               placeholder="Nombre"
                                               value="{{ old('nom') }}" 
                                               required 
                                               autofocus>
                                        <label for="nom">{{ __('Nombre') }}</label>
                                        @error('nom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Apellido Paterno -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" 
                                               class="form-control @error('ap') is-invalid @enderror" 
                                               id="ap" 
                                               name="ap" 
                                               placeholder="Apellido Paterno"
                                               value="{{ old('ap') }}" 
                                               required>
                                        <label for="ap">{{ __('Apellido Paterno') }}</label>
                                        @error('ap')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Apellido Materno -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" 
                                               class="form-control @error('am') is-invalid @enderror" 
                                               id="am" 
                                               name="am" 
                                               placeholder="Apellido Materno"
                                               value="{{ old('am') }}" 
                                               required>
                                        <label for="am">{{ __('Apellido Materno') }}</label>
                                        @error('am')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Teléfono -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" 
                                               class="form-control @error('telefono') is-invalid @enderror" 
                                               id="telefono" 
                                               name="telefono" 
                                               placeholder="Teléfono"
                                               value="{{ old('telefono') }}" 
                                               required>
                                        <label for="telefono">{{ __('Teléfono') }}</label>
                                        @error('telefono')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección de credenciales -->
                        <div class="mb-4">
                            <h5 class="text-primary mb-3"><i class="fas fa-key me-2"></i> Credenciales de Acceso</h5>
                            <div class="row g-3">
                                <!-- Correo Electrónico -->
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               placeholder="Correo Electrónico"
                                               value="{{ old('email') }}" 
                                               required>
                                        <label for="email">{{ __('Correo Electrónico') }}</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Contraseña -->
                                <div class="col-md-6">
                                    <div class="form-floating position-relative">
                                        <input type="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               id="password" 
                                               name="password" 
                                               placeholder="Contraseña"
                                               required>
                                        <label for="password">{{ __('Contraseña') }}</label>
                                        <span class="position-absolute end-0 top-50 translate-middle-y me-3 toggle-password" 
                                              style="cursor: pointer;"
                                              onclick="togglePassword('password')">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted">Mínimo 8 caracteres</small>
                                </div>

                                <!-- Confirmar Contraseña -->
                                <div class="col-md-6">
                                    <div class="form-floating position-relative">
                                        <input type="password" 
                                               class="form-control" 
                                               id="password-confirm" 
                                               name="password_confirmation" 
                                               placeholder="Confirmar Contraseña"
                                               required>
                                        <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                                        <span class="position-absolute end-0 top-50 translate-middle-y me-3 toggle-password" 
                                              style="cursor: pointer;"
                                              onclick="togglePassword('password-confirm')">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                                            <!-- Sección de Rol Mejorada -->
                        <div class="mb-4">
                            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0 text-primary">
                                        <i class="fas fa-user-tag me-2"></i> Tipo de Usuario
                                    </h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-muted mb-3">Selecciona tu tipo de usuario</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white">
                                                <i class="fas fa-user-shield text-primary"></i>
                                            </span>
                                            <select class="form-select form-select-lg @error('id_rol') is-invalid @enderror" 
                                                    name="id_rol" 
                                                    id="id_rol" 
                                                    required
                                                    style="cursor: pointer;">
                                                <option value="" disabled selected>-- Selecciona un rol --</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id_rol }}" 
                                                            {{ old('id_rol') == $role->id_rol ? 'selected' : '' }}
                                                            class="py-2">
                                                        {{ ucfirst($role->nom_rol) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('id_rol')
                                            <div class="invalid-feedback d-block mt-2">
                                                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                            </div>
                                        @enderror
                                        <small class="text-muted mt-2 d-block">
                                            <i class="fas fa-info-circle me-2"></i>Este campo determina los permisos que tendrás en el sistema
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

<!-- Cédula (condicional) -->
<div id="cedula-container" class="mb-4" style="display: none;">
    <div class="form-floating">
        <input type="text" 
            class="form-control @error('cedula') is-invalid @enderror" 
            id="cedula" 
            name="cedula" 
            placeholder="Cédula"
            value="{{ old('cedula') ?? '' }}">
        <label for="cedula">{{ __('Cédula Profesional') }}</label>
        @error('cedula')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

                        <!-- Botón de Registro -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill py-3 fw-bold">
                                <i class="fas fa-user-plus me-2"></i> {{ __('Crear cuenta') }}
                            </button>
                        </div>

                        <!-- Enlace para iniciar sesión -->
                        <div class="text-center mt-4">
                            <p class="text-muted">¿Ya tienes una cuenta? 
                                <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">
                                    {{ __('Inicia sesión aquí') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
     // Mejorar la interacción del select
     document.getElementById('id_rol').addEventListener('focus', function() {
        this.style.borderColor = '#6B8E23';
        this.parentElement.querySelector('.input-group-text').style.borderColor = '#6B8E23';
    });
    
    document.getElementById('id_rol').addEventListener('blur', function() {
        this.style.borderColor = '#e9ecef';
        this.parentElement.querySelector('.input-group-text').style.borderColor = '#e9ecef';
    });
    // Mostrar/ocultar campo de cédula según rol seleccionado
document.getElementById('id_rol').addEventListener('change', function() {
    const cedulaContainer = document.getElementById('cedula-container');
    const selectedRole = this.options[this.selectedIndex].text;
    
    cedulaContainer.style.display = selectedRole === "Tecnico" ? 'block' : 'none';
    // Eliminamos las líneas que establecen el atributo required
});

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

<style>
     .form-select-lg {
        padding: 0.8rem 1rem;
        font-size: 1rem;
        border-left: 0;
        border-color: #e9ecef;
        transition: all 0.3s ease;
    }
    
    .form-select-lg:focus {
        border-color: #6B8E23;
        box-shadow: 0 0 0 0.25rem rgba(107, 142, 35, 0.25);
    }
    
    .input-group-text {
        border-right: none;
        background-color: #f8f9fa !important;
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    option {
        padding: 12px;
        transition: background-color 0.2s;
    }
    
    option:hover {
        background-color: #f8f9fa !important;
    }
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
    
    .form-control:focus, .form-select:focus {
        border-color: #6B8E23;
        box-shadow: 0 0 0 0.25rem rgba(107, 142, 35, 0.25);
    }
    
    .btn-primary {
        background-color: #6B8E23;
        border-color: #6B8E23;
    }
    
    .btn-primary:hover {
        background-color: #5A7720;
        border-color: #5A7720;
    }
    
    .toggle-password {
        color: #6B8E23;
        transition: all 0.3s;
    }
    
    .toggle-password:hover {
        color: #3A5F0B;
    }
</style>
@endsection