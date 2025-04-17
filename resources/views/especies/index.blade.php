@extends('dashboard')

@section('template_title', 'Catálogo de Especies Forestales')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header Mejorado -->
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-tree fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold">Catálogo de Especies</h5>
            </div>
            <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createEspecieModal">
                <i class="fas fa-plus me-2"></i>Nueva Especie
            </button>
        </div>
        
        <!-- Card Body - Tabla Mejorada -->
        <div class="card-body p-0">
            <div class="table-responsive rounded-lg">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-primary text-white">
                        <tr>
                            <th class="py-3 ps-4">ID</th>
                            <th class="py-3">Nombre Científico</th>
                            <th class="py-3">Nombre Común</th>
                            <th class="py-3">Imagen</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($especies as $especie)
                        <tr class="border-bottom">
                            <td class="ps-4">{{ $especie->id_especie }}</td>
                            <td class="fw-semibold">{{ $especie->nom_cientifico }}</td>
                            <td>{{ $especie->nom_comun }}</td>
                            <td>
                                @if ($especie->imagen)
                                <img src="{{ asset('storage/' . $especie->imagen) }}" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;" alt="{{ $especie->nom_comun }}">
                                @else
                                <span class="badge bg-secondary rounded-pill">Sin imagen</span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-info rounded-start-pill me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewEspecieModal{{ $especie->id_especie }}">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editEspecieModal{{ $especie->id_especie }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill" 
                                            onclick="confirmDelete('{{ route('especies.destroy', $especie->id_especie) }}')">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Ver Especie - Mejorado -->
                        <div class="modal fade" id="viewEspecieModal{{ $especie->id_especie }}" tabindex="-1" 
                             aria-labelledby="viewEspecieLabel{{ $especie->id_especie }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-info text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-info-circle me-2"></i>Detalles de Especie
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" 
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <h6 class="text-muted">ID:</h6>
                                                    <p class="fw-bold">{{ $especie->id_especie }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="text-muted">Nombre Científico:</h6>
                                                    <p class="fw-bold">{{ $especie->nom_cientifico }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="text-muted">Nombre Común:</h6>
                                                    <p class="fw-bold">{{ $especie->nom_comun }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Imagen:</h6>
                                                @if ($especie->imagen)
                                                <img src="{{ asset('storage/' . $especie->imagen) }}" class="img-fluid rounded shadow" alt="{{ $especie->nom_comun }}">
                                                @else
                                                <div class="bg-light p-5 rounded text-center">
                                                    <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                                    <p class="text-muted">No hay imagen disponible</p>
                                                </div>
                                                @endif
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

                        <!-- Modal Editar Especie - Mejorado -->
                        <div class="modal fade" id="editEspecieModal{{ $especie->id_especie }}" tabindex="-1" 
                             aria-labelledby="editEspecieLabel{{ $especie->id_especie }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-primary text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-edit me-2"></i>Editar Especie
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" 
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form method="POST" action="{{ route('especies.update', $especie->id_especie) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Nombre Científico</label>
                                                <input type="text" name="nom_cientifico" class="form-control border-2" 
                                                       value="{{ old('nom_cientifico', $especie->nom_cientifico) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Nombre Común</label>
                                                <input type="text" name="nom_comun" class="form-control border-2" 
                                                       value="{{ old('nom_comun', $especie->nom_comun) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Imagen</label>
                                                <input type="file" name="imagen" class="form-control border-2">
                                                @if ($especie->imagen)
                                                <div class="mt-2">
                                                    <small class="text-muted">Imagen actual:</small>
                                                    <img src="{{ asset('storage/' . $especie->imagen) }}" class="img-thumbnail mt-2" style="width: 100px; height: 100px; object-fit: cover;">
                                                </div>
                                                @endif
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

<!-- Modal Crear Especie - Mejorado -->
<div class="modal fade" id="createEspecieModal" tabindex="-1" aria-labelledby="createEspecieLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Especie
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('especies.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted">Nombre Científico</label>
                        <input type="text" name="nom_cientifico" class="form-control border-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Nombre Común</label>
                        <input type="text" name="nom_comun" class="form-control border-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Imagen</label>
                        <input type="file" name="imagen" class="form-control border-2">
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-check-circle me-1"></i>Crear Especie
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
            text: 'La especie será eliminada permanentemente',
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
        title: '¡Operación Exitosa!',
        text: 'Especie registrada correctamente',
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
        text: 'Los datos de la especie han sido actualizados',
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
        text: 'La especie ha sido eliminada del sistema',
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
    
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(232, 245, 233, 0.5);
    }
    
    .img-thumbnail {
        border-radius: 8px;
        transition: transform 0.3s ease;
    }
    
    .img-thumbnail:hover {
        transform: scale(1.05);
    }
    
    .form-control.border-2, .form-select.border-2 {
        border-width: 2px !important;
    }
    
    .border-2 {
        border-width: 2px !important;
    }
</style>
@endsection