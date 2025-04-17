@extends('dashboard')

@section('template_title', 'Gestión de Estimaciones')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header Mejorado -->
        <div class="card-header bg-gradient-forest text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-calculator fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold">Listado de Estimaciones</h5>
            </div>
            <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createEstimacionModal">
                <i class="fas fa-plus me-2"></i>Nueva Estimación
            </button>
        </div>
        
        <!-- Card Body - Tabla Mejorada -->
        <div class="card-body p-0">
            <div class="table-responsive rounded-lg">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-forest text-white">
                        <tr>
                            <th class="py-3 ps-4">Tipo Estimación</th>
                            <th class="py-3">Fórmula</th>
                            <th class="py-3">Cálculo (m³)</th>
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

                        <!-- Modal Ver Estimación - Nuevo -->
                        <div class="modal fade" id="viewEstimacionModal{{ $estimacion->id_estimacion }}" tabindex="-1" 
                             aria-labelledby="viewEstimacionLabel{{ $estimacion->id_estimacion }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-info text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-info-circle me-2"></i>Detalles de la Estimación
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" 
                                                data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                <p class="fw-bold">{{ number_format($estimacion->calculo, 4) }} m³</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Troza:</h6>
                                                <p class="fw-bold">
                                                    {{ $estimacion->troza->especie->nom_especie ?? 'N/A' }} / 
                                                    {{ $estimacion->troza->parcela->nom_parcela ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <h6 class="text-muted">Detalles Troza:</h6>
                                                <p class="fw-bold">
                                                    Diámetro: {{ $estimacion->troza->diametro }}m, 
                                                    Longitud: {{ $estimacion->troza->longitud }}m
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

                        <!-- Modal Editar Estimación - Mejorado -->
                        <div class="modal fade" id="editEstimacionModal{{ $estimacion->id_estimacion }}" tabindex="-1" 
                             aria-labelledby="editEstimacionLabel{{ $estimacion->id_estimacion }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-primary text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-edit me-2"></i>Editar Estimación
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" 
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form method="POST" action="{{ route('estimaciones.update', $estimacion->id_estimacion) }}" id="formEditEstimacion{{ $estimacion->id_estimacion }}">
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
                                                <select name="id_formula" class="form-select border-2" required id="formulaSelectEdit{{ $estimacion->id_estimacion }}">
                                                    @foreach ($formulas as $formula)
                                                    <option value="{{ $formula->id_formula }}" 
                                                            data-formula-nombre="{{ $formula->nom_formula }}"
                                                            {{ $formula->id_formula == $estimacion->id_formula ? 'selected' : '' }}>
                                                        {{ $formula->nom_formula }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Troza</label>
                                                <select name="id_troza" class="form-select border-2" required id="trozaSelectEdit{{ $estimacion->id_estimacion }}">
                                                    @foreach ($trozas as $troza)
                                                    <option value="{{ $troza->id_troza }}" 
                                                            data-diametro="{{ $troza->diametro }}"
                                                            data-diametro2="{{ $troza->diametro_otro_extremo ?? $troza->diametro }}"
                                                            data-diametro-medio="{{ $troza->diametro_medio ?? $troza->diametro }}"
                                                            data-longitud="{{ $troza->longitud }}"
                                                            {{ $troza->id_troza == $estimacion->id_troza ? 'selected' : '' }}>
                                                        {{ $troza->especie->nom_especie ?? 'N/A' }} ({{ $troza->parcela->nom_parcela ?? 'N/A' }})
                                                        - D: {{ $troza->diametro }}m, L: {{ $troza->longitud }}m
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="hidden" name="calculo" id="calculoHiddenEdit{{ $estimacion->id_estimacion }}">
                                            <div class="alert alert-info" id="resultadoEstimacionEdit{{ $estimacion->id_estimacion }}" style="display: none;">
                                                <strong>Nueva estimación:</strong> <span id="valorEstimacionEdit{{ $estimacion->id_estimacion }}"></span> m³
                                            </div>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                                <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                                        data-bs-dismiss="modal">Cancelar</button>
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

<!-- Modal Crear Estimación - Mejorado -->
<div class="modal fade" id="createEstimacionModal" tabindex="-1" aria-labelledby="createEstimacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Estimación
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('estimaciones.store') }}" id="formCreacionEstimacion">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted">Tipo de Estimación</label>
                        <select name="id_tipo_e" class="form-select border-2" required id="tipoEstimacionSelect">
                            @foreach ($tiposEstimacion as $tipo)
                            <option value="{{ $tipo->id_tipo_e }}">{{ $tipo->desc_estimacion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Fórmula</label>
                        <select name="id_formula" class="form-select border-2" required id="formulaSelect">
                            @foreach ($formulas as $formula)
                            <option value="{{ $formula->id_formula }}" data-formula-nombre="{{ $formula->nom_formula }}">
                                {{ $formula->nom_formula }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Troza</label>
                        <select name="id_troza" class="form-select border-2" required id="trozaSelect">
                            @foreach ($trozas as $troza)
                            <option value="{{ $troza->id_troza }}" 
                                    data-diametro="{{ $troza->diametro }}"
                                    data-diametro2="{{ $troza->diametro_otro_extremo ?? $troza->diametro }}"
                                    data-diametro-medio="{{ $troza->diametro_medio ?? $troza->diametro }}"
                                    data-longitud="{{ $troza->longitud }}">
                                {{ $troza->especie->nom_especie ?? 'N/A' }} ({{ $troza->parcela->nom_parcela ?? 'N/A' }})
                                - D: {{ $troza->diametro }}m, L: {{ $troza->longitud }}m
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="calculo" id="calculoHidden">
                    <div class="alert alert-info" id="resultadoEstimacion" style="display: none;">
                        <strong>Estimación calculada:</strong> <span id="valorEstimacion"></span> m³
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

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Funciones de cálculo
    function calcularHumber(diametro, longitud) {
        return (longitud * Math.pow(diametro, 2)) / (4 * Math.PI);
    }

    function calcularSmalian(diametro1, diametro2, longitud) {
        const area1 = (Math.PI * Math.pow(diametro1, 2)) / 4;
        const area2 = (Math.PI * Math.pow(diametro2, 2)) / 4;
        return ((area1 + area2) / 2) * longitud;
    }

    function calcularNewton(diametro1, diametroMedio, diametro2, longitud) {
        const area1 = (Math.PI * Math.pow(diametro1, 2)) / 4;
        const areaMedio = (Math.PI * Math.pow(diametroMedio, 2)) / 4;
        const area2 = (Math.PI * Math.pow(diametro2, 2)) / 4;
        return ((area1 + (4 * areaMedio) + area2) / 6) * longitud;
    }

    // Filtrado de fórmulas por tipo de estimación
    const tipoEstimacionSelect = document.getElementById('tipoEstimacionSelect');
    if (tipoEstimacionSelect) {
        tipoEstimacionSelect.addEventListener('change', function() {
            const tipoId = this.value;
            const formulaSelect = document.getElementById('formulaSelect');
            const form = this.closest('form');
            
            if (formulaSelect) {
                fetch(`/estimaciones/formulas-por-tipo/${tipoId}`)
                    .then(response => response.json())
                    .then(formulas => {
                        formulaSelect.innerHTML = '';
                        formulas.forEach(formula => {
                            const option = document.createElement('option');
                            option.value = formula.id_formula;
                            option.textContent = formula.nom_formula;
                            option.dataset.formulaNombre = formula.nom_formula;
                            formulaSelect.appendChild(option);
                        });
                        
                        // Disparar evento de cambio para recalcular
                        if (form) {
                            const event = new Event('change');
                            form.dispatchEvent(event);
                        }
                    });
            }
        });
    }

    // Configurar evento para el modal de creación
    const formCreacion = document.getElementById('formCreacionEstimacion');
    if (formCreacion) {
        formCreacion.addEventListener('change', function() {
            const trozaSelect = this.querySelector('select[name="id_troza"]');
            const formulaSelect = this.querySelector('select[name="id_formula"]');
            const tipoSelect = this.querySelector('select[name="id_tipo_e"]');
            
            if (trozaSelect && formulaSelect && tipoSelect) {
                const selectedTroza = trozaSelect.options[trozaSelect.selectedIndex];
                const selectedFormula = formulaSelect.options[formulaSelect.selectedIndex];
                
                if (selectedTroza && selectedFormula) {
                    const diametro = parseFloat(selectedTroza.dataset.diametro);
                    const diametro2 = parseFloat(selectedTroza.dataset.diametro2 || diametro);
                    const diametroMedio = parseFloat(selectedTroza.dataset.diametroMedio || diametro);
                    const longitud = parseFloat(selectedTroza.dataset.longitud);
                    const formulaNombre = selectedFormula.dataset.formulaNombre || selectedFormula.text;
                    
                    let resultado = null;
                    
                    if (formulaNombre.includes('HUMBER')) {
                        resultado = calcularHumber(diametro, longitud);
                    } else if (formulaNombre.includes('SMALIAN')) {
                        resultado = calcularSmalian(diametro, diametro2, longitud);
                    } else if (formulaNombre.includes('NEWTON')) {
                        resultado = calcularNewton(diametro, diametroMedio, diametro2, longitud);
                    }
                    
                    if (resultado !== null) {
                        const resultadoElement = this.querySelector('#valorEstimacion');
                        const hiddenElement = this.querySelector('input[name="calculo"]');
                        const alertElement = this.querySelector('#resultadoEstimacion');
                        
                        if (resultadoElement) resultadoElement.textContent = resultado.toFixed(4);
                        if (hiddenElement) hiddenElement.value = resultado;
                        if (alertElement) alertElement.style.display = 'block';
                    }
                }
            }
        });
    }

    // Configurar eventos para los modales de edición
    @foreach ($estimaciones as $estimacion)
        const formEdit{{ $estimacion->id_estimacion }} = document.getElementById('formEditEstimacion{{ $estimacion->id_estimacion }}');
        if (formEdit{{ $estimacion->id_estimacion }}) {
            formEdit{{ $estimacion->id_estimacion }}.addEventListener('change', function() {
                const trozaSelect = this.querySelector('select[name="id_troza"]');
                const formulaSelect = this.querySelector('select[name="id_formula"]');
                
                if (trozaSelect && formulaSelect) {
                    const selectedTroza = trozaSelect.options[trozaSelect.selectedIndex];
                    const selectedFormula = formulaSelect.options[formulaSelect.selectedIndex];
                    
                    if (selectedTroza && selectedFormula) {
                        const diametro = parseFloat(selectedTroza.dataset.diametro);
                        const diametro2 = parseFloat(selectedTroza.dataset.diametro2 || diametro);
                        const diametroMedio = parseFloat(selectedTroza.dataset.diametroMedio || diametro);
                        const longitud = parseFloat(selectedTroza.dataset.longitud);
                        const formulaNombre = selectedFormula.dataset.formulaNombre || selectedFormula.text;
                        
                        let resultado = null;
                        
                        if (formulaNombre.includes('HUMBER')) {
                            resultado = calcularHumber(diametro, longitud);
                        } else if (formulaNombre.includes('SMALIAN')) {
                            resultado = calcularSmalian(diametro, diametro2, longitud);
                        } else if (formulaNombre.includes('NEWTON')) {
                            resultado = calcularNewton(diametro, diametroMedio, diametro2, longitud);
                        }
                        
                        if (resultado !== null) {
                            const resultadoElement = this.querySelector('#valorEstimacionEdit{{ $estimacion->id_estimacion }}');
                            const hiddenElement = this.querySelector('input[name="calculo"]');
                            const alertElement = this.querySelector('#resultadoEstimacionEdit{{ $estimacion->id_estimacion }}');
                            
                            if (resultadoElement) resultadoElement.textContent = resultado.toFixed(4);
                            if (hiddenElement) hiddenElement.value = resultado;
                            if (alertElement) alertElement.style.display = 'block';
                        }
                    }
                }
            });
        }
    @endforeach

    // Función para confirmar eliminación
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

    // Solución para el problema de modales que se traban
    $(document).ready(function() {
        $('.modal').on('show.bs.modal', function (e) {
            $('body').addClass('modal-open');
        });

        $('.modal').on('hidden.bs.modal', function (e) {
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        });
    });
});

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
    
    .icon-sm {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
    }
</style>