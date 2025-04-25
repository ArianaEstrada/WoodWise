@extends('dashboard')

@section('template_title', 'Gestión de Estimaciones')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header Mejorado -->
        <div class="card-header bg-gradient-forest text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-calculator fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold text-white">Listado de Estimaciones</h5>
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
                                    @switch($estimacion->tipoEstimacion->desc_estimacion)
                                        @case('Volumen Maderable') m³ @break
                                        @case('Carbono') kg CO₂ @break
                                        @case('Biomasa') kg @break
                                        @case('Área Basal') m² @break
                                    @endswitch
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
                                                <p class="fw-bold">{{ number_format($estimacion->calculo, 4) }} 
                                                    @switch($estimacion->tipoEstimacion->desc_estimacion)
                                                        @case('Volumen Maderable') m³ @break
                                                        @case('Carbono') kg CO₂ @break
                                                        @case('Biomasa') kg @break
                                                        @case('Área Basal') m² @break
                                                    @endswitch
                                                </p>
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
                                                    @if($estimacion->formula->nom_formula === 'Formula de SMALIAN' || $estimacion->formula->nom_formula === 'Formula de NEWTON')
                                                        <br>Diámetro otro extremo: {{ $estimacion->troza->diametro_otro_extremo ?? 'N/A' }}m
                                                    @endif
                                                    @if($estimacion->formula->nom_formula === 'Formula de NEWTON')
                                                        <br>Diámetro medio: {{ $estimacion->troza->diametro_medio ?? 'N/A' }}m
                                                    @endif
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

                        <!-- Modal Editar Estimación -->
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
                                                            data-diametro2="{{ $troza->diametro_otro_extremo ?? null }}"
                                                            data-diametro-medio="{{ $troza->diametro_medio ?? null }}"
                                                            data-longitud="{{ $troza->longitud }}"
                                                            {{ $troza->id_troza == $estimacion->id_troza ? 'selected' : '' }}>
                                                        {{ $troza->especie->nom_especie ?? 'N/A' }} ({{ $troza->parcela->nom_parcela ?? 'N/A' }})
                                                        - D: {{ $troza->diametro }}m, L: {{ $troza->longitud }}m
                                                        @if($troza->diametro_otro_extremo) - D2: {{ $troza->diametro_otro_extremo }}m @endif
                                                        @if($troza->diametro_medio) - DM: {{ $troza->diametro_medio }}m @endif
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <!-- Contenedor para mensajes de validación -->
                                            <div id="messages-container-edit{{ $estimacion->id_estimacion }}"></div>
                                            
                                            <input type="hidden" name="calculo" id="calculoHiddenEdit{{ $estimacion->id_estimacion }}">
                                            <div class="alert alert-info" id="resultadoEstimacionEdit{{ $estimacion->id_estimacion }}" style="display: none;">
                                                <strong>Nueva estimación:</strong> <span id="valorEstimacionEdit{{ $estimacion->id_estimacion }}"></span>
                                                @switch($estimacion->tipoEstimacion->desc_estimacion)
                                                    @case('Volumen Maderable') m³ @break
                                                    @case('Carbono') kg CO₂ @break
                                                    @case('Biomasa') kg @break
                                                    @case('Área Basal') m² @break
                                                @endswitch
                                            </div>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                                <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary rounded-pill" id="submitEdit{{ $estimacion->id_estimacion }}">
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
                                    data-diametro2="{{ $troza->diametro_otro_extremo ?? null }}"
                                    data-diametro-medio="{{ $troza->diametro_medio ?? null }}"
                                    data-longitud="{{ $troza->longitud }}">
                                {{ $troza->especie->nom_especie ?? 'N/A' }} ({{ $troza->parcela->nom_parcela ?? 'N/A' }})
                                - D: {{ $troza->diametro }}m, L: {{ $troza->longitud }}m
                                @if($troza->diametro_otro_extremo) - D2: {{ $troza->diametro_otro_extremo }}m @endif
                                @if($troza->diametro_medio) - DM: {{ $troza->diametro_medio }}m @endif
                            </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Contenedor para mensajes de validación -->
                    <div id="messages-container"></div>
                    
                    <input type="hidden" name="calculo" id="calculoHidden">
                    <div class="alert alert-info" id="resultadoEstimacion" style="display: none;">
                        <strong>Estimación calculada:</strong> <span id="valorEstimacion"></span>
                        <span id="unidadMedida"></span>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill" id="submitButton">
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
    // =============================================
    // FUNCIONES DE CÁLCULO
    // =============================================
    
    /**
     * Calcula el volumen usando la fórmula de Humber
     */
    function calcularHumber(diametro, longitud) {
        return (longitud * Math.pow(diametro, 2)) / (4 * Math.PI);
    }

    /**
     * Calcula el volumen usando la fórmula de Smalian
     */
    function calcularSmalian(diametro1, diametro2, longitud) {
        const area1 = (Math.PI * Math.pow(diametro1, 2)) / 4;
        const area2 = (Math.PI * Math.pow(diametro2, 2)) / 4;
        return ((area1 + area2) / 2) * longitud;
    }

    /**
     * Calcula el volumen usando la fórmula de Newton
     */
    function calcularNewton(diametro1, diametroMedio, diametro2, longitud) {
        const area1 = (Math.PI * Math.pow(diametro1, 2)) / 4;
        const areaMedio = (Math.PI * Math.pow(diametroMedio, 2)) / 4;
        const area2 = (Math.PI * Math.pow(diametro2, 2)) / 4;
        return ((area1 + (4 * areaMedio) + area2) / 6) * longitud;
    }

    /**
     * Obtiene la unidad de medida según el tipo de estimación
     */
    function getUnidadMedida(tipoEstimacion) {
        switch(tipoEstimacion) {
            case 'Volumen Maderable': return 'm³';
            case 'Carbono': return 'kg CO₂';
            case 'Biomasa': return 'kg';
            case 'Área Basal': return 'm²';
            default: return '';
        }
    }

    // =============================================
    // VALIDACIÓN DE CAMPOS OPCIONALES
    // =============================================
    
    /**
     * Valida que la troza tenga los campos requeridos para la fórmula seleccionada
     */
    function validarCamposTroza(formulaNombre, trozaData, containerId) {
        const container = document.getElementById(containerId);
        if (!container) return true;
        
        // Limpiar mensajes anteriores
        container.innerHTML = '';
        
        let missingFields = [];
        let isValid = true;
        
        // Validar según fórmula
        if (formulaNombre.includes('SMALIAN') && (!trozaData.diametro2 || trozaData.diametro2 === 'null')) {
            missingFields.push('diámetro del otro extremo');
            isValid = false;
        }
        
        if (formulaNombre.includes('NEWTON')) {
            if (!trozaData.diametro2 || trozaData.diametro2 === 'null') {
                missingFields.push('diámetro del otro extremo');
                isValid = false;
            }
            if (!trozaData.diametroMedio || trozaData.diametroMedio === 'null') {
                missingFields.push('diámetro medio');
                isValid = false;
            }
        }
        
        // Mostrar advertencia si faltan campos
        if (missingFields.length > 0) {
            const alert = document.createElement('div');
            alert.className = 'alert alert-warning mt-3';
            alert.innerHTML = `
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>¡Atención!</strong> La fórmula seleccionada requiere: 
                ${missingFields.join(' y ')}.
                <div class="mt-2">
                    <a href="/trozas/${trozaData.id}/edit" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-edit me-1"></i>Editar troza
                    </a>
                </div>
            `;
            container.appendChild(alert);
        }
        
        return isValid;
    }

    // =============================================
    // FILTRADO DE FÓRMULAS POR TIPO DE ESTIMACIÓN
    // =============================================

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
                        
                        if (form) {
                            form.dispatchEvent(new Event('change'));
                        }
                    })
                    .catch(error => console.error('Error al cargar fórmulas:', error));
            }
        });
        
        // Inicializar al cargar
        tipoEstimacionSelect.dispatchEvent(new Event('change'));
    }

    // =============================================
    // CONFIGURACIÓN DEL MODAL DE CREACIÓN
    // =============================================

    const formCreacion = document.getElementById('formCreacionEstimacion');
    if (formCreacion) {
        formCreacion.addEventListener('change', function() {
            const trozaSelect = this.querySelector('select[name="id_troza"]');
            const formulaSelect = this.querySelector('select[name="id_formula"]');
            const tipoSelect = this.querySelector('select[name="id_tipo_e"]');
            const submitButton = this.querySelector('#submitButton');
            const unidadMedidaElement = this.querySelector('#unidadMedida');
            
            if (trozaSelect && formulaSelect && tipoSelect) {
                const selectedTroza = trozaSelect.options[trozaSelect.selectedIndex];
                const selectedFormula = formulaSelect.options[formulaSelect.selectedIndex];
                const selectedTipo = tipoSelect.options[tipoSelect.selectedIndex];
                
                if (selectedTroza && selectedFormula && selectedTipo) {
                    // Obtener datos de la troza
                    const trozaData = {
                        id: selectedTroza.value,
                        diametro: selectedTroza.dataset.diametro,
                        diametro2: selectedTroza.dataset.diametro2,
                        diametroMedio: selectedTroza.dataset.diametroMedio,
                        longitud: selectedTroza.dataset.longitud
                    };
                    
                    const formulaNombre = selectedFormula.dataset.formulaNombre || selectedFormula.text;
                    const tipoEstimacion = selectedTipo.text;
                    
                    // Actualizar unidad de medida
                    if (unidadMedidaElement) {
                        unidadMedidaElement.textContent = getUnidadMedida(tipoEstimacion);
                    }
                    
                    // Validar campos requeridos
                    const isValid = validarCamposTroza(formulaNombre, trozaData, 'messages-container');
                    
                    // Habilitar/deshabilitar botón de enviar
                    if (submitButton) {
                        submitButton.disabled = !isValid;
                    }
                    
                    // Solo calcular si la validación es exitosa
                    if (isValid) {
                        const diametro = parseFloat(trozaData.diametro);
                        const diametro2 = parseFloat(trozaData.diametro2 || trozaData.diametro);
                        const diametroMedio = parseFloat(trozaData.diametroMedio || trozaData.diametro);
                        const longitud = parseFloat(trozaData.longitud);
                        
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
            }
        });
        
        // Disparar evento inicial
        formCreacion.dispatchEvent(new Event('change'));
    }

    // =============================================
    // CONFIGURACIÓN DE MODALES DE EDICIÓN
    // =============================================

    @foreach ($estimaciones as $estimacion)
        const formEdit{{ $estimacion->id_estimacion }} = document.getElementById('formEditEstimacion{{ $estimacion->id_estimacion }}');
        if (formEdit{{ $estimacion->id_estimacion }}) {
            formEdit{{ $estimacion->id_estimacion }}.addEventListener('change', function() {
                const trozaSelect = this.querySelector('select[name="id_troza"]');
                const formulaSelect = this.querySelector('select[name="id_formula"]');
                const tipoSelect = this.querySelector('select[name="id_tipo_e"]');
                const submitButton = this.querySelector('#submitEdit{{ $estimacion->id_estimacion }}');
                
                if (trozaSelect && formulaSelect && tipoSelect) {
                    const selectedTroza = trozaSelect.options[trozaSelect.selectedIndex];
                    const selectedFormula = formulaSelect.options[formulaSelect.selectedIndex];
                    const selectedTipo = tipoSelect.options[tipoSelect.selectedIndex];
                    
                    if (selectedTroza && selectedFormula && selectedTipo) {
                        const trozaData = {
                            id: selectedTroza.value,
                            diametro: selectedTroza.dataset.diametro,
                            diametro2: selectedTroza.dataset.diametro2,
                            diametroMedio: selectedTroza.dataset.diametroMedio,
                            longitud: selectedTroza.dataset.longitud
                        };
                        
                        const formulaNombre = selectedFormula.dataset.formulaNombre || selectedFormula.text;
                        const tipoEstimacion = selectedTipo.text;
                        
                        // Validar campos requeridos
                        const isValid = validarCamposTroza(
                            formulaNombre, 
                            trozaData, 
                            'messages-container-edit{{ $estimacion->id_estimacion }}'
                        );
                        
                        // Habilitar/deshabilitar botón de enviar
                        if (submitButton) {
                            submitButton.disabled = !isValid;
                        }
                        
                        // Solo calcular si la validación es exitosa
                        if (isValid) {
                            const diametro = parseFloat(trozaData.diametro);
                            const diametro2 = parseFloat(trozaData.diametro2 || trozaData.diametro);
                            const diametroMedio = parseFloat(trozaData.diametroMedio || trozaData.diametro);
                            const longitud = parseFloat(trozaData.longitud);
                            
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
                }
            });
            
            // Configurar evento para cuando se abre el modal
            $('#editEstimacionModal{{ $estimacion->id_estimacion }}').on('show.bs.modal', function () {
                formEdit{{ $estimacion->id_estimacion }}.dispatchEvent(new Event('change'));
                const tipoSelect = formEdit{{ $estimacion->id_estimacion }}.querySelector('select[name="id_tipo_e"]');
                if (tipoSelect) {
                    tipoSelect.dispatchEvent(new Event('change'));
                }
            });
        }
    @endforeach

    // =============================================
    // FUNCIÓN PARA CONFIRMAR ELIMINACIÓN
    // =============================================

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

    // =============================================
    // MANEJO DE MODALES
    // =============================================

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

// =============================================
// NOTIFICACIONES
// =============================================

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
    
    /* Estilos para los mensajes de validación */
    .alert-troza {
        border-left: 4px solid #ffc107;
    }
</style>