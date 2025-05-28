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
        
        <!-- Cuerpo de la Tarjeta -->
        <div class="card-body p-4">
            <!-- Información Resumida -->
            <div class="row mb-5">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="wood-card wood-shadow-sm h-100">
                        <div class="card-body text-center p-3">
                            <div class="icon icon-shape icon-md bg-forest-light text-forest-dark rounded-circle mb-3 mx-auto">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h5 class="text-forest-dark mb-1">Ubicación</h5>
                            <p class="text-muted mb-0">{{ $parcela->ubicacion }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="wood-card wood-shadow-sm h-100">
                        <div class="card-body text-center p-3">
                            <div class="icon icon-shape icon-md bg-forest-medium text-white rounded-circle mb-3 mx-auto">
                                <i class="fas fa-ruler-combined"></i>
                            </div>
                            <h5 class="text-forest-dark mb-1">Área</h5>
                            <p class="text-muted mb-0">{{ $parcela->area }} hectáreas</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="wood-card wood-shadow-sm h-100">
                        <div class="card-body text-center p-3">
                            <div class="icon icon-shape icon-md bg-forest-accent text-white rounded-circle mb-3 mx-auto">
                                <i class="fas fa-tree"></i>
                            </div>
                            <h5 class="text-forest-dark mb-1">Trozas</h5>
                            <p class="text-muted mb-0">{{ $parcela->trozas->count() }} registradas</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pestañas Mejoradas -->
            <ul class="nav nav-tabs wood-tabs" id="parcelaTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="trozas-tab" data-bs-toggle="tab" data-bs-target="#trozas" type="button" role="tab">
                        <i class="fas fa-tree me-2"></i> Trozas <span class="badge bg-forest-accent ms-2">{{ $parcela->trozas->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="estimaciones-tab" data-bs-toggle="tab" data-bs-target="#estimaciones" type="button" role="tab">
                        <i class="fas fa-calculator me-2"></i> Estimaciones <span class="badge bg-forest-medium ms-2">{{ $parcela->estimaciones->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="turnos-tab" data-bs-toggle="tab" data-bs-target="#turnos" type="button" role="tab">
                        <i class="fas fa-calendar-alt me-2"></i> Turnos <span class="badge bg-forest-dark ms-2">{{ $parcela->turnosCorta->count() }}</span>
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
                                    <td class="pe-4 text-end">
                                        <button class="btn btn-sm btn-wood-outline rounded-pill px-3" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#trozaModal{{ $troza->id_troza }}">
                                            <i class="fas fa-eye me-1"></i> Detalles
                                        </button>
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
                                    <td class="pe-4 text-end">
                                        <button class="btn btn-sm btn-wood-outline rounded-pill px-3" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#estimacionModal{{ $estimacion->id_estimacion }}">
                                            <i class="fas fa-eye me-1"></i> Detalles
                                        </button>
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
                                    <td class="pe-4 text-end">
                                        <button class="btn btn-sm btn-wood-outline rounded-pill px-3" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#turnoModal{{ $turno->id_turno }}">
                                            <i class="fas fa-eye me-1"></i> Detalles
                                        </button>
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
<div class="modal fade" id="trozaModal{{ $troza->id_troza }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="wood-card wood-shadow-lg border-0">
            <div class="wood-card-header">
                <h5 class="modal-title text-white">
                    <i class="fas fa-tree me-2"></i>Troza #{{ $troza->id_troza }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h6 class="text-forest-dark mb-3"><i class="fas fa-info-circle me-2"></i>Información Básica</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                <span class="text-muted">Especie:</span>
                                <span class="text-forest-dark">{{ $troza->especie->nom_cientifico }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                <span class="text-muted">Longitud:</span>
                                <span class="text-forest-dark">{{ $troza->longitud }} metros</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                <span class="text-muted">Diámetro:</span>
                                <span class="text-forest-dark">{{ $troza->diametro }} cm</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-forest-dark mb-3"><i class="fas fa-chart-bar me-2"></i>Mediciones</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                <span class="text-muted">Volumen:</span>
<span class="text-forest-accent">
        {{ $troza->estimacion ? number_format($troza->estimacion->calculo, 4) : 'Sin cálculo' }} m³
    </span>                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                <span class="text-muted">Densidad:</span>
                                <span class="text-forest-dark">{{ $troza->densidad }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                <span class="text-muted">Fecha Registro:</span>
                                <span class="text-muted">{{ $troza->created_at->format('d/m/Y') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach($parcela->estimaciones as $estimacion)
<div class="modal fade" id="estimacionModal{{ $estimacion->id_estimacion }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="wood-card wood-shadow-lg border-0">
            <div class="wood-card-header bg-forest-medium">
                <h5 class="modal-title text-white">
                    <i class="fas fa-calculator me-2"></i>Estimación #{{ $estimacion->id_estimacion }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h6 class="text-forest-dark mb-3"><i class="fas fa-info-circle me-2"></i>Detalles</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                <span class="text-muted">Tipo:</span>
                                <span class="text-forest-dark">{{ $estimacion->tipoEstimacion->desc_estimacion }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                <span class="text-muted">Fórmula:</span>
                                <span class="text-forest-dark">{{ $estimacion->formula->nom_formula }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                <span class="text-muted">Troza:</span>
                                <span class="text-forest-dark">#{{ $estimacion->troza->id_troza }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-forest-dark mb-3"><i class="fas fa-chart-line me-2"></i>Resultados</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                <span class="text-muted">Cálculo:</span>
                                <span class="text-forest-accent">{{ number_format($estimacion->calculo, 4) }} m³</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                <span class="text-muted">Fecha:</span>
                                <span class="text-muted">{{ $estimacion->created_at->format('d/m/Y H:i') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach($parcela->turnosCorta as $turno)
<div class="modal fade" id="turnoModal{{ $turno->id_turno }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="wood-card wood-shadow-lg border-0">
            <div class="wood-card-header bg-forest-accent">
                <h5 class="modal-title text-white">
                    <i class="fas fa-calendar-alt me-2"></i>Turno {{ $turno->codigo_corta }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card-body p-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        <span class="text-muted">Parcela:</span>
                        <span class="text-forest-dark">{{ $parcela->nom_parcela }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        <span class="text-muted">Fecha:</span>
                        <span class="text-forest-dark">{{ $turno->fecha_corta->format('d/m/Y') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        <span class="text-muted">Estado:</span>
                        <span class="badge bg-{{ $turno->completado ? 'forest-accent' : 'forest-medium' }}">
                            {{ $turno->completado ? 'Completado' : 'Pendiente' }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Estilos Específicos para esta Vista -->
<style>
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
</style>

@endsection