@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Encabezado Premium Mejorado -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 wood-shadow-lg">
                <div class="card-body p-4 wood-bg-gradient">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="text-white mb-2"><i class="fas fa-tree me-2"></i> Panel del Técnico Forestal</h2>
                            <p class="text-white opacity-8 mb-0">Gestión profesional de recursos maderables sostenibles</p>
                        </div>
                        <button class="btn btn-wood-light rounded-pill wood-shadow" data-bs-toggle="modal" data-bs-target="#createParcelaModal">
                            <i class="fas fa-plus me-2"></i> Nueva Parcela
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta de Información del Técnico - Versión Elegante -->
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="wood-card wood-shadow">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon icon-shape icon-lg bg-forest-dark text-white rounded-circle me-4 wood-shadow-sm">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div>
                            <h3 class="text-forest-dark mb-1">Técnico {{ $user->persona->nom ?? 'Usuario' }}</h3>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-forest-light text-forest-dark me-2">
                                    <i class="fas fa-id-card me-1"></i> {{ $tecnico->cedula_p ?? 'No disponible' }}
                                </span>
                                <span class="badge bg-forest-accent text-white">
                                    <i class="fas fa-key me-1"></i> {{ $tecnico->clave_tecnico }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="wood-divider my-4">
                    
                    <div class="row">
                        <!-- Tarjeta de Parcelas -->
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="wood-card h-100 wood-shadow-sm">
                                <div class="card-body text-center p-3">
                                    <div class="icon icon-shape icon-md bg-forest-light text-forest-dark rounded-circle mb-3 mx-auto wood-shadow-sm">
                                        <i class="fas fa-map-marked-alt"></i>
                                    </div>
                                    <h2 class="text-forest-dark mb-1">{{ $parcelas->count() }}</h2>
                                    <p class="text-muted mb-0">Parcelas asignadas</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tarjeta de Trozas -->
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="wood-card h-100 wood-shadow-sm">
                                <div class="card-body text-center p-3">
                                    <div class="icon icon-shape icon-md bg-forest-medium text-white rounded-circle mb-3 mx-auto wood-shadow-sm">
                                        <i class="fas fa-cut"></i>
                                    </div>
                                    <h2 class="text-forest-dark mb-1">{{ $totalTrozas }}</h2>
                                    <p class="text-muted mb-0">Trozas registradas</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tarjeta de Turnos -->
                        <div class="col-md-4">
                            <div class="wood-card h-100 wood-shadow-sm">
                                <div class="card-body text-center p-3">
                                    <div class="icon icon-shape icon-md bg-forest-accent text-white rounded-circle mb-3 mx-auto wood-shadow-sm">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <h2 class="text-forest-dark mb-1">{{ $turnosCount ?? 0 }}</h2>
                                    <p class="text-muted mb-0">Turnos programados</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Listado de Parcelas - Versión Elegante -->
    <div class="row">
        <div class="col-12">
            <div class="wood-card wood-shadow">
                <div class="wood-card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-white">
                            <i class="fas fa-map me-2"></i>Parcelas Asignadas
                        </h5>
                        <div class="input-group wood-search-input">
                            <input type="text" class="form-control" placeholder="Buscar parcela...">
                            <button class="btn btn-wood-outline" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="wood-table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase ps-4">Nombre</th>
                                    <th class="text-uppercase">Ubicación</th>
                                    <th class="text-uppercase">Trozas</th>
                                    <th class="text-uppercase">Extensión</th>
                                    <th class="text-uppercase text-end pe-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($parcelas as $parcela)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="icon icon-shape icon-sm bg-forest-light text-forest-dark rounded-circle me-3 wood-shadow-sm">
                                                <i class="fas fa-map"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-forest-dark">{{ $parcela->nom_parcela }}</h6>
                                                <small class="text-muted">Código: {{ $parcela->id_parcela }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-forest-medium">{{ $parcela->ubicacion }}</span>
                                    </td>
                                    <td>
                                        <span class="wood-badge">{{ $parcela->trozas_count }}</span>
                                    </td>
                                    <td>
                                        <span class="text-forest-medium">{{ $parcela->extension }} ha</span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-wood-outline rounded-start-pill px-3" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#addTrozaModal{{ $parcela->id_parcela }}"
                                                    data-bs-tooltip="tooltip" title="Agregar troza">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <button class="btn btn-sm btn-wood-outline px-3" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#estimacionModal{{ $parcela->id_parcela }}"
                                                    data-bs-tooltip="tooltip" title="Realizar estimación">
                                                <i class="fas fa-calculator"></i>
                                            </button>
                                            <button class="btn btn-sm btn-wood-outline px-3" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#turnoModal{{ $parcela->id_parcela }}"
                                                    data-bs-tooltip="tooltip" title="Programar turno">
                                                <i class="fas fa-calendar-alt"></i>
                                            </button>
                                            <a href="{{ route('parcelas.show', $parcela->id_parcela) }}" 
                                               class="btn btn-sm btn-wood-outline rounded-end-pill px-3"
                                               data-bs-tooltip="tooltip" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-center">
                                            <i class="fas fa-map-marked-alt fa-4x text-forest-light mb-4"></i>
                                            <h5 class="text-forest-medium mb-3">No tienes parcelas asignadas</h5>
                                            <button class="btn btn-wood rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#createParcelaModal">
                                                <i class="fas fa-plus me-2"></i> Asignar Parcela
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                @if($parcelas->hasPages())
                <div class="wood-card-footer">
                    {{ $parcelas->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal para crear parcela (Versión Elegante) -->
<div class="modal fade" id="createParcelaModal" tabindex="-1" aria-labelledby="createParcelaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-map-marked-alt me-2"></i>Nueva Parcela
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('parcelas.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre de la parcela</label>
                        <input type="text" name="nom_parcela" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Ubicación</label>
                            <input type="text" name="ubicacion" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Extensión (ha)</label>
                            <input type="number" step="0.01" name="extension" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Código Postal</label>
                            <input type="text" name="CP" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Productor</label>
                            <select class="form-select" name="id_productor">
                                <option value="" selected disabled>Seleccionar productor</option>
                                <!-- Aquí irían los productores -->
                            </select>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill"
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-save me-1"></i> Registrar Parcela
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modales para acciones por parcela -->
@foreach($parcelas as $parcela)
<!-- Modal para agregar troza -->
<div class="modal fade" id="addTrozaModal{{ $parcela->id_parcela }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus me-2"></i>Nueva Troza en {{ $parcela->nom_parcela }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('trozas.store') }}">
                    @csrf
                    <input type="hidden" name="id_parcela" value="{{ $parcela->id_parcela }}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Longitud (m)</label>
                            <input type="number" step="0.01" name="longitud" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Diámetro (m)</label>
                            <input type="number" step="0.01" name="diametro" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Diámetro otro extremo (m)</label>
                            <input type="number" step="0.01" name="diametro_otro_extremo" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Diámetro medio (m)</label>
                            <input type="number" step="0.01" name="diametro_medio" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Densidad</label>
                        <input type="number" step="0.01" name="densidad" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Especie</label>
                        <select class="form-select" name="id_especie" required>
                            <option value="" selected disabled>Seleccionar especie</option>
                            <!-- Aquí irían las especies -->
                        </select>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill"
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-check-circle me-1"></i> Registrar Troza
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para estimación -->
<div class="modal fade" id="estimacionModal{{ $parcela->id_parcela }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-calculator me-2"></i>Estimación para {{ $parcela->nom_parcela }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('estimaciones.store') }}">
                    @csrf
                    <input type="hidden" name="id_parcela" value="{{ $parcela->id_parcela }}">
                    <div class="mb-3">
                        <label class="form-label">Seleccionar Troza</label>
                        <select class="form-select" name="id_troza" required>
                            <option value="" selected disabled>Seleccione una troza</option>
                            @foreach($parcela->trozas as $troza)
                            <option value="{{ $troza->id_troza }}">Troza #{{ $troza->id_troza }} ({{ $troza->longitud }}m x {{ $troza->diametro }}m)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipo de Estimación</label>
                            <select class="form-select" name="id_tipo_e" required>
                                <option value="" selected disabled>Seleccione un tipo</option>
                                @foreach($tiposEstimacion as $tipo)
                                <option value="{{ $tipo->id_tipo_e }}">{{ $tipo->desc_estimacion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fórmula a Aplicar</label>
                            <select class="form-select" name="id_formula" required>
                                <option value="" selected disabled>Seleccione una fórmula</option>
                                @foreach($formulas as $formula)
                                <option value="{{ $formula->id_formula }}">{{ $formula->nom_formula }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cálculo (opcional)</label>
                        <textarea class="form-control" name="calculo" rows="2"></textarea>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill"
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-info rounded-pill">
                            <i class="fas fa-calculator me-1"></i> Calcular Estimación
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para turno de corta -->
<div class="modal fade" id="turnoModal{{ $parcela->id_parcela }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-warning text-white">
                <h5 class="modal-title">
                    <i class="fas fa-calendar-alt me-2"></i>Programar Turno de Corta para {{ $parcela->nom_parcela }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('turno_cortas.store') }}">
                    @csrf
                    <input type="hidden" name="id_parcela" value="{{ $parcela->id_parcela }}">
                    <div class="mb-3">
                        <label class="form-label">Código de Corta</label>
                        <input type="text" name="codigo_corta" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de Corta</label>
                        <input type="date" name="fecha_corta" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notas adicionales</label>
                        <textarea class="form-control" name="notas" rows="2"></textarea>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill"
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning rounded-pill">
                            <i class="fas fa-calendar-check me-1"></i> Programar Turno
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


<!-- Modales para acciones por parcela (Estructura similar para addTrozaModal, estimacionModal, turnoModal) -->
<!-- ... (mantener la misma estructura pero aplicando los nuevos estilos) ... -->

<style>
    /* Paleta de colores forestales elegantes */
    :root {
        --forest-dark: #2C4A3E;       /* Verde oscuro elegante */
        --forest-medium: #537A5A;     /* Verde medio */
        --forest-light: #8AAE92;      /* Verde claro suave */
        --forest-accent: #6B8E23;     /* Verde oliva para acentos */
        --forest-bg: #F5F9F7;         /* Fondo muy claro */
        --forest-text: #2D3E40;       /* Texto principal */
        --forest-border: #D1E0D7;     /* Bordes sutiles */
    }
    
    /* Aplicación de la paleta */
    .wood-bg-gradient {
        background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
    }
    
    .text-forest-dark { color: var(--forest-dark); }
    .text-forest-medium { color: var(--forest-medium); }
    .text-forest-light { color: var(--forest-light); }
    .text-forest-accent { color: var(--forest-accent); }
    
    .bg-forest-dark { background-color: var(--forest-dark); }
    .bg-forest-medium { background-color: var(--forest-medium); }
    .bg-forest-light { background-color: var(--forest-light); }
    .bg-forest-accent { background-color: var(--forest-accent); }
    
    /* Mejoras específicas para la vista */
    .wood-card-header {
        background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
        color: white;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .wood-card-footer {
        background: var(--forest-bg);
        padding: 1.25rem 1.5rem;
        border-top: 1px solid var(--forest-border);
    }
    
    .wood-table thead th {
        background-color: var(--forest-dark);
        color: white;
        padding: 1rem 1.5rem;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    
    .wood-table tbody td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--forest-border);
        vertical-align: middle;
    }
    
    .wood-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    .wood-table tbody tr:hover {
        background-color: rgba(138, 174, 146, 0.05);
    }
    
    .wood-badge {
        background-color: var(--forest-accent);
        color: white;
        padding: 0.35em 0.65em;
        border-radius: 50rem;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .wood-form-control {
        border: 1px solid var(--forest-border);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        transition: all 0.3s;
    }
    
    .wood-form-control:focus {
        border-color: var(--forest-medium);
        box-shadow: 0 0 0 0.25rem rgba(83, 122, 90, 0.15);
    }
    
    .wood-search-input .form-control {
        border-right: none;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    
    .wood-search-input .btn {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        border-left: none;
    }
    
    /* Botones especializados */
    .btn-wood {
        background-color: var(--forest-accent);
        color: white;
        border: none;
        font-weight: 500;
    }
    
    .btn-wood:hover {
        background-color: #5a7720;
        color: white;
    }
    
    .btn-wood-outline {
        background-color: transparent;
        color: var(--forest-medium);
        border: 1px solid var(--forest-medium);
    }
    
    .btn-wood-outline:hover {
        background-color: rgba(83, 122, 90, 0.1);
        color: var(--forest-dark);
    }
    
    .btn-wood-light {
        background-color: var(--forest-light);
        color: var(--forest-text);
    }
    
    .btn-wood-light:hover {
        background-color: #7a9b81;
        color: white;
    }
</style>

<script>
    // Inicializar tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection