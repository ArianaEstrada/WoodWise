@extends('dashboard')

@section('template_title', 'Gestión de Turnos de Corta')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header -->
        <div class="card-header bg-gradient-forest text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-calendar-alt fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold text-white">Turnos de Corta</h5>
            </div>
            <div class="d-flex">
                <button class="btn btn-light rounded-pill me-2" data-bs-toggle="modal" data-bs-target="#createTurnoModal">
                    <i class="fas fa-plus me-2"></i>Nuevo Turno
                </button>
                <button class="btn btn-outline-light rounded-pill" data-bs-toggle="modal" data-bs-target="#helpTurnoModal">
                    <i class="fas fa-question-circle me-2"></i>Ayuda
                </button>
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="card-body p-0">
            <!-- Filtros -->
            <div class="p-3 border-bottom bg-light">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar turnos...">
                    </div>
                    <div class="col-md-4">
                        <select id="filterParcela" class="form-select">
                            <option value="">Todas las parcelas</option>
                            @foreach($parcelas as $parcela)
                                <option value="{{ $parcela->id_parcela }}">{{ $parcela->nom_parcela }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button id="resetFilters" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-undo me-1"></i> Limpiar
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive rounded-lg">
                <table class="table table-hover align-middle mb-0" id="turnosTable">
                    <thead class="bg-light-forest text-white">
                        <tr>
                            <th class="py-3 ps-4">ID</th>
                            <th class="py-3">Parcela</th>
                            <th class="py-3">Productor</th>
                            <th class="py-3">Código</th>
                            <th class="py-3">Fecha Corta</th>
                            <th class="py-3">Fecha Fin</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($turnos as $turno)
                        <tr class="border-bottom" data-parcela="{{ $turno->id_parcela }}">
                            <td class="ps-4">{{ $turno->id_turno }}</td>
                            <td class="fw-semibold">{{ $turno->parcela->nom_parcela }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-primary rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user-tie text-primary"></i>
                                    </div>
                                    <span>{{ $turno->parcela->productor->persona->nom_completo ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $turno->codigo_corta ?? 'Sin código' }}</span>
                            </td>
                            <td>{{ $turno->fecha_corta ? $turno->fecha_corta->format('d/m/Y') : 'No definida' }}</td>
                            <td>{{ $turno->fecha_fin ? $turno->fecha_fin->format('d/m/Y') : 'No definida' }}</td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-info rounded-start-pill me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewTurnoModal{{ $turno->id_turno }}">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editTurnoModal{{ $turno->id_turno }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill" 
                                            onclick="confirmDelete('{{ route('turno_cortas.destroy', $turno->id_turno) }}', '{{ $turno->codigo_corta }}')">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No se encontraron turnos de corta</h5>
                                    <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createTurnoModal">
                                        <i class="fas fa-plus me-1"></i> Crear primer turno
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Paginación -->
                @if($turnos->hasPages())
                <div class="p-3 border-top">
                    {{ $turnos->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal de Ayuda -->
<div class="modal fade" id="helpTurnoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-question-circle me-2"></i>Ayuda - Turnos de Corta
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="fw-bold">¿Qué es un Turno de Corta?</h6>
                <p>Un turno de corta representa el período durante el cual se realiza la tala de árboles en una parcela específica.</p>
                
                <h6 class="fw-bold mt-3">Información importante:</h6>
                <ul>
                    <li>Cada turno genera un código único automáticamente</li>
                    <li>La fecha de inicio se establece automáticamente al crear el turno</li>
                    <li>Puede editar la fecha de finalización cuando termine la corta</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary rounded-pill" data-bs-dismiss="modal">Entendido</button>
            </div>
        </div>
    </div>
</div>

<!-- Modales para cada turno -->
@foreach ($turnos as $turno)
<!-- Modal Ver Turno -->
<div class="modal fade" id="viewTurnoModal{{ $turno->id_turno }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title">Detalles del Turno</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">ID Turno:</h6>
                        <p class="fw-bold">{{ $turno->id_turno }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Fecha Registro:</h6>
                        <p class="fw-bold">{{ $turno->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Parcela:</h6>
                        <p class="fw-bold">{{ $turno->parcela->nom_parcela }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Productor:</h6>
                        <p class="fw-bold">{{ $turno->parcela->productor->persona->nom_completo ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Código de Corta:</h6>
                        <p class="fw-bold">{{ $turno->codigo_corta }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Estado:</h6>
                        <p class="fw-bold">
                            <span class="badge {{ $turno->fecha_fin ? 'bg-success' : 'bg-warning' }}">
                                {{ $turno->fecha_fin ? 'Completado' : 'En progreso' }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Fecha de Inicio:</h6>
                        <p class="fw-bold">{{ $turno->fecha_corta->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Fecha de Finalización:</h6>
                        <p class="fw-bold">{{ $turno->fecha_fin ? $turno->fecha_fin->format('d/m/Y') : 'No finalizado' }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Turno -->
<div class="modal fade" id="editTurnoModal{{ $turno->id_turno }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">Editar Turno</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('turno_cortas.update', $turno->id_turno) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Parcela <span class="text-danger">*</span></label>
                        <select name="id_parcela" class="form-select border-2" required>
                            @foreach ($parcelas as $parcela)
                            <option value="{{ $parcela->id_parcela }}" {{ $parcela->id_parcela == $turno->id_parcela ? 'selected' : '' }}>
                                {{ $parcela->nom_parcela }} ({{ $parcela->productor->persona->nom_completo ?? 'N/A' }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de Inicio</label>
                            <input type="date" name="fecha_corta" class="form-control border-2" 
                                   value="{{ $turno->fecha_corta->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de Finalización</label>
                            <input type="date" name="fecha_fin" class="form-control border-2" 
                                   value="{{ $turno->fecha_fin ? $turno->fecha_fin->format('Y-m-d') : '' }}"
                                   min="{{ $turno->fecha_corta->format('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-save me-1"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Crear Turno -->
<div class="modal fade" id="createTurnoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">Nuevo Turno de Corta</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('turno_cortas.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Parcela <span class="text-danger">*</span></label>
                        <select name="id_parcela" class="form-select border-2" required>
                            <option value="" selected disabled>Seleccione una parcela</option>
                            @foreach ($parcelas as $parcela)
                            <option value="{{ $parcela->id_parcela }}">
                                {{ $parcela->nom_parcela }} ({{ $parcela->productor->persona->nom_completo ?? 'N/A' }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de Inicio</label>
                            <input type="date" name="fecha_corta" class="form-control border-2" 
                                   value="{{ old('fecha_corta', date('Y-m-d')) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de Finalización (Opcional)</label>
                            <input type="date" name="fecha_fin" class="form-control border-2" 
                                   value="{{ old('fecha_fin') }}" min="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-check-circle me-1"></i> Crear Turno
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filtrado y búsqueda
    const searchInput = document.getElementById('searchInput');
    const filterParcela = document.getElementById('filterParcela');
    const resetFilters = document.getElementById('resetFilters');
    
    function filterTurnos() {
        const searchTerm = searchInput.value.toLowerCase();
        const parcelaFilter = filterParcela.value;
        
        document.querySelectorAll('#turnosTable tbody tr').forEach(row => {
            const parcela = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const productor = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const codigo = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
            const rowParcela = row.getAttribute('data-parcela');
            
            const matchesSearch = parcela.includes(searchTerm) || 
                                productor.includes(searchTerm) || 
                                codigo.includes(searchTerm);
            const matchesParcela = parcelaFilter === '' || rowParcela === parcelaFilter;
            
            row.style.display = (matchesSearch && matchesParcela) ? '' : 'none';
        });
    }
    
    searchInput.addEventListener('input', filterTurnos);
    filterParcela.addEventListener('change', filterTurnos);
    resetFilters.addEventListener('click', function() {
        searchInput.value = '';
        filterParcela.value = '';
        filterTurnos();
    });
    
    // Confirmación de eliminación
    window.confirmDelete = function(url, codigo) {
        Swal.fire({
            title: '¿Confirmar eliminación?',
            html: `El turno con código <strong>${codigo}</strong> será eliminado permanentemente`,
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
    
    // Notificaciones
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: '{{ session('success') }}',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: 'var(--bs-light)',
        color: 'var(--bs-dark)',
        iconColor: 'var(--bs-success)'
    });
    @endif
    
    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: '{{ session('error') }}',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: 'var(--bs-light)',
        color: 'var(--bs-dark)',
        iconColor: 'var(--bs-danger)'
    });
    @endif
});
</script>

<style>
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
    
    .modal-content {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .badge {
        font-size: 0.85em;
        font-weight: 500;
    }
    
    .badge.bg-info {
        background-color: #0288d1 !important;
    }
    
    .badge.bg-success {
        background-color: #2e7d32 !important;
    }
    
    .badge.bg-warning {
        background-color: #ff9800 !important;
        color: white !important;
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
@endsection