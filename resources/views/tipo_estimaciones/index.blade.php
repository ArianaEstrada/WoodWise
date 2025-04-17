@extends('dashboard')

@section('template_title', 'Gestión de Tipos de Estimaciones')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header Mejorado -->
        <div class="card-header bg-gradient-forest text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-calculator fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold">Tipos de Estimaciones</h5>
            </div>
            <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createTipoModal">
                <i class="fas fa-plus me-2"></i>Nuevo Tipo
            </button>
        </div>
        
        <!-- Card Body - Tabla Mejorada -->
        <div class="card-body p-0">
            <div class="table-responsive rounded-lg">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-forest text-white">
                        <tr>
                            <th class="py-3 ps-4">ID</th>
                            <th class="py-3">Descripción</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tipo_estimaciones as $tipo)
                        <tr class="border-bottom">
                            <td class="ps-4">{{ $tipo->id_tipo_e }}</td>
                            <td class="fw-semibold">{{ $tipo->desc_estimacion }}</td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-primary rounded-start-pill me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewTipoModal{{ $tipo->id_tipo_e }}">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editTipoModal{{ $tipo->id_tipo_e }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill" 
                                            onclick="confirmDelete('{{ route('tipo_estimaciones.destroy', $tipo->id_tipo_e) }}')">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Ver Tipo - Nuevo -->
                        <div class="modal fade" id="viewTipoModal{{ $tipo->id_tipo_e }}" tabindex="-1" 
                             aria-labelledby="viewTipoLabel{{ $tipo->id_tipo_e }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-info text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-info-circle me-2"></i>Detalles del Tipo
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" 
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">ID:</h6>
                                                <p class="fw-bold">{{ $tipo->id_tipo_e }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Fecha Registro:</h6>
                                                <p class="fw-bold">{{ $tipo->created_at?->format('d/m/Y H:i') ?? 'Sin fecha' }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <h6 class="text-muted">Descripción:</h6>
                                                <p class="fw-bold">{{ $tipo->desc_estimacion }}</p>
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

                        <!-- Modal Editar Tipo - Mejorado -->
                        <div class="modal fade" id="editTipoModal{{ $tipo->id_tipo_e }}" tabindex="-1" 
                             aria-labelledby="editTipoLabel{{ $tipo->id_tipo_e }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-primary text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-edit me-2"></i>Editar Tipo
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" 
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form method="POST" action="{{ route('tipo_estimaciones.update', $tipo->id_tipo_e) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Descripción</label>
                                                <input type="text" class="form-control border-2" 
                                                       name="desc_estimacion" value="{{ old('desc_estimacion', $tipo->desc_estimacion) }}" required>
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

<!-- Modal Crear Tipo - Mejorado -->
<div class="modal fade" id="createTipoModal" tabindex="-1" aria-labelledby="createTipoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle me-2"></i>Nuevo Tipo
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('tipo_estimaciones.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted">Descripción</label>
                        <input type="text" name="desc_estimacion" class="form-control border-2" required>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-check-circle me-1"></i>Crear Tipo
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
            text: 'El tipo de estimación será eliminado permanentemente',
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
</style>
@endsection