@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Tarjeta Principal -->
    <div class="wood-card wood-shadow-lg">
        <!-- Encabezado Elegante -->
        <div class="wood-card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="text-white mb-1">
                        <i class="fas fa-map-marked-alt me-2"></i>Parcela: {{ $parcela->nom_parcela }}
                    </h2>
                    <p class="text-white opacity-8 mb-0">Gestión detallada de recursos forestales</p>
                </div>
                <a href="{{ route('tecnico.dashboard') }}" class="btn btn-wood-light rounded-pill">
                    <i class="fas fa-arrow-left me-1"></i> Regresar
                </a>
            </div>
        </div>
        
        <div class="row mb-5 g-4">
    <!-- Tarjeta de Ubicación -->
    <div class="col-md-4">
        <div class="wood-info-card wood-card-hover">
            <div class="card-body text-center p-4">
                <div class="wood-icon-wrapper bg-wood-light-20 mb-4">
                    <i class="fas fa-map-marker-alt wood-icon text-wood-medium"></i>
                </div>
                <h5 class="wood-card-title mb-3">Ubicación</h5>
                <p class="wood-card-text">{{ $parcela->ubicacion }}</p>
                <div class="wood-card-decoration"></div>
            </div>
        </div>
    </div>
    
    <!-- Tarjeta de Área -->
    <div class="col-md-4">
        <div class="wood-info-card wood-card-hover">
            <div class="card-body text-center p-4">
                <div class="wood-icon-wrapper bg-wood-medium-20 mb-4">
                    <i class="fas fa-ruler-combined wood-icon text-wood-medium"></i>
                </div>
                <h5 class="wood-card-title mb-3">Área</h5>
                <p class="wood-card-text">{{ $parcela->area }} <span class="wood-unit">hectáreas</span></p>
                <div class="wood-card-decoration"></div>
            </div>
        </div>
    </div>
    
    <!-- Tarjeta de Trozas -->
    <div class="col-md-4">
        <div class="wood-info-card wood-card-hover">
            <div class="card-body text-center p-4">
                <div class="wood-icon-wrapper bg-wood-accent-20 mb-4">
                    <i class="fas fa-tree wood-icon text-wood-accent"></i>
                </div>
                <h5 class="wood-card-title mb-3">Trozas</h5>
                <p class="wood-card-text">{{ $parcela->trozas->count() }} <span class="wood-unit">registradas</span></p>
                <div class="wood-card-decoration"></div>
            </div>
        </div>
    </div>
</div>
            <!-- Pestañas Mejoradas -->
          <ul class="nav nav-tabs wood-tabs mb-4 text-black" id="parcelaTabs" role="tablist">
    <li class="nav-item text-black" role="presentation">
        <button class="nav-link active wood-tab-btn text-black" id="trozas-tab" data-bs-toggle="tab" data-bs-target="#trozas" type="button" role="tab" aria-controls="trozas" aria-selected="true">
            <i class="fas fa-tree me-2 text-black wood-card-title">Trozas</i>  
            <span class="wood-badge ms-2">{{ $parcela->trozas->count() }}</span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link wood-tab-btn" id="estimaciones-tab" data-bs-toggle="tab" data-bs-target="#estimaciones" type="button" role="tab" aria-controls="estimaciones" aria-selected="false">
            <i class="fas fa-calculator me-2 wood-card-title">Estimaciones</i>  
            <span class="wood-badge wood-badge-secondary ms-2">{{ $parcela->estimaciones->count() }}</span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link wood-tab-btn" id="turnos-tab" data-bs-toggle="tab" data-bs-target="#turnos" type="button" role="tab" aria-controls="turnos" aria-selected="false">
            <i class="fas fa-calendar-alt me-2 wood-card-title">Turnos</i>  
            <span class="wood-badge wood-badge-dark ms-2">{{ $parcela->turnosCorta->count() }}</span>
        </button>
    </li>
