@extends('dashboard')

@section('template_title', 'Asignación de Parcelas a Técnicos')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-map-marked-alt me-2"></i>Asignaciones de Parcelas
            </h5>
            <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createAsignacionModal">
                <i class="fas fa-plus me-2"></i>Nueva Asignación
            </button>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light-primary text-white">
                        <tr>
                            <th class="py-3 ps-4">Técnico</th>
                            <th class="py-3">Parcela</th>
                            <th class="py-3">Productor</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asignaciones as $asignacion)
                        <tr class="border-bottom">
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-primary rounded-circle me-3 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user-tie text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $asignacion->tecnico->persona->nom }} {{ $asignacion->tecnico->persona->ap }}</h6>
                                        <small class="text-muted">ID: {{ $asignacion->tecnico->id_tecnico }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-success rounded-circle me-3 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-map text-success"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $asignacion->parcela->nom_parcela }}</h6>
                                        <small class="text-muted">Área: {{ $asignacion->parcela->area }} ha</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-info rounded-circle me-3 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user text-info"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $asignacion->parcela->productor->persona->nom }} {{ $asignacion->parcela->productor->persona->ap }}</h6>
                                        <small class="text-muted">{{ $asignacion->parcela->productor->persona->tel }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-info rounded-start-pill me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewAsignacionModal{{ $asignacion->id_asigna_p }}">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editAsignacionModal{{ $asignacion->id_asigna_p }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill" 
                                            onclick="confirmDelete({{ $asignacion->id_asigna_p }})">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Ver Asignación -->
                        <div class="modal fade" id="viewAsignacionModal{{ $asignacion->id_asigna_p }}" tabindex="-1" 
                             aria-labelledby="viewAsignacionLabel{{ $asignacion->id_asigna_p }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-info text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-info-circle me-2"></i>Detalles de Asignación
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" 
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Técnico:</h6>
                                                <p class="fw-bold">{{ $asignacion->tecnico->persona->nom }} {{ $asignacion->tecnico->persona->ap }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">ID Técnico:</h6>
                                                <p class="fw-bold">{{ $asignacion->tecnico->id_tecnico }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Parcela:</h6>
                                                <p class="fw-bold">{{ $asignacion->parcela->nom_parcela }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Área:</h6>
                                                <p class="fw-bold">{{ $asignacion->parcela->area }} ha</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Productor:</h6>
                                                <p class="fw-bold">{{ $asignacion->parcela->productor->persona->nom }} {{ $asignacion->parcela->productor->persona->ap }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Teléfono:</h6>
                                                <p class="fw-bold">{{ $asignacion->parcela->productor->persona->tel }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Fecha Asignación:</h6>
                                                <p class="fw-bold">
                                                    {{ $asignacion->created_at ? $asignacion->created_at->format('d/m/Y') : 'Sin fecha' }}
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

                        <!-- Modal Editar Asignación -->
                        <div class="modal fade" id="editAsignacionModal{{ $asignacion->id_asigna_p }}" tabindex="-1" 
                             aria-labelledby="editAsignacionLabel{{ $asignacion->id_asigna_p }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-primary text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-edit me-2"></i>Editar Asignación
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" 
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form method="POST" action="{{ route('asigna_parcelas.update', $asignacion->id_asigna_p) }}">
                                            @csrf @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Técnico</label>
                                                <select name="id_tecnico" class="form-select border-2" required>
                                                    @foreach ($tecnicos as $tecnico)
                                                    <option value="{{ $tecnico->id_tecnico }}" 
                                                            {{ $tecnico->id_tecnico == $asignacion->id_tecnico ? 'selected' : '' }}>
                                                        {{ $tecnico->persona->nom }} {{ $tecnico->persona->ap }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Parcela</label>
                                                <select name="id_parcela" class="form-select border-2" required>
                                                    @foreach ($parcelas as $parcela)
                                                    <option value="{{ $parcela->id_parcela }}" 
                                                            {{ $parcela->id_parcela == $asignacion->id_parcela ? 'selected' : '' }}>
                                                        {{ $parcela->nom_parcela }} ({{ $parcela->productor->persona->nom }})
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

<!-- Modal Crear Asignación -->
<div class="modal fade" id="createAsignacionModal" tabindex="-1" aria-labelledby="createAsignacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus me-2"></i>Nueva Asignación
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('asigna_parcelas.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted">Técnico</label>
                        <select name="id_tecnico" class="form-select border-2" required>
                            <option value="" selected disabled>Seleccione un técnico...</option>
                            @foreach ($tecnicos as $tecnico)
                            <option value="{{ $tecnico->id_tecnico }}">
                                {{ $tecnico->persona->nom }} {{ $tecnico->persona->ap }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Parcela</label>
                        <select name="id_parcela" class="form-select border-2" required>
                            <option value="" selected disabled>Seleccione una parcela...</option>
                            @foreach ($parcelas as $parcela)
                            <option value="{{ $parcela->id_parcela }}">
                                {{ $parcela->nom_parcela }} ({{ $parcela->productor->persona->nom }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-plus-circle me-1"></i>Crear Asignación
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
    function confirmDelete(id) {
        Swal.fire({
            title: '¿Confirmar eliminación?',
            text: 'La asignación será eliminada permanentemente',
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
                form.action = '/asigna_parcelas/' + id;
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
        title: '¡Operación Exitosa!',
        text: 'Asignación registrada correctamente',
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
        text: 'Los datos de la asignación han sido actualizados',
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
        text: 'La asignación ha sido eliminada del sistema',
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
    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--wood-primary), var(--wood-primary-dark));
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8, #138496);
    }
    
    .bg-light-primary { background-color: rgba(44, 94, 26, 0.1); }
    .bg-light-success { background-color: rgba(107, 142, 35, 0.1); }
    .bg-light-info { background-color: rgba(23, 162, 184, 0.1); }
    
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(232, 245, 233, 0.5);
    }
    
    .icon-sm {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .form-select.border-2 {
        border-width: 2px !important;
    }
    
    .border-2 {
        border-width: 2px !important;
    }
</style>
@endsection