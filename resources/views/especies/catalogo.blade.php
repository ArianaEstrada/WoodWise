@extends('dashboard')

@section('template_title', 'Catálogo de Especies')

@section('crud_content')
<div class="catalog-container">
    <!-- Hero Section -->
    <div class="hero-section text-center py-5 mb-5">
        <div class="container">
            <h1 class="display-4 fw-bold text-gradient">
                <i class="fas fa-leaf me-2"></i>Explora Nuestro <span class="text-primary">Catálogo</span>
            </h1>
            <p class="lead text-muted">Descubre la diversidad de especies en nuestra colección</p>
            
            <!-- Search Bar -->
            <div class="col-lg-6 mx-auto">
                <div class="search-bar input-group mb-5 shadow-lg rounded-pill">
                    <input type="text" id="searchInput" class="form-control rounded-pill border-0" placeholder="Buscar especies...">
                    <button class="btn btn-primary rounded-pill px-4" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Interactive Filter -->
    <div class="container mb-5">
        <div class="filter-tags text-center">
            <button class="btn btn-sm btn-outline-primary rounded-pill mx-1 mb-2 filter-btn active" data-filter="all">Todas</button>
            <button class="btn btn-sm btn-outline-success rounded-pill mx-1 mb-2 filter-btn" data-filter="flora">Flora</button>
            <button class="btn btn-sm btn-outline-info rounded-pill mx-1 mb-2 filter-btn" data-filter="fauna">Fauna</button>
            <button class="btn btn-sm btn-outline-warning rounded-pill mx-1 mb-2 filter-btn" data-filter="endemicas">Endémicas</button>
        </div>
    </div>

    <!-- Species Grid -->
    <div class="container">
        <div class="row" id="speciesGrid">
            @foreach($especies as $especie)
            <div class="col-lg-4 col-md-6 mb-4 species-card" data-category="flora">
                <div class="card species-card-inner h-100 shadow-lg">
                    <div class="card-img-container">
                        <img src="{{ asset('storage/' . $especie->imagen) }}" class="card-img-top" alt="{{ $especie->nom_comun }}">
                        <div class="img-overlay"></div>
                        <div class="quick-view" data-bs-toggle="modal" data-bs-target="#speciesModal{{ $especie->id }}">
                            <i class="fas fa-eye"></i> Vista Rápida
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">{{ $especie->nom_comun }}</h3>
                        <p class="card-subtitle text-muted mb-3">
                            <em>{{ $especie->nom_cientifico }}</em>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-secondary toggle-details">
                                    Más detalles <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                            <small class="text-success">
                                <i class="fas fa-map-marker-alt"></i> Región Norte
                            </small>
                        </div>
                    </div>
                    <!-- Hidden Details -->
                    <div class="card-details p-4" style="display: none;">
                        <h5>Características:</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.</p>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <p><strong>Hábitat:</strong> Bosques</p>
                                <p><strong>Altura:</strong> 2-5m</p>
                            </div>
                            <div class="col-6">
                                <p><strong>Temporada:</strong> Primavera</p>
                                <p><strong>Conservación:</strong> Estable</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="speciesModal{{ $especie->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $especie->nom_comun }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ asset('storage/' . $especie->imagen) }}" class="img-fluid rounded" alt="{{ $especie->nom_comun }}">
                                </div>
                                <div class="col-md-6">
                                    <h3><em>{{ $especie->nom_cientifico }}</em></h3>
                                    <p class="text-muted">Familia: Rosaceae</p>
                                    <hr>
                                    <h5>Descripción</h5>
                                    <p>Descripción detallada de la especie con información relevante sobre sus características principales.</p>
                                    <div class="characteristics mt-4">
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-circle bg-primary me-3">
                                                        <i class="fas fa-ruler-combined text-white"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted">Altura</small>
                                                        <h6 class="mb-0">2-5 metros</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-circle bg-success me-3">
                                                        <i class="fas fa-leaf text-white"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted">Follaje</small>
                                                        <h6 class="mb-0">Perenne</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-circle bg-info me-3">
                                                        <i class="fas fa-sun text-white"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted">Luz Solar</small>
                                                        <h6 class="mb-0">Pleno sol</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-circle bg-warning me-3">
                                                        <i class="fas fa-tint text-white"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted">Riego</small>
                                                        <h6 class="mb-0">Moderado</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-bookmark me-2"></i>Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Newsletter -->
    <div class="newsletter-section py-5 bg-light mt-5">
        <div class="container text-center">
            <h3 class="mb-4">¿Quieres recibir actualizaciones de nuevas especies?</h3>
            <p class="text-muted mb-4">Suscríbete a nuestro boletín informativo</p>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group mb-3 shadow-sm">
                        <input type="email" class="form-control rounded-start" placeholder="Tu correo electrónico">
                        <button class="btn btn-primary rounded-end" type="button">Suscribirse</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    :root {
        --primary-color: #2c786c;
        --secondary-color: #004445;
        --accent-color: #f8b400;
        --light-color: #faf5e4;
    }
    
    .hero-section {
        background: linear-gradient(135deg, var(--light-color) 0%, #ffffff 100%);
        border-radius: 0 0 20px 20px;
    }
    
    .text-gradient {
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }
    
    .search-bar {
        transition: all 0.3s ease;
    }
    
    .search-bar:focus-within {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .species-card-inner {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        background: white;
    }
    
    .species-card-inner:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
    }
    
    .card-img-container {
        position: relative;
        overflow: hidden;
        height: 250px;
    }
    
    .card-img-top {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .species-card-inner:hover .card-img-top {
        transform: scale(1.1);
    }
    
    .img-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.5) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .species-card-inner:hover .img-overlay {
        opacity: 1;
    }
    
    .quick-view {
        position: absolute;
        bottom: -50px;
        left: 0;
        width: 100%;
        text-align: center;
        color: white;
        background: rgba(0,0,0,0.7);
        padding: 10px;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .species-card-inner:hover .quick-view {
        bottom: 0;
    }
    
    .toggle-details {
        transition: all 0.3s ease;
    }
    
    .toggle-details.collapsed i {
        transform: rotate(0deg);
    }
    
    .toggle-details i {
        transition: transform 0.3s ease;
    }
    
    .card-details {
        background: var(--light-color);
    }
    
    .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .newsletter-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
    }
    
    .newsletter-section h3, 
    .newsletter-section p {
        color: white !important;
    }
    
    .newsletter-section .form-control {
        border: none;
        height: 50px;
    }
    
    .newsletter-section .btn {
        height: 50px;
        padding: 0 25px;
    }
    
    .filter-tags .active {
        background: var(--primary-color);
        color: white !important;
    }
</style>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Sistema de gestión de modales optimizado para Catálogo de Especies
document.addEventListener('DOMContentLoaded', function() {
    // 1. Singleton para gestión centralizada de modales
    const ModalManager = {
        currentModal: null,
        backdrop: null,
        
        // Inicializar todos los modales
        initModals: function() {
            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(trigger => {
                trigger.addEventListener('click', (e) => this.handleModalTrigger(e));
            });
            
            // Configurar eventos de cierre
            document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(btn => {
                btn.addEventListener('click', () => this.closeCurrentModal());
            });
            
            // Cerrar con ESC
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.currentModal) {
                    this.closeCurrentModal();
                }
            });
        },
        
        // Manejar clic en trigger de modal
        handleModalTrigger: function(e) {
            e.preventDefault();
            const modalId = e.currentTarget.getAttribute('data-bs-target');
            const modalElement = document.querySelector(modalId);
            
            if (!modalElement) return;
            
            // Cerrar modal actual si existe
            if (this.currentModal) {
                this.closeCurrentModal();
            }
            
            // Crear nueva instancia
            this.currentModal = new bootstrap.Modal(modalElement, {
                backdrop: 'static',
                keyboard: false
            });
            
            // Configurar eventos para este modal
            modalElement.addEventListener('hidden.bs.modal', () => {
                this.cleanupModal(modalElement);
            });
            
            // Mostrar el modal
            this.currentModal.show();
            
            // Cargar contenido dinámico si es necesario
            this.loadDynamicContent(modalElement);
        },
        
        // Cerrar modal actual
        closeCurrentModal: function() {
            if (this.currentModal) {
                this.currentModal.hide();
            }
        },
        
        // Limpieza después de cerrar
        cleanupModal: function(modalElement) {
            // Limpiar el backdrop
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());
            
            // Restaurar el body
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
            
            // Resetear el modal
            modalElement.style.display = 'none';
            modalElement.removeAttribute('aria-modal');
            modalElement.removeAttribute('role');
            modalElement.setAttribute('aria-hidden', 'true');
            
            this.currentModal = null;
        },
        
        // Cargar contenido dinámico para el modal
        loadDynamicContent: function(modalElement) {
            const lazyLoadElements = modalElement.querySelectorAll('[data-lazy-load]');
            
            lazyLoadElements.forEach(element => {
                const src = element.getAttribute('data-src');
                if (src && !element.getAttribute('data-loaded')) {
                    if (element.tagName === 'IMG') {
                        element.src = src;
                    } else {
                        fetch(src)
                            .then(response => response.text())
                            .then(html => {
                                element.innerHTML = html;
                            });
                    }
                    element.setAttribute('data-loaded', 'true');
                }
            });
        }
    };
    
    // Inicializar el gestor de modales
    ModalManager.initModals();
    
    // 2. Función para eliminar especie con confirmación mejorada
    window.confirmSpeciesDelete = function(url, especieName) {
        Swal.fire({
            title: 'Confirmar eliminación',
            html: `<div class="text-center">
                     <i class="fas fa-exclamation-triangle text-danger mb-3" style="font-size: 3rem;"></i>
                     <p>¿Estás seguro de eliminar la especie <strong>${especieName}</strong>?</p>
                     <p class="text-muted small">Esta acción no se puede deshacer</p>
                   </div>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash-alt me-2"></i>Eliminar',
            cancelButtonText: '<i class="fas fa-times me-2"></i>Cancelar',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            },
            customClass: {
                popup: 'rounded-3',
                confirmButton: 'btn btn-danger px-4 py-2 rounded-pill',
                cancelButton: 'btn btn-secondary px-4 py-2 rounded-pill ms-2'
            },
            buttonsStyling: false,
            backdrop: `
                rgba(0,0,0,0.7)
                url("/images/pattern.png")
                center left
                no-repeat
            `
        }).then((result) => {
            if (result.isConfirmed) {
                // Mostrar carga mientras se procesa
                Swal.fire({
                    title: 'Eliminando especie',
                    html: 'Por favor espere...',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        // Enviar formulario de eliminación
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = url;
                        form.innerHTML = `@csrf @method("DELETE")`;
                        document.body.appendChild(form);
                        form.submit();
                    },
                    willClose: () => {
                        clearTimeout(timer);
                    }
                });
            }
        });
    };
    
    // 3. Sistema de notificaciones mejorado
    const NotificationSystem = {
        show: function(type, message) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInRight'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutRight'
                },
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                    
                    // Añadir icono personalizado
                    const iconMap = {
                        success: 'check-circle',
                        error: 'exclamation-circle',
                        info: 'info-circle',
                        warning: 'exclamation-triangle'
                    };
                    
                    const icon = document.createElement('i');
                    icon.className = `fas fa-${iconMap[type]} me-2`;
                    toast.querySelector('.swal2-title').prepend(icon);
                }
            });
            
            Toast.fire({
                title: message,
                background: 'var(--bs-body-bg)',
                color: 'var(--bs-body-color)',
                icon: type
            });
        }
    };
    
    // Mostrar notificaciones automáticas
    @if(session('success'))
    NotificationSystem.show('success', '{{ session('success') }}');
    @endif
    
    @if(session('error'))
    NotificationSystem.show('error', '{{ session('error') }}');
    @endif
    
    @if(session('register'))
    NotificationSystem.show('success', 'Especie registrada correctamente');
    @endif
    
    @if(session('modify'))
    NotificationSystem.show('success', 'Especie actualizada correctamente');
    @endif
    
    @if(session('destroy'))
    NotificationSystem.show('success', 'Especie eliminada correctamente');
    @endif
    
    // 4. Mejoras para formularios en modales
    document.querySelectorAll('.modal-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Mostrar estado de carga
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Procesando...
            `;
            
            // Simular envío (reemplazar con tu lógica AJAX real)
            setTimeout(() => {
                // Resetear botón
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
                
                // Cerrar modal después de éxito
                const modal = this.closest('.modal');
                if (modal) {
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                }
                
                // Mostrar notificación de éxito
                NotificationSystem.show('success', 'Operación completada');
            }, 1500);
        });
    });
});
</script>

@endsection