</ul>

            <!-- Contenido de Pestañas -->
            <div class="tab-content wood-tab-content pt-4" id="parcelaTabsContent">
                <!-- Pestaña de Trozas -->
                <div class="tab-pane fade show active" id="trozas" role="tabpanel">
                    @if($parcela->trozas->count() > 0)
                    <div class="table-responsive">
                        <table class="wood-table">
                            <thead>
                                <tr>
                                    <th class="ps-4">ID</th>
                                    <th>Especie</th>
                                    <th>Medidas</th>
                                    <th>Volumen</th>
                                    <th>Densidad</th>
                                    <th class="text-end pe-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parcela->trozas as $troza)
                                <tr>
                                    <td class="ps-4">{{ $troza->id_troza }}</td>
                                    <td>
                                        <span class="text-forest-dark">{{ $troza->especie->nom_cientifico }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ number_format($troza->longitud, 2) }}m × {{ number_format($troza->diametro, 2) }}cm</span>
                                    </td>
                                    <td>
                                        <span class="text-forest-accent">
                                            {{ $troza->estimacion ? number_format($troza->estimacion->calculo, 4) : 'Sin cálculo' }} m³
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ number_format($troza->densidad, 2) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex flex-wrap gap-2 justify-content-end">
                                            <!-- Botón Detalles -->
                                            <button class="btn btn-wood-action btn-view" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#trozaModal{{ $troza->id_troza }}">
                                                <i class="fas fa-eye me-1"></i> Detalles
                                            </button>
                                            
                                            <!-- Botón Editar -->
                                            <button class="btn btn-wood-action btn-edit"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editTrozaModal{{ $troza->id_troza }}">
                                                <i class="fas fa-edit me-1"></i> Editar
                                            </button>
                                            
                                            <!-- Botón Eliminar -->
                                            <form action="{{ route('trozas.destroy', $troza->id_troza) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-wood-action btn-delete" 
                                                        onclick="return confirm('¿Estás seguro de eliminar esta troza?')">
                                                    <i class="fas fa-trash me-1"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-tree fa-4x text-forest-light mb-4"></i>
                        <h5 class="text-forest-medium mb-3">No hay trozas registradas</h5>
                        <button class="btn btn-wood rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addTrozaModal">
                            <i class="fas fa-plus me-2"></i> Agregar Troza
                        </button>
                    </div>
                    @endif
                </div>

                <!-- Pestaña de Estimaciones -->
                <div class="tab-pane fade" id="estimaciones" role="tabpanel">
                    @if($parcela->estimaciones->count() > 0)
                    <div class="table-responsive">
                        <table class="wood-table">
                            <thead>
                                <tr>
                                    <th class="ps-4">ID</th>
                                    <th>Tipo</th>
                                    <th>Fórmula</th>
                                    <th>Troza</th>
                                    <th>Resultado</th>
                                    <th class="text-end pe-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parcela->estimaciones as $estimacion)
                                <tr>
                                    <td class="ps-4">{{ $estimacion->id_estimacion }}</td>
                                    <td>{{ $estimacion->tipoEstimacion->desc_estimacion }}</td>
                                    <td>{{ $estimacion->formula->nom_formula }}</td>
                                    <td>#{{ $estimacion->troza->id_troza }}</td>
                                    <td class="text-forest-accent">{{ number_format($estimacion->calculo, 4) }} m³</td>
                                    <td class="text-end">
                                        <div class="d-flex flex-wrap gap-2 justify-content-end">
                                            <!-- Botón Detalles -->
                                            <button class="btn btn-wood-action btn-view" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#estimacionModal{{ $estimacion->id_estimacion }}">
                                                <i class="fas fa-eye me-1"></i> Detalles
                                            </button>
                                            
                                            <!-- Botón Editar -->
                                            <button class="btn btn-wood-action btn-edit"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editEstimacionModal{{ $estimacion->id_estimacion }}">
                                                <i class="fas fa-edit me-1"></i> Editar
                                            </button>
                                            
                                            <!-- Botón Eliminar -->
                                            <form action="{{ route('estimaciones.destroy', $estimacion->id_estimacion) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-wood-action btn-delete" 
                                                        onclick="return confirm('¿Estás seguro de eliminar esta estimación?')">
                                                    <i class="fas fa-trash me-1"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-calculator fa-4x text-forest-light mb-4"></i>
                        <h5 class="text-forest-medium mb-3">No hay estimaciones registradas</h5>
                    </div>
                    @endif
                </div>

                <!-- Pestaña de Turnos de Corta -->
                <div class="tab-pane fade" id="turnos" role="tabpanel">
                    @if($parcela->turnosCorta->count() > 0)
                    <div class="table-responsive">
                        <table class="wood-table">
                            <thead>
                                <tr>
                                    <th class="ps-4">Código</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th class="text-end pe-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parcela->turnosCorta as $turno)
                                <tr>
                                    <td class="ps-4">{{ $turno->codigo_corta }}</td>
                                    <td>{{ \Carbon\Carbon::parse($turno->fecha_corta)->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $turno->completado ? 'forest-accent' : 'forest-medium' }}">
                                            {{ $turno->completado ? 'Completado' : 'Pendiente' }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end">
                                            <!-- Botón Detalles -->
                                            <button class="btn btn-wood-action btn-view" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#turnoModal{{ $turno->id_turno }}">
                                                <i class="fas fa-eye me-1"></i> Detalles
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-calendar-alt fa-4x text-forest-light mb-4"></i>
                        <h5 class="text-forest-medium mb-3">No hay turnos programados</h5>
                        <button class="btn btn-wood rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addTurnoModal">
                            <i class="fas fa-plus me-2"></i> Programar Turno
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modales para detalles -->
@foreach($parcela->trozas as $troza)
<div class="modal fade wood-detail-modal" id="trozaModal{{ $troza->id_troza }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content wood-detail-card">
            <div class="modal-header wood-detail-header wood-bg-primary">
                <div class="d-flex align-items-center w-100">
                    <div class="wood-detail-icon">
                        <i class="fas fa-tree"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="wood-detail-title mb-0">  Detalles de Troza</h5>
                        <p class="wood-detail-subtitle mb-0">#{{ $troza->id_troza }} - {{ $troza->especie->nom_cientifico }}</p>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="wood-detail-section">
                            <h6 class="wood-detail-section-title">
                                <i class="fas fa-ruler-combined me-2"></i>Medidas Principales
                            </h6>
                            <div class="wood-detail-list">
                                <div class="wood-detail-item">
                                    <span class="wood-detail-label">Longitud:</span>
                                    <span class="wood-detail-value">{{ $troza->longitud }} m</span>
                                </div>
                                <div class="wood-detail-item">
                                    <span class="wood-detail-label">Diámetro:</span>
                                    <span class="wood-detail-value">{{ $troza->diametro }} cm</span>
                                </div>
                                <div class="wood-detail-item">
                                    <span class="wood-detail-label">Densidad:</span>
                                    <span class="wood-detail-value">{{ $troza->densidad }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="wood-detail-section">
                            <h6 class="wood-detail-section-title">
                                <i class="fas fa-calculator me-2"></i>Cálculos
                            </h6>
                            <div class="wood-detail-list">
                                <div class="wood-detail-item">
                                    <span class="wood-detail-label">Volumen estimado:</span>
                                    <span class="wood-detail-value wood-highlight">
                                        {{ $troza->estimacion ? number_format($troza->estimacion->calculo, 4) : 'Sin cálculo' }} m³
                                    </span>
                                </div>
                                <div class="wood-detail-item">
                                    <span class="wood-detail-label">Fecha registro:</span>
                                    <span class="wood-detail-value">{{ $troza->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="wood-detail-footer mt-4 pt-3 border-top">
                    <button type="button" class="btn btn-wood-outline" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach($parcela->estimaciones as $estimacion)
<div class="modal fade wood-detail-modal" id="estimacionModal{{ $estimacion->id_estimacion }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content wood-detail-card">
            <div class="modal-header wood-detail-header wood-bg-info">
                <div class="d-flex align-items-center w-100">
                    <div class="wood-detail-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="wood-detail-title mb-0">Detalles de Estimación</h5>
                        <p class="wood-detail-subtitle mb-0">#{{ $estimacion->id_estimacion }} - {{ $estimacion->tipoEstimacion->desc_estimacion }}</p>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="wood-detail-section">
                            <h6 class="wood-detail-section-title">
                                <i class="fas fa-info-circle me-2"></i>Información Básica
                            </h6>
                            <div class="wood-detail-list">
                                <div class="wood-detail-item">
                                    <span class="wood-detail-label">Tipo:</span>
                                    <span class="wood-detail-value">{{ $estimacion->tipoEstimacion->desc_estimacion }}</span>
                                </div>
                                <div class="wood-detail-item">
                                    <span class="wood-detail-label">Fórmula:</span>
                                    <span class="wood-detail-value">{{ $estimacion->formula->nom_formula }}</span>
                                </div>
                                <div class="wood-detail-item">
                                    <span class="wood-detail-label">Troza asociada:</span>
                                    <span class="wood-detail-value">#{{ $estimacion->troza->id_troza }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="wood-detail-section">
                            <h6 class="wood-detail-section-title">
                                <i class="fas fa-chart-line me-2"></i>Resultados
                            </h6>
                            <div class="wood-detail-list">
                                <div class="wood-detail-item">
                                    <span class="wood-detail-label">Volumen calculado:</span>
                                    <span class="wood-detail-value wood-highlight">
                                        {{ number_format($estimacion->calculo, 4) }} m³
                                    </span>
                                </div>
                                <div class="wood-detail-item">
                                    <span class="wood-detail-label">Fecha cálculo:</span>
                                    <span class="wood-detail-value">{{ $estimacion->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="wood-detail-footer mt-4 pt-3 border-top">
                    <button type="button" class="btn btn-wood-outline me-2" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach($parcela->turnosCorta as $turno)
<div class="modal fade wood-detail-modal" id="turnoModal{{ $turno->id_turno }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content wood-detail-card">
            <div class="modal-header wood-detail-header wood-bg-warning">
                <div class="d-flex align-items-center w-100">
                    <div class="wood-detail-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="wood-detail-title mb-0">Turno de Corta</h5>
                        <p class="wood-detail-subtitle mb-0">{{ $turno->codigo_corta }}</p>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-4">
                <div class="wood-detail-section">
                    <h6 class="wood-detail-section-title">
                        <i class="fas fa-info-circle me-2"></i>Información del Turno
                    </h6>
                    <div class="wood-detail-list">
                        <div class="wood-detail-item">
                            <span class="wood-detail-label">Parcela:</span>
                            <span class="wood-detail-value">{{ $parcela->nom_parcela }}</span>
                        </div>
                        <div class="wood-detail-item">
                            <span class="wood-detail-label">Fecha programada:</span>
                            <span class="wood-detail-value">{{ $turno->fecha_corta->format('d/m/Y') }}</span>
                        </div>
                        <div class="wood-detail-item">
                            <span class="wood-detail-label">Estado:</span>
                            <span class="wood-detail-badge {{ $turno->completado ? 'wood-badge-success' : 'wood-badge-warning' }}">
                                {{ $turno->completado ? 'Completado' : 'Pendiente' }}
                            </span>
                        </div>
                        @if($turno->notas)
                        <div class="wood-detail-item">
                            <span class="wood-detail-label">Notas:</span>
                            <span class="wood-detail-value">{{ $turno->notas }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="wood-detail-footer mt-4 pt-3 border-top">
                    <button type="button" class="btn btn-wood-outline" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@foreach($parcela->estimaciones as $estimacion)
<div class="modal fade wood-edit-modal" id="editEstimacionModal{{ $estimacion->id_estimacion }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content wood-edit-card">
            <div class="modal-header wood-edit-header wood-bg-primary">
                <div class="d-flex align-items-center w-100">
                    <div class="wood-edit-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="wood-edit-title mb-0">Editar Estimación</h5>
                        <p class="wood-edit-subtitle mb-0">#{{ $estimacion->id_estimacion }}</p>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('gestion.estimaciones.update', $estimacion->id_estimacion) }}">
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" name="id_parcela" value="{{ $parcela->id_parcela }}">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="wood-form-group">
                                <label class="wood-form-label">Tipo de Estimación</label>
                                <select name="id_tipo_e" class="wood-form-select" required>
                                    @foreach ($tiposEstimacion as $tipo)
                                    <option value="{{ $tipo->id_tipo_e }}" {{ $tipo->id_tipo_e == $estimacion->id_tipo_e ? 'selected' : '' }}>
                                        {{ $tipo->desc_estimacion }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="wood-form-group">
                                <label class="wood-form-label">Fórmula</label>
                                <select name="id_formula" class="wood-form-select" required>
                                    @foreach ($formulas as $formula)
                                    <option value="{{ $formula->id_formula }}" {{ $formula->id_formula == $estimacion->id_formula ? 'selected' : '' }}>
                                        {{ $formula->nom_formula }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="wood-form-group">
                                <label class="wood-form-label">Troza</label>
                                <select name="id_troza" class="wood-form-select" required>
                                    @foreach ($parcela->trozas as $troza)
                                    <option value="{{ $troza->id_troza }}" {{ $troza->id_troza == $estimacion->id_troza ? 'selected' : '' }}>
                                        Troza #{{ $troza->id_troza }} ({{ $troza->especie->nom_cientifico }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="wood-form-group">
                                <label class="wood-form-label">Cálculo (m³)</label>
                                <input type="number" step="0.0001" class="wood-form-control"
                                       name="calculo" value="{{ old('calculo', $estimacion->calculo) }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="wood-edit-footer mt-4">
                        <button type="button" class="btn btn-wood-outline me-2" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-wood-primary">
                            <i class="fas fa-save me-2"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@foreach($parcela->trozas as $troza)
<div class="modal fade wood-edit-modal" id="editTrozaModal{{ $troza->id_troza }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content wood-edit-card">
            <div class="modal-header wood-edit-header wood-bg-primary">
                <div class="d-flex align-items-center w-100">
                    <div class="wood-edit-icon">
                        <i class="fas fa-tree"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="wood-edit-title mb-0">Editar Troza</h5>
                        <p class="wood-edit-subtitle mb-0">#{{ $troza->id_troza }}</p>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('gestion.trozas.update', $troza->id_troza) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_parcela" value="{{ $parcela->id_parcela }}">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="wood-form-group">
                                <label class="wood-form-label">Longitud (m)</label>
                                <input type="number" step="0.01" class="wood-form-control"
                                       name="longitud" value="{{ $troza->longitud }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="wood-form-group">
                                <label class="wood-form-label">Diámetro (cm)</label>
                                <input type="number" step="0.01" class="wood-form-control"
                                       name="diametro" value="{{ $troza->diametro }}" required>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="wood-form-group">
                                <label class="wood-form-label">Densidad</label>
                                <input type="number" step="0.01" class="wood-form-control"
                                       name="densidad" value="{{ $troza->densidad }}" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="wood-form-group">
                                <label class="wood-form-label">Especie</label>
                                <select class="wood-form-select" name="id_especie" required>
                                    @foreach ($especies as $especie)
                                    <option value="{{ $especie->id_especie }}"
                                            {{ $troza->id_especie == $especie->id_especie ? 'selected' : '' }}>
                                        {{ $especie->nom_cientifico }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="wood-form-group">
                                <label class="wood-form-label">Parcela</label>
                                <select class="wood-form-select" name="id_parcela" required>
                                    <option value="{{ $parcela->id_parcela }}" selected>
                                        {{ $parcela->nom_parcela }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="wood-edit-footer mt-4">
                        <button type="button" class="btn btn-wood-outline me-2" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-wood-primary">
                            <i class="fas fa-save me-2"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Estilos Específicos para esta Vista -->
<style>
    /* Estilos para modales de edición */
.wood-edit-modal .modal-content {
    border-radius: 12px;
    overflow: hidden;
    border: none;
}

.wood-edit-card {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.wood-edit-header {
    padding: 1.5rem;
    border-bottom: none;
}

.wood-edit-icon {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    flex-shrink: 0;
}

.wood-edit-title {
    font-weight: 700;
    font-size: 1.4rem;
    margin-bottom: 0.25rem;
    color: white;
}

.wood-edit-subtitle {
    font-size: 0.9rem;
    opacity: 0.9;
    color: rgba(255, 255, 255, 0.9);
}

/* Grupos de formulario */
.wood-form-group {
    margin-bottom: 1.25rem;
}

.wood-form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: var(--wood-text);
}

.wood-form-control {
    width: 100%;
    padding: 0.6rem 1rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    transition: all 0.3s;
    background-color: #fff;
}

.wood-form-control:focus {
    border-color: var(--wood-medium);
    box-shadow: 0 0 0 3px rgba(122, 74, 50, 0.1);
    outline: none;
}

.wood-form-select {
    width: 100%;
    padding: 0.6rem 1rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    transition: all 0.3s;
    background-color: #fff;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%237a4a32' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px 12px;
}

.wood-form-select:focus {
    border-color: var(--wood-medium);
    box-shadow: 0 0 0 3px rgba(122, 74, 50, 0.1);
    outline: none;
}

/* Pie del modal */
.wood-edit-footer {
    display: flex;
    justify-content: flex-end;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

/* Botones específicos */
.btn-wood-primary {
    background-color: var(--wood-medium);
    color: white;
    border: none;
    padding: 0.6rem 1.5rem;
    border-radius: 8px;
    transition: all 0.3s;
}

.btn-wood-primary:hover {
    background-color: var(--wood-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Modo oscuro */
@media (prefers-color-scheme: dark) {
    .wood-edit-card {
        background-color: #2a2a2a;
    }
    
    .wood-form-control,
    .wood-form-select {
        background-color: #333;
        border-color: #444;
        color: #eee;
    }
    
    .wood-form-label {
        color: #ddd;
    }
    
    .wood-form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23d4a762' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    }
    
    .wood-edit-footer {
        border-top-color: rgba(255, 255, 255, 0.1);
    }
    
    .btn-wood-primary {
        background-color: var(--wood-accent);
    }
}
    /* Estilos para modales de detalle */
.wood-detail-modal .modal-content {
    border-radius: 12px;
    overflow: hidden;
    border: none;
}

.wood-detail-card {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.wood-detail-header {
    padding: 1.5rem;
    border-bottom: none;
}

.wood-detail-icon {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    flex-shrink: 0;
}

.wood-detail-title {
    font-weight: 700;
    font-size: 1.4rem;
    margin-bottom: 0.25rem;
    color: white;
}

.wood-detail-subtitle {
    font-size: 0.9rem;
    opacity: 0.9;
    color: rgba(255, 255, 255, 0.9);
}

.wood-detail-section {
    margin-bottom: 1.5rem;
}

.wood-detail-section-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--wood-dark);
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid rgba(122, 74, 50, 0.1);
}

.wood-detail-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.wood-detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.wood-detail-label {
    color: var(--wood-text);
    opacity: 0.8;
    font-size: 0.9rem;
}

.wood-detail-value {
    color: var(--wood-dark);
    font-weight: 500;
    text-align: right;
}

.wood-highlight {
    color: var(--wood-accent);
    font-weight: 600;
}

.wood-detail-badge {
    display: inline-block;
    padding: 0.35em 0.65em;
    font-size: 0.75em;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 50rem;
}

.wood-badge-success {
    background-color: var(--wood-accent);
    color: white;
}

.wood-badge-warning {
    background-color: var(--wood-light);
    color: var(--wood-text);
}

.wood-detail-footer {
    display: flex;
    justify-content: flex-end;
}

/* Colores de cabecera */
.wood-bg-primary {
    background: linear-gradient(135deg, var(--wood-dark), var(--wood-medium));
}

.wood-bg-info {
    background: linear-gradient(135deg, #1a6e8a, #2d9cb5);
}

.wood-bg-warning {
    background: linear-gradient(135deg, #d4a762, #e8c897);
}


    /* Añade esto a tu CSS */
.wood-tab-btn:hover,
.wood-tab-btn.active {
    color: black; /* ← también aquí */
}

.wood-tab-btn:hover {
    color: var(--wood-dark); /* Color al pasar el mouse */
}

.wood-tab-btn.active {
    color: var(--wood-dark); /* Color cuando está activo */
}


    .wood-tabs .nav-link {
        color: var(--forest-medium);
        font-weight: 500;
        border: none;
        padding: 0.75rem 1.5rem;
        position: relative;
    }
    
    .wood-tabs .nav-link.active {
        color: var(--forest-dark);
        background-color: transparent;
    }
    
    .wood-tabs .nav-link.active:after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--forest-accent);
        border-radius: 3px 3px 0 0;
    }
    
    .wood-tab-content {
        background-color: white;
        border-radius: 0 0 12px 12px;
    }
    
    .list-group-item {
        padding: 0.75rem 0;
    }
    
    .btn-group {
        white-space: nowrap;
    }
    /* Estilos para las pestañas */
.wood-tabs {
    border-bottom: 2px solid rgba(122, 74, 50, 0.2);
    gap: 0.5rem;
}

.wood-tab-btn {
    position: relative;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    color: var(--wood-text);
    background-color: transparent;
    border: none;
    border-radius: var(--wood-border-radius) var(--wood-border-radius) 0 0;
    transition: var(--wood-transition);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    margin: 0;
    opacity: 0.8;
}

.wood-tab-btn:hover {
    color: var(--wood-dark);
    opacity: 1;
    transform: translateY(-2px);
}

.wood-tab-btn.active {
    color: var(--wood-dark);
    background-color: rgba(255, 255, 255, 0.9);
    box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.05), 
                0 2px 0 var(--wood-accent),
                2px 0 8px rgba(0, 0, 0, 0.05),
                -2px 0 8px rgba(0, 0, 0, 0.05);
    opacity: 1;
    border: none;
}

.wood-tab-btn.active:after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 2px;
    background: var(--wood-accent);
}

/* Badges mejorados */
.wood-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 24px;
    height: 24px;
    padding: 0 6px;
    font-size: 0.75rem;
    font-weight: 700;
    line-height: 1;
    color: white;
    background-color: var(--wood-accent);
    border-radius: 12px;
    transition: var(--wood-transition);
}

.wood-badge-secondary {
    background-color: var(--wood-medium);
}

.wood-badge-dark {
    background-color: var(--wood-dark);
}

/* Efecto hover para badges */
.wood-tab-btn:hover .wood-badge {
    transform: scale(1.1);
}


/* Estilos para las tarjetas de información */
.wood-info-card {
    border: none;
    border-radius: var(--wood-border-radius);
    background: white;
    transition: var(--wood-transition);
    height: 100%;
    position: relative;
    overflow: hidden;
    box-shadow: var(--wood-shadow-sm);
}

.wood-card-hover:hover {
    transform: translateY(-5px);
    box-shadow: var(--wood-shadow);
}

.wood-icon-wrapper {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: var(--wood-transition);
}

.wood-icon {
    font-size: 1.5rem;
}

.wood-card-title {
    color: var(--wood-dark);
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 1rem;
    position: relative;
}

.wood-card-title:after {
    content: '';
    position: absolute;
    width: 40px;
    height: 2px;
    background: var(--wood-light);
    bottom: -8px;
    left: 50%;
    transform: translateX(-50%);
}

.wood-card-text {
    color: var(--wood-text);
    font-size: 1rem;
    margin-bottom: 0;
}

.wood-unit {
    color: var(--wood-medium);
    font-size: 0.9rem;
    display: block;
    margin-top: 0.25rem;
}

.wood-card-decoration {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(to right, var(--wood-medium), var(--wood-light));
    opacity: 0;
    transition: var(--wood-transition);
}

.wood-card-hover:hover .wood-card-decoration {
    opacity: 1;
}

/* Colores de fondo para los iconos */
.bg-wood-light-20 {
    background-color: rgba(212, 167, 98, 0.15);
}

.bg-wood-medium-20 {
    background-color: rgba(122, 74, 50, 0.15);
}

.bg-wood-accent-20 {
    background-color: rgba(107, 142, 35, 0.15);
}

/* Efecto hover para los iconos */
.wood-card-hover:hover .wood-icon-wrapper {
    transform: scale(1.1);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}
/* Estilos base para los botones de acción */
.btn-wood-action {
    padding: 0.4rem 0.8rem;
    font-size: 0.8rem;
    font-weight: 500;
    border-radius: 20px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-width: 1.5px;
    border-style: solid;
}

/* Botón Ver/Detalles */
.btn-view {
    color: var(--wood-medium);
    border-color: var(--wood-medium);
    background-color: rgba(122, 74, 50, 0.1);
}

.btn-view:hover {
    background-color: rgba(122, 74, 50, 0.2);
    transform: translateY(-2px);
}

/* Botón Editar */
.btn-edit {
    color: var(--wood-accent);
    border-color: var(--wood-accent);
    background-color: rgba(107, 142, 35, 0.1);
}

.btn-edit:hover {
    background-color: rgba(107, 142, 35, 0.2);
    transform: translateY(-2px);
}

/* Botón Eliminar */
.btn-delete {
    color: #dc3545;
    border-color: #dc3545;
    background-color: rgba(220, 53, 69, 0.1);
}

.btn-delete:hover {
    background-color: rgba(220, 53, 69, 0.2);
    transform: translateY(-2px);
}

/* Efecto activo para todos los botones */
.btn-wood-action:active {
    transform: translateY(0);
    box-shadow: none;
}

/* Iconos dentro de los botones */
.btn-wood-action i {
    font-size: 0.7rem;
    transition: transform 0.2s ease;
}

.btn-wood-action:hover i {
    transform: scale(1.1);
}



</style>

@endsection

