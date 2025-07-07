@extends('dashboard')

@section('template_title', 'Gestión de Estimaciones de Árboles')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header -->
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-calculator fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold text-white">Estimaciones de Árboles</h5>
            </div>
            <div class="d-flex">
                <form method="GET" action="{{ route('estimaciones1.index') }}" class="me-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control rounded-pill" 
                               placeholder="Buscar..." value="{{ request('search') }}">
                        <button class="btn btn-light rounded-pill ms-2" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createEstimacionModal">
                    <i class="fas fa-plus me-2"></i>Nueva Estimación
                </button>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body p-0">
            <div class="table-responsive rounded-lg">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-primary text-white">
                        <tr>
                            <th class="py-3 ps-4">ID</th>
                            <th class="py-3">Tipo</th>
                            <th class="py-3">Fórmula</th>
                            <th class="py-3">Resultado</th>
                            <th class="py-3">Árbol</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estimaciones as $estimacion)
                        <tr class="border-bottom">
                            <td class="ps-4">{{ $estimacion->id_estimacion1 }}</td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary">
                                    {{ $estimacion->tipoEstimacion->desc_estimacion }}
                                </span>
                            </td>
                            <td>{{ $estimacion->formula->nom_formula }}</td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success text-white">
                                    {{ number_format($estimacion->calculo, 4) }} 
                                    {{ $estimacion->tipoEstimacion->unidad_medida }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-success rounded-circle me-2">
                                        <i class="fas fa-tree text-success"></i>
                                    </div>
                                    <span>
                                        #{{ $estimacion->arbol->id_arbol }} - 
                                        {{ $estimacion->arbol->especie->nom_cientifico }} / 
                                        {{ $estimacion->arbol->parcela->nom_parcela }}
                                    </span>
                                </div>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-info rounded-start-pill me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewEstimacionModal{{ $estimacion->id_estimacion1 }}">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editEstimacionModal{{ $estimacion->id_estimacion1 }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill" 
                                            onclick="confirmDelete('{{ route('estimaciones1.destroy', $estimacion->id_estimacion1) }}', 'Estimación #{{ $estimacion->id_estimacion1 }}')">
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
                {{ $estimaciones->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modales para cada estimación -->
@foreach ($estimaciones as $estimacion)
<!-- Modal Ver Estimación -->
<div class="modal fade" id="viewEstimacionModal{{ $estimacion->id_estimacion1 }}" tabindex="-1" 
     aria-labelledby="viewEstimacionLabel{{ $estimacion->id_estimacion1 }}" aria-hidden="true">
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
                                <h4 class="mb-0">Estimación #{{ $estimacion->id_estimacion1 }}</h4>
                                <p class="text-muted mb-0">Creada: {{ $estimacion->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row text-white">
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted">Tipo de Estimación:</h6>
                        <p class="fw-bold">{{ $estimacion->tipoEstimacion->desc_estimacion }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted">Fórmula Utilizada:</h6>
                        <p class="fw-bold">{{ $estimacion->formula->nom_formula }}</p>
                    </div>
                    <div class="col-md-6 mb-3 text-white">
                        <h6 class="text-muted text-white">Resultado:</h6>
                        <p class="fw-bold text-white">
                            {{ number_format($estimacion->calculo, 6) }} 
                            {{ $estimacion->tipoEstimacion->unidad_medida }}
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted">Árbol:</h6>
                        <p class="fw-bold">
                            #{{ $estimacion->arbol->id_arbol }} - 
                            {{ $estimacion->arbol->especie->nom_cientifico }}
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted">Parcela:</h6>
                        <p class="fw-bold">{{ $estimacion->arbol->parcela->nom_parcela }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted">DAP del Árbol:</h6>
                        <p class="fw-bold">{{ number_format($estimacion->arbol->diametro_pecho, 2) }} cm</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted">Altura del Árbol:</h6>
                        <p class="fw-bold">{{ number_format($estimacion->arbol->altura_total, 2) }} m</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted">Última Actualización:</h6>
<p class="fw-bold">
    {{ $estimacion->updated_at ? $estimacion->updated_at->format('d/m/Y H:i') : 'Sin fecha' }}
</p>                    </div>
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
<div class="modal fade" id="editEstimacionModal{{ $estimacion->id_estimacion1 }}" tabindex="-1" 
     aria-labelledby="editEstimacionLabel{{ $estimacion->id_estimacion1 }}" aria-hidden="true">
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
                <form method="POST" action="{{ route('estimaciones1.update', $estimacion->id_estimacion1) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label text-muted">Tipo de Estimación</label>
                        <select name="id_tipo_e" class="form-select border-2" required>
                            @foreach ($tiposEstimacion as $tipo)
                            <option value="{{ $tipo->id_tipo_e }}" 
                                {{ $tipo->id_tipo_e == $estimacion->id_tipo_e ? 'selected' : '' }}>
                                {{ $tipo->desc_estimacion }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Fórmula</label>
                        <select name="id_formula" class="form-select border-2" required>
                            @foreach ($formulas as $formula)
                            <option value="{{ $formula->id_formula }}" 
                                {{ $formula->id_formula == $estimacion->id_formula ? 'selected' : '' }}>
                                {{ $formula->nom_formula }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Árbol</label>
                        <select name="id_arbol" class="form-select border-2" required>
                            @foreach ($arboles as $arbol)
                            <option value="{{ $arbol->id_arbol }}" 
                                {{ $arbol->id_arbol == $estimacion->id_arbol ? 'selected' : '' }}>
                                #{{ $arbol->id_arbol }} - {{ $arbol->especie->nom_cientifico }} ({{ $arbol->parcela->nom_parcela }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Resultado del Cálculo</label>
                        <input type="number" step="0.000001" name="calculo" 
                               class="form-control border-2" 
                               value="{{ old('calculo', $estimacion->calculo) }}">
                        <small class="text-muted">Dejar en blanco para calcular automáticamente</small>
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
                <form method="POST" action="{{ route('estimaciones1.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted">Tipo de Estimación</label>
                        <select name="id_tipo_e" id="tipo_estimacion" class="form-select border-2" required>
                            <option value="">Seleccione un tipo</option>
                            @foreach ($tiposEstimacion as $tipo)
                            <option value="{{ $tipo->id_tipo_e }}">{{ $tipo->desc_estimacion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
    <label class="form-label text-muted">Fórmula</label>
    <select name="id_formula" id="formula_select" class="form-select border-2" required>
        <option value="">Seleccione una fórmula</option>
        @foreach ($formulas as $formula)
        <option value="{{ $formula->id_formula }}">
            {{ $formula->nom_formula }}
        </option>
        @endforeach
    </select>
</div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Árbol</label>
                        <select name="id_arbol" class="form-select border-2" required>
                            <option value="">Seleccione un árbol</option>
                            @foreach ($arboles as $arbol)
                            <option value="{{ $arbol->id_arbol }}">
                                #{{ $arbol->id_arbol }} - {{ $arbol->especie->nom_cientifico }} ({{ $arbol->parcela->nom_parcela }})
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
// Sistema de gestión de modales mejorado
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
    
    // 2. Función para eliminar con confirmación
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
    
    // 3. Notificaciones automáticas mejoradas
    @if(session('success'))
    showNotification('success', '{{ session('success') }}');
    @endif
    
    @if(session('error'))
    showNotification('error', '{{ session('error') }}');
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

    // 4. Actualizar fórmulas cuando cambia el tipo de estimación
    document.getElementById('tipo_estimacion').addEventListener('change', function() {
        const tipoId = this.value;
        const formulaSelect = document.getElementById('formula_select');
        
        // Ocultar todas las opciones primero
        formulaSelect.querySelectorAll('option').forEach(option => {
            option.hidden = true;
        });
        
        // Mostrar solo las opciones del tipo seleccionado
        if (tipoId) {
            formulaSelect.querySelectorAll(`.tipo-${tipoId}`).forEach(option => {
                option.hidden = false;
            });
            
            // Seleccionar la primera opción disponible
            const firstOption = formulaSelect.querySelector(`.tipo-${tipoId}`);
            if (firstOption) {
                firstOption.selected = true;
            } else {
                formulaSelect.value = '';
            }
        } else {
            formulaSelect.value = '';
        }
    });
});
</script>

<style>
    /* Estilos personalizados para esta vista */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df, #224abe);
    }
    
    .bg-light-primary {
        background-color: rgba(78, 115, 223, 0.1);
    }
    
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(78, 115, 223, 0.05);
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