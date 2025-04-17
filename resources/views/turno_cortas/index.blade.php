@extends('dashboard')

@section('template_title', 'Gestión de Turnos de Corta')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header Mejorado -->
        <div class="card-header bg-gradient-forest text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-calendar-alt fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold">Turnos de Corta</h5>
            </div>
            <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createTurnoModal">
                <i class="fas fa-plus me-2"></i>Nuevo Turno
            </button>
        </div>
        
        <!-- Card Body - Tabla Mejorada -->
        <div class="card-body p-0">
            <div class="table-responsive rounded-lg">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-forest text-white">
                        <tr>
                            <th class="py-3 ps-4">ID</th>
                            <th class="py-3">Parcela</th>
                            <th class="py-3">Productor</th>
                            <th class="py-3">Código</th>
                            <th class="py-3">Fecha Corta</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($turnos as $turno)
                        <tr class="border-bottom">
                            <td class="ps-4">{{ $turno->id_turno }}</td>
                            <td class="fw-semibold">{{ $turno->parcela->nom_parcela }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-primary rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user-tie text-primary"></i>
                                    </div>
                                    <span>{{ $turno->parcela->productor->persona->nom ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info">
                                    {{ $turno->codigo_corta ?? 'Sin código' }}
                                </span>
                            </td>
                            <td>
                                {{ $turno->fecha_corta ? \Carbon\Carbon::parse($turno->fecha_corta)->format('d/m/Y') : 'Sin fecha' }}
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-primary rounded-start-pill me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewTurnoModal{{ $turno->id_turno }}">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editTurnoModal{{ $turno->id_turno }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill" 
                                            onclick="confirmDelete('{{ route('turno_cortas.destroy', $turno->id_turno) }}')">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Ver Turno - Nuevo -->
                        <div class="modal fade" id="viewTurnoModal{{ $turno->id_turno }}" tabindex="-1" 
                             aria-labelledby="viewTurnoLabel{{ $turno->id_turno }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-info text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-info-circle me-2"></i>Detalles del Turno
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" 
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">ID Turno:</h6>
                                                <p class="fw-bold">{{ $turno->id_turno }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Fecha Registro:</h6>
                                                <p class="fw-bold">{{ $turno->created_at?->format('d/m/Y H:i') ?? 'Sin fecha' }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Parcela:</h6>
                                                <p class="fw-bold">{{ $turno->parcela->nom_parcela }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Productor:</h6>
                                                <p class="fw-bold">
                                                    {{ $turno->parcela->productor->persona->nom ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Código de Corta:</h6>
                                                <p class="fw-bold">{{ $turno->codigo_corta ?? 'Sin código' }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Fecha de Corta:</h6>
                                                <p class="fw-bold">
                                                    {{ $turno->fecha_corta ? \Carbon\Carbon::parse($turno->fecha_corta)->format('d/m/Y') : 'Sin fecha' }}
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

                        <!-- Modal Editar Turno - Mejorado -->
                        <div class="modal fade" id="editTurnoModal{{ $turno->id_turno }}" tabindex="-1" 
                             aria-labelledby="editTurnoLabel{{ $turno->id_turno }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-primary text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-edit me-2"></i>Editar Turno
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" 
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form method="POST" action="{{ route('turno_cortas.update', $turno->id_turno) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Parcela</label>
                                                <select name="id_parcela" class="form-select border-2" required>
                                                    @foreach ($parcelas as $parcela)
                                                    <option value="{{ $parcela->id_parcela }}" {{ $parcela->id_parcela == $turno->id_parcela ? 'selected' : '' }}>
                                                        {{ $parcela->nom_parcela }} ({{ $parcela->productor->persona->nom ?? 'N/A' }})
                                                    </option>
                                                    @endforeach
                                                </select>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Turno - Mejorado -->
<div class="modal fade" id="createTurnoModal" tabindex="-1" aria-labelledby="createTurnoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle me-2"></i>Nuevo Turno
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('turno_cortas.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted">Parcela</label>
                        <select name="id_parcela" class="form-select border-2" required>
                            <option value="" selected disabled>Seleccione una parcela</option>
                            @foreach ($parcelas as $parcela)
                            <option value="{{ $parcela->id_parcela }}">
                                {{ $parcela->nom_parcela }} ({{ $parcela->productor->persona->nom ?? 'N/A' }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-check-circle me-1"></i>Crear Turno
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(url) {
        Swal.fire({
            title: '¿Confirmar eliminación?',
            text: 'El turno de corta será eliminado permanentemente',
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

    @if(session('register'))
    Swal.fire({
        title: '¡Registro Exitoso!',
        text: 'Turno de corta registrado correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
            popup: 'rounded-3',
            confirmButton: 'btn btn-primary px-4 rounded-pill'
        }
    });
    @endif

    @if(session('modify'))
    Swal.fire({
        title: '¡Actualización Exitosa!',
        text: 'Turno de corta actualizado correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
            popup: 'rounded-3',
            confirmButton: 'btn btn-primary px-4 rounded-pill'
        }
    });
    @endif

    @if(session('destroy'))
    Swal.fire({
        title: '¡Eliminación Exitosa!',
        text: 'Turno de corta eliminado correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
            popup: 'rounded-3',
            confirmButton: 'btn btn-primary px-4 rounded-pill'
        }
    });
    @endif
</script>

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
    
    .icon-sm {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
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
</style>
@endsection