@extends('dashboard')

@section('template_title', 'Gestión de Estimaciones')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Encabezado de la tarjeta -->
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-calculator fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold text-white">Listado de Estimaciones</h5>
            </div>
            <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createEstimacionModal">
                <i class="fas fa-plus me-2"></i>Nueva Estimación
            </button>
        </div>
        
        <!-- Cuerpo de la tarjeta -->
        <div class="card-body p-0">
            <div class="table-responsive rounded-lg">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-primary text-white">
                        <tr>
                            <th class="py-3 ps-4">Tipo Estimación</th>
                            <th class="py-3">Fórmula</th>
                            <th class="py-3">Cálculo</th>
                            <th class="py-3">Troza (Especie/Parcela)</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estimaciones as $estimacion)
                        <tr class="border-bottom">
                            <td class="ps-4">
                                <span class="badge bg-primary bg-opacity-10 text-primary">
                                    {{ $estimacion->tipoEstimacion->desc_estimacion }}
                                </span>
                            </td>
                            <td class="fw-semibold">{{ $estimacion->formula->nom_formula }}</td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    {{ number_format($estimacion->calculo, 4) }} 
                                    {{ $estimacion->tipoEstimacion->unidad_medida }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-success rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-tree text-success"></i>
                                    </div>
                                    <span>
                                        {{ $estimacion->troza->especie->nom_especie ?? 'N/A' }} / 
                                        {{ $estimacion->troza->parcela->nom_parcela ?? 'N/A' }}
                                    </span>
                                </div>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-primary rounded-start-pill me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewEstimacionModal{{ $estimacion->id_estimacion }}">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editEstimacionModal{{ $estimacion->id_estimacion }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill" 
                                            onclick="confirmDelete('{{ route('estimaciones.destroy', $estimacion->id_estimacion) }}')">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Ver Estimación -->
                        <div class="modal fade" id="viewEstimacionModal{{ $estimacion->id_estimacion }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-info text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-info-circle me-2"></i>Detalles de la Estimación
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">ID:</h6>
                                                <p class="fw-bold">{{ $estimacion->id_estimacion }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Fecha Registro:</h6>
                                                <p class="fw-bold">{{ $estimacion->created_at?->format('d/m/Y H:i') ?? 'Sin fecha' }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Tipo de Estimación:</h6>
                                                <p class="fw-bold">{{ $estimacion->tipoEstimacion->desc_estimacion }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Fórmula Utilizada:</h6>
                                                <p class="fw-bold">{{ $estimacion->formula->nom_formula }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Cálculo:</h6>
                                                <p class="fw-bold">{{ number_format($estimacion->calculo, 4) }} {{ $estimacion->tipoEstimacion->unidad_medida }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Troza:</h6>
                                                <p class="fw-bold">
                                                    {{ $estimacion->troza->especie->nom_especie ?? 'N/A' }} / 
                                                    {{ $estimacion->troza->parcela->nom_parcela ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Editar Estimación -->
                        <div class="modal fade" id="editEstimacionModal{{ $estimacion->id_estimacion }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-primary text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-edit me-2"></i>Editar Estimación
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                        {{ $troza->especie->nom_especie ?? 'N/A' }} ({{ $troza->parcela->nom_parcela ?? 'N/A' }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                                <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary rounded-pill">
                                                    <i class="fas fa-save me-1"></i>Actualizar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Estimación -->
<div class="modal fade" id="createEstimacionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Estimación
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                {{ $troza->especie->nom_especie ?? 'N/A' }} ({{ $troza->parcela->nom_parcela ?? 'N/A' }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-check-circle me-1"></i>Crear Estimación
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(url) {
    Swal.fire({
        title: '¿Confirmar eliminación?',
        text: 'La estimación será eliminada permanentemente',
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
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = url;
            form.innerHTML = '@csrf @method("DELETE")';
            document.body.appendChild(form);
            form.submit();
        }
    });
}

@if(session('success'))
Swal.fire({
    title: '¡Operación Exitosa!',
    text: '{{ session('success') }}',
    icon: 'success',
    confirmButtonText: 'Aceptar',
    customClass: {
        popup: 'rounded-3',
        confirmButton: 'btn btn-primary px-4 rounded-pill'
    }
});
@endif
</script>
@endsection

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #2e7d32, #1b5e20);
}

.bg-light-primary {
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

.icon-sm {
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
}
</style>