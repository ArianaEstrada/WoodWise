@extends('dashboard')

@section('template_title', 'Gestión de Árboles Forestales')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header Mejorado -->
        <div class="card-header bg-gradient-success text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-tree fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold text-white">Gestión de Árboles</h5>
            </div>
            <div class="d-flex">
                <form method="GET" action="{{ route('arboles.index') }}" class="me-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control rounded-pill" 
                               placeholder="Buscar..." value="{{ request('search') }}">
                        <button class="btn btn-light rounded-pill ms-2" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createArbolModal">
                    <i class="fas fa-plus me-2"></i>Nuevo Árbol
                </button>
            </div>
        </div>

        <!-- Card Body - Tabla Mejorada -->
        <div class="card-body p-0">
            <div class="table-responsive rounded-lg">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-success text-white">
                        <tr>
                            <th class="py-3">ID</th>
                            <th class="py-3">Altura (m)</th>
                            <th class="py-3">DAP (cm)</th>
                            <th class="py-3">Especie</th>
                            <th class="py-3">Parcela</th>
                            <th class="py-5 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arboles as $arbol)
                        <tr class="border-bottom">
                            <td class="ps-4">{{ $arbol->id_arbol }}</td>
                            <td class="fw-semibold">{{ number_format($arbol->altura_total, 2) }}</td>
                            <td>{{ number_format($arbol->diametro_pecho, 2) }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-primary rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-leaf text-primary"></i>
                                    </div>
                                    <span>{{ $arbol->especie->nom_cientifico }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-info rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-map-marked-alt text-info"></i>
                                    </div>
                                    <span>{{ $arbol->parcela->nom_parcela }}</span>
                                </div>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-info rounded-start-pill me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#viewArbolModal{{ $arbol->id_arbol }}">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editArbolModal{{ $arbol->id_arbol }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill"
                                            onclick="confirmDelete('{{ route('arboles.destroy', $arbol->id_arbol) }}')">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Paginación -->
            <div class="px-4 py-3">
                {{ $arboles->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modales fuera de la tabla -->
@foreach ($arboles as $arbol)
<!-- Modal Ver Árbol -->
<div class="modal fade" id="viewArbolModal{{ $arbol->id_arbol }}" tabindex="-1"
    aria-labelledby="viewArbolLabel{{ $arbol->id_arbol }}" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content border-0 shadow">
           <div class="modal-header bg-gradient-info text-white">
               <h5 class="modal-title text-white">
                   <i class="fas fa-info-circle me-2"></i>Detalles del Árbol
               </h5>
               <button type="button" class="btn-close btn-close-white"
                       data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body p-4">
               <div class="row mb-3">
                   <div class="col-md-6">
                       <h6 class="text-muted">ID:</h6>
                       <p class="fw-bold">{{ $arbol->id_arbol }}</p>
                   </div>
                   <div class="col-md-6">
                       <h6 class="text-muted">Fecha Registro:</h6>
                       <p class="fw-bold">{{ $arbol->created_at?->format('d/m/Y H:i') ?? 'Sin fecha' }}</p>
                   </div>
               </div>
               <div class="row mb-3">
                   <div class="col-md-6">
                       <h6 class="text-muted">Altura Total:</h6>
                       <p class="fw-bold">{{ number_format($arbol->altura_total, 2) }} metros</p>
                   </div>
                   <div class="col-md-6">
                       <h6 class="text-muted">Diámetro a la Altura del Pecho (DAP):</h6>
                       <p class="fw-bold">{{ number_format($arbol->diametro_pecho, 2) }} cm</p>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-6">
                       <h6 class="text-muted">Especie:</h6>
                       <p class="fw-bold">{{ $arbol->especie->nom_cientifico }}</p>
                   </div>
                   <div class="col-md-6">
                       <h6 class="text-muted">Parcela:</h6>
                       <p class="fw-bold">{{ $arbol->parcela->nom_parcela }}</p>
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

<!-- Modal Editar Árbol -->
<div class="modal fade" id="editArbolModal{{ $arbol->id_arbol }}" tabindex="-1"
    aria-labelledby="editArbolLabel{{ $arbol->id_arbol }}" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content border-0 shadow">
           <div class="modal-header bg-gradient-primary text-white">
               <h5 class="modal-title text-white">
                   <i class="fas fa-edit me-2"></i>Editar Árbol
               </h5>
               <button type="button" class="btn-close btn-close-white"
                       data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body p-4">
               <form method="POST" action="{{ route('arboles.update', $arbol->id_arbol) }}">
                   @csrf
                   @method('PUT')
                   <div class="row">
                       <div class="col-md-6 mb-3">
                           <label class="form-label text-muted">Altura Total (metros)</label>
                           <input type="number" step="0.01" class="form-control border-2"
                                  name="altura_total" value="{{ number_format($arbol->altura_total, 2) }}" required>
                           <small class="text-muted">Altura desde la base hasta el ápice</small>
                       </div>
                       <div class="col-md-6 mb-3">
                           <label class="form-label text-muted">DAP (cm)</label>
                           <input type="number" step="0.01" class="form-control border-2"
                                  name="diametro_pecho" value="{{ number_format($arbol->diametro_pecho, 2) }}" required>
                           <small class="text-muted">Diámetro a 1.30 m de altura</small>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-md-6 mb-3">
                           <label class="form-label text-muted">Especie</label>
                           <select class="form-select border-2" name="id_especie" required>
                               @foreach ($especies as $especie)
                               <option value="{{ $especie->id_especie }}"
                                       {{ $arbol->id_especie == $especie->id_especie ? 'selected' : '' }}>
                                   {{ $especie->nom_cientifico }}
                               </option>
                               @endforeach
                           </select>
                       </div>
                       <div class="col-md-6 mb-3">
                           <label class="form-label text-muted">Parcela</label>
                           <select class="form-select border-2" name="id_parcela" required>
                               @foreach ($parcelas as $parcela)
                               <option value="{{ $parcela->id_parcela }}"
                                       {{ $arbol->id_parcela == $parcela->id_parcela ? 'selected' : '' }}>
                                   {{ $parcela->nom_parcela }}
                               </option>
                               @endforeach
                           </select>
                       </div>
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

<!-- Modal Crear Árbol -->
<div class="modal fade" id="createArbolModal" tabindex="-1" aria-labelledby="createArbolLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title text-white">
                    <i class="fas fa-plus-circle me-2"></i>Nuevo Árbol
                </h5>
                <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('arboles.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Altura Total (metros)</label>
                            <input type="number" step="0.01" name="altura_total" class="form-control border-2" required>
                            <small class="text-muted">Altura desde la base hasta el ápice</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">DAP (cm)</label>
                            <input type="number" step="0.01" name="diametro_pecho" class="form-control border-2" required>
                            <small class="text-muted">Diámetro a 1.30 m de altura</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Especie</label>
                            <select class="form-select border-2" name="id_especie" required>
                                <option value="" selected disabled>Seleccione una especie</option>
                                @foreach ($especies as $especie)
                                <option value="{{ $especie->id_especie }}">{{ $especie->nom_cientifico }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Parcela</label>
                            <select class="form-select border-2" name="id_parcela" required>
                                <option value="" selected disabled>Seleccione una parcela</option>
                                @foreach ($parcelas as $parcela)
                                <option value="{{ $parcela->id_parcela }}">{{ $parcela->nom_parcela }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill"
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-check-circle me-1"></i>Registrar Árbol
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
        Swal.fire({
            title: '¿Confirmar eliminación?',
            text: 'El árbol será eliminado permanentemente',
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
            }
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
    
    // 3. Notificaciones automáticas mejoradas
    @if(session('register'))
    showNotification('success', 'Árbol registrado correctamente');
    @endif
    
    @if(session('modify'))
    showNotification('success', 'Los datos del árbol han sido actualizados');
    @endif
    
    @if(session('destroy'))
    showNotification('success', 'El árbol ha sido eliminado del sistema');
    @endif
    
    function showNotification(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: 'var(--wood-light)',
            color: 'var(--wood-text)',
            iconColor: 'var(--wood-primary)',
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
    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--wood-primary), var(--wood-primary-dark));
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #28a745, #218838);
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8, #138496);
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

    .form-control.border-2, .form-select.border-2 {
        border-width: 2px !important;
    }

    .border-2 {
        border-width: 2px !important;
    }
</style>
@endsection