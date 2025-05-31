@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <!-- Encabezado -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 wood-shadow-lg">
                    <div class="card-body p-4 wood-bg-gradient">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="text-white mb-2"><i class="fas fa-tree me-2"></i> Panel del Técnico Forestal</h2>
                                <p class="text-white opacity-8 mb-0">Gestión profesional de recursos maderables sostenibles</p>
                            </div>
                            <button class="btn btn-wood-light rounded-pill wood-shadow px-4" data-bs-toggle="modal" data-bs-target="#createParcelaModal">
                                <i class="fas fa-plus me-2"></i> Nueva Parcela
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Información -->
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
                            <!-- Tarjetas de resumen -->
                            <div class="col-md-3 mb-3 mb-md-0">
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

                            <div class="col-md-3 mb-3 mb-md-0">
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

                            <div class="col-md-3 mb-3 mb-md-0">
                                <div class="wood-card h-100 wood-shadow-sm">
                                    <div class="card-body text-center p-3">
                                        <div class="icon icon-shape icon-md bg-forest-accent text-white rounded-circle mb-3 mx-auto wood-shadow-sm">
                                            <i class="fas fa-calculator"></i>
                                        </div>
                                        <h2 class="text-forest-dark mb-1">{{ $totalEstimaciones }}</h2>
                                        <p class="text-muted mb-0">Estimaciones</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="wood-card h-100 wood-shadow-sm">
                                    <div class="card-body text-center p-3">
                                        <div class="icon icon-shape icon-md bg-forest-dark text-white rounded-circle mb-3 mx-auto wood-shadow-sm">
                                            <i class="fas fa-cubes"></i>
                                        </div>
                                        <h2 class="text-forest-dark mb-1">{{ number_format($totalVolumenMaderable, 2) }} m³</h2>
                                        <p class="text-muted mb-0">Volumen total</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listado de Parcelas -->
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
                                    <th class="text-uppercase">Productores</th>
                                    <th class="text-uppercase">Ubicación</th>
                                    <th class="text-uppercase">Extensión (ha)</th>
                                    <th class="text-uppercase">Trozas</th>
                                    <th class="text-uppercase">Estimaciones</th>
                                    <th class="text-uppercase">Volumen (m³)</th>
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
                                            @if($parcela->productor)
                                                <div class="d-flex align-items-center">
                                                    <div class="icon icon-shape icon-sm bg-wood-light text-wood-dark rounded-circle me-2">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <div>
                                                        <span class="d-block">{{ $parcela->productor->persona->nom }}</span>
                                                        <small class="text-muted">{{ $parcela->productor->persona->cedula }}</small>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted">No asignado</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-forest-medium">{{ $parcela->ubicacion }}</span>
                                        </td>
                                        <td>
                                            <span class="text-forest-medium">{{ $parcela->extension }}</span>
                                        </td>
                                        <td>
                                            <span class="wood-badge">{{ $parcela->trozas_count }}</span>
                                        </td>
                                        <td>
                                            <span class="wood-badge bg-info">{{ $parcela->estimaciones_count }}</span>
                                        </td>
                                        <td>
                                            <span class="wood-badge bg-success">
                                                {{ number_format($parcela->volumen_maderable, 2) }} m³
                                            </span>
                                        </td>
                                        <td class="pe-4">
                                            <div class="vertical-actions">
                                                <a href="{{ route('parcelas.export.pdf', $parcela->id_parcela) }}"
                                                   class="btn btn-sm btn-pdf mb-2 w-100 text-start"
                                                   data-bs-tooltip="tooltip" title="Exportar a PDF">
                                                    <i class="fas fa-file-pdf me-2"></i> Exportar PDF
                                                </a>
                                                <button class="btn btn-sm btn-wood-action mb-2 w-100 text-start"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#addTrozaModal{{ $parcela->id_parcela }}"
                                                        data-bs-tooltip="tooltip" title="Agregar troza">
                                                    <i class="fas fa-plus me-2"></i> Agregar Troza
                                                </button>
                                                <button class="btn btn-sm btn-wood-action mb-2 w-100 text-start"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#estimacionModal{{ $parcela->id_parcela }}"
                                                        data-bs-tooltip="tooltip" title="Realizar estimación">
                                                    <i class="fas fa-calculator me-2"></i> Estimación
                                                </button>
                                                <a href="{{ route('parcelas.show', $parcela->id_parcela) }}"
                                                   class="btn btn-sm btn-wood-action w-100 text-start"
                                                   data-bs-tooltip="tooltip" title="Ver detalles">
                                                    <i class="fas fa-eye me-2"></i> Ver Detalles
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
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
                            <label class="form-label">Productor</label>
                            <select class="form-select border-2" name="id_productor" required>
                                <option value="" selected disabled>Seleccione un productor</option>
                                @foreach ($productores as $productor)
                                    <option value="{{ $productor->id_productor }}">
                                        {{ $productor->persona->nom }} ({{ $productor->persona->cedula }})
                                    </option>
                                @endforeach
                            </select>
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
                                <label class="form-label">Especie Principal</label>
                                <select class="form-select border-2" name="id_especie" required>
                                    <option value="" selected disabled>Seleccione una especie</option>
                                    @foreach ($especies as $especie)
                                        <option value="{{ $especie->id_especie }}">{{ $especie->nom_cientifico }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill px-4"
                                    data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-wood rounded-pill px-4">
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
                                <select class="form-select border-2" name="id_especie" required>
                                    <option value="" selected disabled>Seleccione una especie</option>
                                    @foreach ($especies as $especie)
                                        <option value="{{ $especie->id_especie }}">{{ $especie->nom_cientifico }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill px-4"
                                        data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-wood rounded-pill px-4">
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
                                <label class="form-label">Cálculo (m³)</label>
                                <input type="number" step="0.01" class="form-control" name="calculo" required>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill px-4"
                                        data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-info rounded-pill px-4">
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
                                <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill px-4"
                                        data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-warning rounded-pill px-4">
                                    <i class="fas fa-calendar-check me-1"></i> Programar Turno
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <style>
        /* Paleta de colores forestales elegantes */
        :root {
            --forest-dark: #184d33;       /* Verde oscuro elegante */
            --forest-medium: #23502b;     /* Verde medio */
            --forest-light: #8AAE92;      /* Verde claro suave */
            --forest-accent: #6B8E23;     /* Verde oliva para acentos */
            --wood-light: #D7C9AA;        /* Color madera claro */
            --wood-dark: #6B4F3D;         /* Color madera oscuro */
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
        .text-wood-dark { color: var(--wood-dark); }

        .bg-forest-dark { background-color: var(--forest-dark); }
        .bg-forest-medium { background-color: var(--forest-medium); }
        .bg-forest-light { background-color: var(--forest-light); }
        .bg-forest-accent { background-color: var(--forest-accent); }
        .bg-wood-light { background-color: var(--wood-light); }

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
            padding: 1rem 1.5rem;
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

        .wood-badge.bg-info {
            background-color: #17a2b8;
        }

        .wood-badge.bg-success {
            background-color: #28a745;
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

        /* Estilos para botones */
        .btn-wood {
            background-color: var(--forest-accent);
            color: white;
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-wood:hover {
            background-color: #5a7720;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .btn-wood-outline {
            background-color: transparent;
            color: var(--forest-medium);
            border: 1px solid var(--forest-medium);
            transition: all 0.3s ease;
        }

        .btn-wood-outline:hover {
            background-color: rgba(83, 122, 90, 0.1);
            color: var(--forest-dark);
            border-color: var(--forest-dark);
        }

        /* Botones de acción */
        .btn-wood-action {
            background-color: white;
            color: var(--forest-medium);
            border: 1px solid var(--forest-border);
            transition: all 0.2s ease;
        }

        .btn-wood-action:hover {
            background-color: var(--forest-light);
            color: white;
            border-color: var(--forest-light);
        }

        .wood-btn-group .btn-wood-action {
            border-radius: 0;
            margin-left: -1px;
        }

        .wood-btn-group .btn-wood-action:first-child {
            border-top-left-radius: 50rem;
            border-bottom-left-radius: 50rem;
            margin-left: 0;
        }

        .wood-btn-group .btn-wood-action:last-child {
            border-top-right-radius: 50rem;
            border-bottom-right-radius: 50rem;
        }

        /* Botones en modales */
        .modal-footer .btn {
            min-width: 100px;
        }

        .btn-wood-light {
            background-color: var(--forest-light);
            color: var(--forest-text);
            transition: all 0.3s ease;
        }

        .btn-wood-light:hover {
            background-color: #7a9b81;
            color: white;
            transform: translateY(-1px);
        }

        /* Divider personalizado */
        .wood-divider {
            border: 0;
            height: 1px;
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(35, 80, 43, 0.5), rgba(0, 0, 0, 0));
        }

        /* Sombras */
        .wood-shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .wood-shadow-sm {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .wood-shadow-lg {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        /* Tarjetas personalizadas */
        .wood-card {
            background-color: white;
            border-radius: 12px;
            border: none;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .wood-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        .btn-pdf {
            background-color: #e74c3c;
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-pdf:hover {
            background-color: #c0392b;
            color: white;
            transform: translateY(-1px);
        }

        .btn-pdf i {
            margin-right: 5px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection
