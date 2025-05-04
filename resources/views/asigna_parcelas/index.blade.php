@extends('dashboard')

@section('template_title', 'Asignación de Parcelas a Técnicos')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header -->
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-map-marked-alt fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold text-white">Asignaciones de Parcelas</h5>
            </div>
            <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createAsignacionModal">
                <i class="fas fa-plus me-2"></i>Nueva Asignación
            </button>
        </div>
        
        <!-- Card Body -->
        <div class="card-body p-0">
            <div class="table-responsive rounded-lg">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-primary text-white">
                        <tr>
                            <th class="py-3 ps-4">Técnico</th>
                            <th class="py-3">Parcela</th>
                            <th class="py-3">Productor</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asignaciones as $asignacion)
                        <tr class="border-bottom">
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-primary rounded-circle me-2">
                                        <i class="fas fa-user-tie text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $asignacion->tecnico->persona->nom }} {{ $asignacion->tecnico->persona->ap }}</h6>
                                        <small class="text-muted">ID: {{ $asignacion->tecnico->id_tecnico }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-success rounded-circle me-2">
                                        <i class="fas fa-map text-success"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $asignacion->parcela->nom_parcela }}</h6>
                                        <small class="text-muted">Área: {{ $asignacion->parcela->extension }} ha</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-info rounded-circle me-2">
                                        <i class="fas fa-user text-info"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $asignacion->parcela->productor->persona->nom }} {{ $asignacion->parcela->productor->persona->ap }}</h6>
                                        <small class="text-muted">{{ $asignacion->parcela->productor->persona->telefono }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-info rounded-start-pill me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewAsignacionModal{{ $asignacion->id_asigna_p }}">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editAsignacionModal{{ $asignacion->id_asigna_p }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill" 
                                            onclick="confirmDelete('{{ route('asigna_parcelas.destroy', $asignacion->id_asigna_p) }}', 'Asignación #{{ $asignacion->id_asigna_p }}')">
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

<!-- Modales para cada asignación -->
@foreach ($asignaciones as $asignacion)
<!-- Modal Ver Asignación -->
<div class="modal fade" id="viewAsignacionModal{{ $asignacion->id_asigna_p }}" tabindex="-1" 
     aria-labelledby="viewAsignacionLabel{{ $asignacion->id_asigna_p }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title text-white">
                    <i class="fas fa-info-circle me-2"></i>Detalles de Asignación
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Técnico:</h6>
                        <p class="fw-bold">{{ $asignacion->tecnico->persona->nom }} {{ $asignacion->tecnico->persona->ap }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">ID Técnico:</h6>
                        <p class="fw-bold">{{ $asignacion->tecnico->id_tecnico }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Parcela:</h6>
                        <p class="fw-bold">{{ $asignacion->parcela->nom_parcela }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Área:</h6>
                        <p class="fw-bold">{{ $asignacion->parcela->extension }} ha</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Productor:</h6>
                        <p class="fw-bold">{{ $asignacion->parcela->productor->persona->nom }} {{ $asignacion->parcela->productor->persona->ap }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Teléfono:</h6>
                        <p class="fw-bold">{{ $asignacion->parcela->productor->persona->telefono }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Fecha Asignación:</h6>
                        <p class="fw-bold">
                            {{ $asignacion->created_at ? $asignacion->created_at->format('d/m/Y') : 'Sin fecha' }}
                        </p>
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

<!-- Modal Editar Asignación -->
<div class="modal fade" id="editAsignacionModal{{ $asignacion->id_asigna_p }}" tabindex="-1" 
     aria-labelledby="editAsignacionLabel{{ $asignacion->id_asigna_p }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title text-white">
                    <i class="fas fa-edit me-2"></i>Editar Asignación
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('asigna_parcelas.update', $asignacion->id_asigna_p) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label text-muted">Técnico</label>
                        <select name="id_tecnico" class="form-select border-2" required>
                            @foreach ($tecnicos as $tecnico)
                            <option value="{{ $tecnico->id_tecnico }}" 
                                    {{ $tecnico->id_tecnico == $asignacion->id_tecnico ? 'selected' : '' }}>
                                {{ $tecnico->persona->nom }} {{ $tecnico->persona->ap }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Parcela</label>
                        <select name="id_parcela" class="form-select border-2" required>
                            @foreach ($parcelas as $parcela)
                            <option value="{{ $parcela->id_parcela }}" 
                                    {{ $parcela->id_parcela == $asignacion->id_parcela ? 'selected' : '' }}>
                                {{ $parcela->nom_parcela }} ({{ $parcela->productor->persona->nom }} {{ $parcela->productor->persona->ap }} {{ $parcela->productor->persona->am }})
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

<!-- Modal Crear Asignación -->
<div class="modal fade" id="createAsignacionModal" tabindex="-1" aria-labelledby="createAsignacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title text-white">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Asignación
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('asigna_parcelas.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted">Técnico</label>
                        <select name="id_tecnico" class="form-select border-2" required>
                            <option value="" selected disabled>Seleccione un técnico...</option>
                            @foreach ($tecnicos as $tecnico)
                            <option value="{{ $tecnico->id_tecnico }}">
                                {{ $tecnico->persona->nom }} {{ $tecnico->persona->ap }} {{ $tecnico->persona->am }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Parcela</label>
                        <select name="id_parcela" class="form-select border-2" required>
                            <option value="" selected disabled>Seleccione una parcela...</option>
                            @foreach ($parcelas as $parcela)
                            <option value="{{ $parcela->id_parcela }}">
                                {{ $parcela->nom_parcela }} ({{ $parcela->productor->persona->nom }} {{ $parcela->productor->persona->ap }} {{ $parcela->productor->persona->am }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-check-circle me-1"></i>Crear Asignación
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
// Sistema de gestión de modales mejorado para Asignaciones
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
    
    // 2. Función para eliminar asignación con confirmación
    window.confirmDelete = function(url, asignacionName) {
        Swal.fire({
            title: '¿Confirmar eliminación?',
            html: `La asignación <strong>${asignacionName}</strong> será eliminada permanentemente`,
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
    
    // 3. Notificaciones automáticas mejoradas para asignaciones
    @if(session('success'))
    showNotification('success', '{{ session('success') }}');
    @endif
    
    @if(session('error'))
    showNotification('error', '{{ session('error') }}');
    @endif
    
    @if(session('register'))
    showNotification('success', 'Asignación registrada correctamente');
    @endif
    
    @if(session('modify'))
    showNotification('success', 'Asignación actualizada correctamente');
    @endif
    
    @if(session('destroy'))
    showNotification('success', 'Asignación eliminada correctamente');
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
        background-color: rgba(69, 117, 63, 0.1);
    }
    
    .bg-light-success {
        background-color: rgba(107, 142, 35, 0.1);
    }
    
    .bg-light-info {
        background-color: rgba(23, 162, 184, 0.1);
    }
    
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(232, 245, 233, 0.5);
    }
    
    .icon-sm {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
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