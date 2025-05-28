@extends('dashboard')

@section('template_title', 'Gestión de Estimaciones')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header -->
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-calculator fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold text-white">Lista de Estimaciones</h5>
            </div>
            <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createEstimacionModal">
                <i class="fas fa-plus me-2"></i>Agregar Estimación
            </button>
        </div>
        
        <!-- Card Body -->
        <div class="card-body p-0">
            <div class="table-responsive rounded-lg">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-primary text-white">
                        <tr>
                            <th class="py-3 ps-4">ID</th>
                            <th class="py-3">Tipo Estimación</th>
                            <th class="py-3">Fórmula</th>
                            <th class="py-3">Cálculo</th>
                            <th class="py-3">Troza</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estimaciones as $estimacion)
                        <tr class="border-bottom">
                            <td class="ps-4">{{ $estimacion->id_estimacion }}</td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary text-white">
                                    {{ $estimacion->tipoEstimacion->desc_estimacion }}
                                </span>
                            </td>
                            <td class="fw-semibold">{{ $estimacion->formula->nom_formula }}</td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success text-white">
                                    {{ number_format($estimacion->calculo, 6) }} 
                                    {{ $estimacion->tipoEstimacion->unidad_medida }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-success rounded-circle me-2">
                                        <i class="fas fa-tree text-success"></i>
                                    </div>
                                    <span>
                                        {{ $estimacion->troza->id_troza ?? 'N/A' }}
                                        {{ $estimacion->troza->especie->nom_comun ?? 'N/A' }} / 
                                        {{ $estimacion->troza->parcela->nom_parcela ?? 'N/A' }}
                                    </span>
                                </div>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-info rounded-start-pill me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewEstimacionModal{{ $estimacion->id_estimacion }}">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editEstimacionModal{{ $estimacion->id_estimacion }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill" 
                                            onclick="confirmDelete('{{ route('estimaciones.destroy', $estimacion->id_estimacion) }}', 'Estimación #{{ $estimacion->id_estimacion }}')">
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

<!-- Modales para cada estimación -->
@foreach ($estimaciones as $estimacion)
<!-- Modal Ver Estimación -->
<div class="modal fade" id="viewEstimacionModal{{ $estimacion->id_estimacion }}" tabindex="-1" 
     aria-labelledby="viewEstimacionLabel{{ $estimacion->id_estimacion }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title text-white">
                    <i class="fas fa-info-circle me-2"></i>Detalles de Estimación
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-lg bg-light-primary rounded-circle d-flex align-items-center justify-content-center me-3">
                                <i class="fas fa-calculator fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h4 class="mb-0">Estimación #{{ $estimacion->id_estimacion }}</h4>
                                <p class="text-muted mb-0">Registrada: {{ $estimacion->created_at?->format('d/m/Y') ?? 'Sin fecha' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted">Tipo de Estimación:</h6>
                        <p class="fw-bold">{{ $estimacion->tipoEstimacion->desc_estimacion }}</p>
                    </div>
                   
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted">Fórmula Utilizada:</h6>
                        <p class="fw-bold">{{ $estimacion->formula->nom_formula }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted">Resultado del Cálculo:</h6>
                        <p class="fw-bold">{{ number_format($estimacion->calculo, 8) }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted">Especie:</h6>
                        <p class="fw-bold">{{ $estimacion->troza->especie->nom_comun ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted">Parcela:</h6>
                        <p class="fw-bold">{{ $estimacion->troza->parcela->nom_parcela ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted">Fecha Creación:</h6>
                        <p class="fw-bold">{{ $estimacion->created_at?->format('d/m/Y') ?? 'Sin fecha' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted">Última Actualización:</h6>
                        <p class="fw-bold">{{ $estimacion->updated_at?->format('d/m/Y') ?? 'Sin actualizaciones' }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" 
                        data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Estimación -->
<div class="modal fade" id="editEstimacionModal{{ $estimacion->id_estimacion }}" tabindex="-1" 
     aria-labelledby="editEstimacionLabel{{ $estimacion->id_estimacion }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title text-white">
                    <i class="fas fa-edit me-2"></i>Editar Estimación
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('estimaciones.update', $estimacion->id_estimacion) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label text-muted">Tipo de Estimación</label>
                        <select name="id_tipo_e" class="form-select border-2" required>
                            @foreach ($tiposEstimacion as $tipo)
                            <option value="{{ $tipo->id_tipo_e }}" {{ $tipo->id_tipo_e == $estimacion->id_tipo_e ? 'selected' : '' }}>
                                {{ $tipo->desc_estimacion }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Fórmula</label>
                        <select name="id_formula" class="form-select border-2" required>
                            @foreach ($formulas as $formula)
                            <option value="{{ $formula->id_formula }}" {{ $formula->id_formula == $estimacion->id_formula ? 'selected' : '' }}>
                                {{ $formula->nom_formula }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Troza</label>
                        <select name="id_troza" class="form-select border-2" required>
                            @foreach ($trozas as $troza)
                            <option value="{{ $troza->id_troza }}" {{ $troza->id_troza == $estimacion->id_troza ? 'selected' : '' }}>
                                {{ $troza->especie->nom_comun ?? 'N/A' }} ({{ $troza->parcela->nom_parcela ?? 'N/A' }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                data-bs-dismiss="modal">Cancelar</button>
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

<!-- Modal Crear Estimación -->
<div class="modal fade" id="createEstimacionModal" tabindex="-1" aria-labelledby="createEstimacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title text-white">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Estimación
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('estimaciones.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted">Tipo de Estimación</label>
                        <select name="id_tipo_e" class="form-select border-2" required>
                            <option value="">Seleccione un tipo</option>
                            @foreach ($tiposEstimacion as $tipo)
                            <option value="{{ $tipo->id_tipo_e }}">{{ $tipo->desc_estimacion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Fórmula</label>
                        <select name="id_formula" class="form-select border-2" required>
                            <option value="">Seleccione una fórmula</option>
                            @foreach ($formulas as $formula)
                            <option value="{{ $formula->id_formula }}">{{ $formula->nom_formula }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Troza</label>
                        <select name="id_troza" class="form-select border-2" required>
                            <option value="">Seleccione una troza</option>
                            @foreach ($trozas as $troza)
                            <option value="{{ $troza->id_troza }}">
                               {{ $troza->id_troza ?? 'N/A' }} {{ $troza->especie->nom_comun ?? 'N/A' }} ({{ $troza->parcela->nom_parcela ?? 'N/A' }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-check-circle me-1"></i>Crear Estimación
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
// Sistema de gestión de modales mejorado para Estimaciones
document.addEventListener('DOMContentLoaded', function() {
    // 1. Inicialización controlada de modales
    const modalInstances = new Map();

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
            cleanUpModal(modalId);
        });

        modalInstances.set(modalId, modalInstance);
        modalInstance.show();
    }
    
    // Función para limpiar después de cerrar un modal
    function cleanUpModal(modalId) {
        // Limpiar el backdrop manualmente si es necesario
        const backdrops = document.querySelectorAll('.modal-backdrop');
        backdrops.forEach(backdrop => {
            backdrop.parentNode.removeChild(backdrop);
        });
        
        // Restaurar el estado del body
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
        
        // Eliminar la instancia del modal
        modalInstances.delete(modalId);
    }
    
    // Función para cerrar todos los modales y limpiar
    function closeAllModals() {
        modalInstances.forEach((instance, modalId) => {
            instance.hide();
            cleanUpModal(modalId);
        });
        modalInstances.clear();
    }
    
    // Asignar eventos a los botones de apertura de modales
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(btn => {
        btn.addEventListener('click', handleModalOpen);
    });
    
    // 2. Función para eliminar estimación con confirmación
    window.confirmDelete = function(url, estimacionName) {
        Swal.fire({
            title: '¿Confirmar eliminación?',
            html: `La estimación <strong>${estimacionName}</strong> será eliminada permanentemente`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                popup: 'rounded-3',
                confirmButton: 'btn btn-danger px-4 rounded-pill',
                cancelButton: 'btn btn-secondary px-4 rounded-pill ms-2'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                form.innerHTML = `@csrf @method("DELETE")`;
                document.body.appendChild(form);
                form.submit();
            }
        });
    };
    
    // 3. Notificaciones automáticas mejoradas para estimaciones
    @if(session('success'))
    showNotification('success', '{{ session('success') }}');
    @endif
    
    @if(session('error'))
    showNotification('error', '{{ session('error') }}');
    @endif
    
    @if(session('register'))
    showNotification('success', 'Estimación registrada correctamente');
    @endif
    
    @if(session('modify'))
    showNotification('success', 'Estimación actualizada correctamente');
    @endif
    
    @if(session('destroy'))
    showNotification('success', 'Estimación eliminada correctamente');
    @endif
    
    function showNotification(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: 'var(--bs-light)',
            color: 'var(--bs-dark)',
            iconColor: type === 'success' ? 'var(--bs-success)' : 'var(--bs-danger)',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
        
        Toast.fire({
            icon: type,
            title: message
        });
    }

    // 4. Manejo especial para botones de cierre dentro de modales
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(btn => {
        btn.addEventListener('click', function() {
            const modal = this.closest('.modal');
            if (modal) {
                const modalId = '#' + modal.id;
                const instance = modalInstances.get(modalId);
                if (instance) {
                    instance.hide();
                    cleanUpModal(modalId);
                }
            }
        });
    });

    // 5. Limpiar formularios al cerrar modales de creación/edición
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function() {
            const forms = this.querySelectorAll('form');
            forms.forEach(form => {
                form.reset();
                // Limpiar mensajes de error de validación
                const errorElements = form.querySelectorAll('.is-invalid, .invalid-feedback');
                errorElements.forEach(el => {
                    el.classList.remove('is-invalid', 'invalid-feedback');
                });
            });
        });
    });
});
</script>

<style>
    /* Estilos personalizados para esta vista */
    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--wood-primary), var(--wood-primary-dark));
    }
    
    .bg-light-primary {
        background-color: rgba(69, 117, 63, 0.9);
    }
    
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(232, 245, 233, 0.5);
    }
    
    .icon-sm {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .avatar-lg {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .form-control.border-2, .form-select.border-2 {
        border-width: 2px !important;
        border-radius: 8px;
    }
    
    /* Mejoras para los modales */
    .modal-content {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .modal-header {
        padding: 1.25rem 1.5rem;
    }
    
    .modal-body {
        padding: 1.5rem;
    }
    
    .modal-footer {
        padding: 1rem 1.5rem;
    }
</style>
@endsection