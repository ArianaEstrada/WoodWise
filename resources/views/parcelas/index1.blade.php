@extends('dashboard')

@section('template_title', 'Gestión de Parcelas')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header -->
        <div class="card-header bg-gradient-forest text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-map-marked-alt fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold text-white">Gestión de Parcelas</h5>
            </div>
            <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createParcelaModal">
                <i class="fas fa-plus me-2"></i>Nueva Parcela
            </button>
        </div>

        <!-- Card Body -->
        <div class="card-body p-0">
            <div class="table-responsive rounded-lg">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-forest text-white">
                        <tr>
                            <th class="py-3">ID</th>
                            <th class="py-3">Nombre</th>
                            <th class="py-3">Ubicación</th>
                            <th class="py-3">Productor</th>
                            <th class="py-3">Extensión</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parcelas as $parcela)
                        <tr class="border-bottom">
                            <td class="ps-4">{{ $parcela->id_parcela }}</td>
                            <td class="fw-semibold">{{ $parcela->nom_parcela }}</td>
                            <td>{{ $parcela->ubicacion }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-primary rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user-tie text-primary"></i>
                                    </div>
                                    <span>{{ $parcela->productor->persona->nom }} {{ $parcela->productor->persona->ap }} {{ $parcela->productor->persona->am }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info text-white text-center">
                                    {{ $parcela->extension }} ha
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-primary rounded-start-pill me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#viewParcelaModal{{ $parcela->id_parcela }}">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editParcelaModal{{ $parcela->id_parcela }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill"
                                            onclick="confirmDelete('{{ route('parcelas.destroy', $parcela->id_parcela) }}', '{{ $parcela->nom_parcela }}')">
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

<!-- Modales para cada parcela -->
@foreach ($parcelas as $parcela)
<!-- Modal Ver Parcela -->
<div class="modal fade" id="viewParcelaModal{{ $parcela->id_parcela }}" tabindex="-1" 
     aria-labelledby="viewParcelaLabel{{ $parcela->id_parcela }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title text-white">
                    <i class="fas fa-info-circle me-2"></i>Detalles de la Parcela
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        <div class="avatar-lg bg-light-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                            <i class="fas fa-map-marked-alt fa-2x text-primary"></i>
                        </div>
                        <h5 class="mb-1">{{ $parcela->nom_parcela }}</h5>
                        <p class="text-muted mb-0">ID: {{ $parcela->id_parcela }}</p>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted">Ubicación:</h6>
                                <p class="fw-bold">{{ $parcela->ubicacion }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted">Productor:</h6>
                                <p class="fw-bold"> {{ $parcela->productor->persona->nom }} {{ $parcela->productor->persona->ap }} {{ $parcela->productor->persona->am }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted">Extensión:</h6>
                                <p class="fw-bold">{{ $parcela->extension }} hectáreas</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted">Código Postal:</h6>
                                <p class="fw-bold">{{ $parcela->CP }}</p>
                            </div>
                            <div class="col-12 mb-3">
                                <h6 class="text-muted">Dirección:</h6>
                                <p class="fw-bold">{{ $parcela->direccion }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted">Fecha Registro:</h6>
                                <p class="fw-bold">{{ $parcela->created_at?->format('d/m/Y') ?? 'Sin fecha' }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted">Última Actualización:</h6>
                                <p class="fw-bold">{{ $parcela->updated_at?->format('d/m/Y') ?? 'Sin actualización' }}</p>
                            </div>
                        </div>
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

<!-- Modal Editar Parcela -->
<div class="modal fade" id="editParcelaModal{{ $parcela->id_parcela }}" tabindex="-1" 
     aria-labelledby="editParcelaLabel{{ $parcela->id_parcela }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title text-white">
                    <i class="fas fa-edit me-2"></i>Editar Parcela
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('parcelas.update', $parcela->id_parcela) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label text-muted">Nombre Parcela</label>
                        <input type="text" name="nom_parcela" class="form-control border-2"
                               value="{{ old('nom_parcela', $parcela->nom_parcela) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Ubicación</label>
                        <input type="text" name="ubicacion" class="form-control border-2"
                               value="{{ old('ubicacion', $parcela->ubicacion) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Productor</label>
                        <select name="id_productor" class="form-select border-2" required>
                            @foreach ($productores as $productor)
                            <option value="{{ $productor->id_productor }}" {{ $productor->id_productor == $parcela->id_productor ? 'selected' : '' }}>
                                {{ $parcela->productor->persona->nom }} {{ $parcela->productor->persona->ap }} {{ $parcela->productor->persona->am }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Extensión (hectáreas)</label>
                        <input type="number" step="0.01" name="extension" class="form-control border-2"
                               value="{{ old('extension', $parcela->extension) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Dirección</label>
                        <textarea name="direccion" rows="3" class="form-control border-2">{{ old('direccion', $parcela->direccion) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Código Postal</label>
                        <input type="number" name="CP" min="10000" max="99999" class="form-control border-2"
                               value="{{ old('CP', $parcela->CP) }}" required>
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

<!-- Modal Crear Parcela -->
<div class="modal fade" id="createParcelaModal" tabindex="-1" aria-labelledby="createParcelaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title text-white">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Parcela
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('parcelas.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted">Nombre Parcela</label>
                        <input type="text" name="nom_parcela" class="form-control border-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Ubicación</label>
                        <input type="text" name="ubicacion" class="form-control border-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Productor</label>
                        <select name="id_productor" class="form-select border-2" required>
                            <option value="" selected disabled>Seleccione un productor</option>
                            @foreach ($productores as $productor)
                            <option value="{{ $productor->id_productor }}">
                                {{ $parcela->productor->persona->nom }} {{ $parcela->productor->persona->ap }} {{ $parcela->productor->persona->am }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Extensión (hectáreas)</label>
                        <input type="number" step="0.01" name="extension" class="form-control border-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Dirección</label>
                        <textarea name="direccion" rows="3" class="form-control border-2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Código Postal</label>
                        <input type="number" name="CP" min="10000" max="99999" class="form-control border-2" required>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-check-circle me-1"></i>Crear Parcela
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
// Sistema de gestión de modales mejorado para Parcelas
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
    
    // 2. Función para eliminar parcela con confirmación
    window.confirmDelete = function(url, parcelaName) {
        Swal.fire({
            title: '¿Confirmar eliminación?',
            html: `La parcela <strong>${parcelaName}</strong> será eliminada permanentemente`,
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
    
    // 3. Notificaciones automáticas mejoradas para parcelas
    @if(session('success'))
    showNotification('success', '{{ session('success') }}');
    @endif
    
    @if(session('error'))
    showNotification('error', '{{ session('error') }}');
    @endif
    
    @if(session('register'))
    showNotification('success', 'Parcela registrada correctamente');
    @endif
    
    @if(session('modify'))
    showNotification('success', 'Parcela actualizada correctamente');
    @endif
    
    @if(session('destroy'))
    showNotification('success', 'Parcela eliminada correctamente');
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
    
    .icon-sm {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
    }
    
    .avatar-lg {
        width: 80px;
        height: 80px;
        font-size: 1.5rem;
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