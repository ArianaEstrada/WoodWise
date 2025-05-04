@extends('dashboard')

@section('template_title', 'Gestión de Tipos de Estimaciones')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header Mejorado -->
        <div class="card-header bg-gradient-forest text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-calculator fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold text-white">Tipos de Estimaciones</h5>
            </div>
            <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createTipoModal">
                <i class="fas fa-plus me-2"></i>Nuevo Tipo
            </button>
        </div>
        
        <!-- Card Body - Tabla Mejorada -->
        <div class="card-body p-0">
            <div class="table-responsive rounded-lg">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-forest text-white">
                        <tr>
                            <th class="py-3 ps-4">ID</th>
                            <th class="py-3">Descripción</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tipo_estimaciones as $tipo)
                        <tr class="border-bottom">
                            <td class="ps-4">{{ $tipo->id_tipo_e }}</td>
                            <td class="fw-semibold">{{ $tipo->desc_estimacion }}</td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-primary rounded-start-pill me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewTipoModal{{ $tipo->id_tipo_e }}">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editTipoModal{{ $tipo->id_tipo_e }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill" 
                                            onclick="confirmDelete('{{ route('tipo_estimaciones.destroy', $tipo->id_tipo_e) }}')">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Todos los modales fuera de la tabla -->
@foreach ($tipo_estimaciones as $tipo)
<!-- Modal Ver Tipo -->
<div class="modal fade" id="viewTipoModal{{ $tipo->id_tipo_e }}" tabindex="-1" aria-labelledby="viewTipoLabel{{ $tipo->id_tipo_e }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-white">
        <div class="modal-content border-0 shadow text-white">
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title text-white" id="viewTipoLabel{{ $tipo->id_tipo_e }}">
                    <i class="fas fa-info-circle me-2 text-white"></i>Detalles del Tipo de Estimación
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">ID:</h6>
                        <p class="text-muted">{{ $tipo->id_tipo_e }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Fecha Registro:</h6>
                        <p class="text-muted">{{ $tipo->created_at?->format('d/m/Y') ?? 'Sin fecha' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-muted">Descripción:</h6>
                        <p class="text-muted">{{ $tipo->desc_estimacion }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Tipo -->
<div class="modal fade" id="editTipoModal{{ $tipo->id_tipo_e }}" tabindex="-1" aria-labelledby="editTipoLabel{{ $tipo->id_tipo_e }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title text-white" id="editTipoLabel{{ $tipo->id_tipo_e }}">
                    <i class="fas fa-edit me-2"></i>Editar Tipo de Estimación
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('tipo_estimaciones.update', $tipo->id_tipo_e) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label text-muted">Descripción</label>
                        <input type="text" class="form-control border-2" name="desc_estimacion" value="{{ old('desc_estimacion', $tipo->desc_estimacion) }}" required>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-save me-1"></i>Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Crear Tipo -->
<div class="modal fade" id="createTipoModal" tabindex="-1" aria-labelledby="createTipoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title text-white" id="createTipoLabel">
                    <i class="fas fa-plus-circle me-2"></i>Nuevo Tipo de Estimación
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('tipo_estimaciones.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted">Descripción</label>
                        <input type="text" name="desc_estimacion" class="form-control border-2" required>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-check-circle me-1"></i>Crear Tipo de Estimación
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts Mejorados -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Sistema de gestión de modales mejorado
document.addEventListener('DOMContentLoaded', function() {
    // 1. Inicialización controlada de modales
    const modalInstances = new Map();
    let currentBackdrop = null;

    // Función para manejar la apertura de modales
    function handleModalOpen(e) {
        e.preventDefault();
        const modalId = this.getAttribute('data-bs-target');
        const modalElement = document.querySelector(modalId);
        
        if (!modalElement) return;
        
        // Cerrar modal actual si existe
        if (modalInstances.size > 0) {
            closeAllModals();
        }
        
        // Crear nueva instancia de modal
        const modalInstance = new bootstrap.Modal(modalElement, {
            backdrop: true,
            keyboard: true
        });
        
        // Configurar eventos para este modal
        modalElement.addEventListener('hidden.bs.modal', function() {
            // Limpiar el backdrop manualmente si es necesario
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => {
                backdrop.parentNode.removeChild(backdrop);
            });
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
            
            modalInstances.delete(modalId);
        });

        modalInstances.set(modalId, modalInstance);
        modalInstance.show();
    }
    
    // Función para cerrar todos los modales y limpiar
    function closeAllModals() {
        modalInstances.forEach(instance => {
            instance.hide();
            // Limpieza adicional
            const modalElement = instance._element;
            modalElement.classList.remove('show');
            modalElement.style.display = 'none';
            modalElement.removeAttribute('aria-modal');
            modalElement.removeAttribute('role');
            modalElement.setAttribute('aria-hidden', 'true');
        });
        
        // Limpiar backdrops manualmente
        const backdrops = document.querySelectorAll('.modal-backdrop');
        backdrops.forEach(backdrop => {
            backdrop.parentNode.removeChild(backdrop);
        });
        
        // Restaurar el estado del body
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
        
        modalInstances.clear();
    }
    
    // Asignar eventos a los botones
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(btn => {
        btn.addEventListener('click', handleModalOpen);
    });
    
    // 2. Función para eliminar con confirmación
    window.confirmDelete = function(url) {
        // Tu función actual de confirmDelete...
    };
    
    // 3. Notificaciones automáticas mejoradas
    @if(session('success'))
    showNotification('success', '{{ session('success') }}');
    @endif
    
    @if(session('error'))
    showNotification('error', '{{ session('error') }}');
    @endif
    
    function showNotification(type, message) {
        // Tu función actual de notificaciones...
    }
});
</script>
<style>
        /* Fix crítico para el backdrop */
        .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1040;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5) !important;
    }
    
    .modal {
        z-index: 1050 !important;
    }
    /* Estilos personalizados para esta vista */
    .bg-gradient-forest {
        background: linear-gradient(135deg, #2e7d32, #1b5e20);
    }
    
    .bg-light-forest {
        background-color: rgba(46, 125, 50, 0.9);
    }
    
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(232, 245, 233, 0.5);
    }
    
    .form-control.border-2, .form-select.border-2 {
        border-width: 2px !important;
        border-radius: 8px;
    }
    
    .btn-outline-warning {
        color: #ff9800;
        border-color: #ff9800;
    }
    
    .btn-outline-warning:hover {
        background-color: #ff9800;
        color: white;
    }
    
    /* Fix para modales */
    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1040;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5) !important;
    }
    
    .modal {
        z-index: 1050 !important;
    }
    
    .modal.fade .modal-dialog {
        transition: transform 0.2s ease-out;
        transform: translateY(-20px);
    }
    
    .modal.show .modal-dialog {
        transform: translateY(0);
    }
    
    .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
    
    .modal-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }
</style>
@endsection