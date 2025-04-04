@extends('dashboard')

@section('template_title', 'Gestión de Estimaciones')

@section('crud_content')
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center bg-forest text-white">
            <h5 class="mb-0">Listado de Estimaciones</h5>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createEstimacionModal">Nueva Estimación</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="bg-forest text-white">
                        <tr>
                            <th>Tipo Estimación</th>
                            <th>Fórmula</th>
                            <th>Cálculo</th>
                            <th>Troza (Especie/Parcela)</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estimaciones as $estimacion)
                        <tr>
                            <td>{{ $estimacion->tipoEstimacion->desc_estimacion }}</td>
                            <td>{{ $estimacion->formula->nom_formula }}</td>
                            <td>{{ $estimacion->calculo }}</td>
                            <td>
                                {{ $estimacion->troza->especie->nom_especie ?? 'N/A' }} /
                                {{ $estimacion->troza->parcela->nom_parcela ?? 'N/A' }}
                            </td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editEstimacionModal{{ $estimacion->id_estimacion }}">Editar</button>

                                <form action="{{ route('estimaciones.destroy', $estimacion->id_estimacion) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta estimación?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

                        <div class="modal fade" id="editEstimacionModal{{ $estimacion->id_estimacion }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-forest text-white">
                                        <h5 class="modal-title">Editar Estimación</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('estimaciones.update', $estimacion->id_estimacion) }}" id="formEditEstimacion{{ $estimacion->id_estimacion }}">
                                            @csrf @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label">Tipo de Estimación</label>
                                                <select name="id_tipo_e" class="form-control" required>
                                                    @foreach ($tiposEstimacion as $tipo)
                                                    <option value="{{ $tipo->id_tipo_e }}" {{ $tipo->id_tipo_e == $estimacion->id_tipo_e ? 'selected' : '' }}>
                                                        {{ $tipo->desc_estimacion }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Fórmula</label>
                                                <select name="id_formula" class="form-control" required id="formulaSelectEdit{{ $estimacion->id_estimacion }}">
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
                                                <label class="form-label">Troza</label>
                                                <select name="id_troza" class="form-control" required id="trozaSelectEdit{{ $estimacion->id_estimacion }}">
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
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

<div class="modal fade" id="createEstimacionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-forest text-white">
                <h5 class="modal-title">Crear Estimación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('estimaciones.store') }}" id="formCreacionEstimacion">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tipo de Estimación</label>
                        <select name="id_tipo_e" class="form-control" required id="tipoEstimacionSelect">
                            @foreach ($tiposEstimacion as $tipo)
                            <option value="{{ $tipo->id_tipo_e }}">{{ $tipo->desc_estimacion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fórmula</label>
                        <select name="id_formula" class="form-control" required id="formulaSelect">
                            @foreach ($formulas as $formula)
                            <option value="{{ $formula->id_formula }}" data-formula-nombre="{{ $formula->nom_formula }}">
                                {{ $formula->nom_formula }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Troza</label>
                        <select name="id_troza" class="form-control" required id="trozaSelect">
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
                    <button type="submit" class="btn btn-success">Crear Estimación</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
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
    });
</script>
