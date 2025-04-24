@extends('dashboard')

@section('template_title', 'Gestión de Trozas Forestales')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header Mejorado -->
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-cut fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold">Gestión de Trozas</h5>
            </div>
            <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createTrozaModal">
                <i class="fas fa-plus me-2"></i>Nueva Troza
            </button>
        </div>

        <!-- Card Body - Tabla Mejorada -->
        <div class="card-body p-0">
            <div class="table-responsive rounded-lg">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-primary text-white">
                        <tr>
                            <th class="py-3">Longitud (m)</th>
                            <th class="py-3">Diámetro (m)</th>
                            <th class="py-3">Densidad</th>
                            <th class="py-3">Especie</th>
                            <th class="py-3">Parcela</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trozas as $troza)
                        <tr class="border-bottom">
                            <td class="ps-4">{{ $troza->id_troza }}</td>
                            <td class="fw-semibold">{{ number_format($troza->longitud, 2) }}</td>
                            <td>{{ number_format($troza->diametro, 2) }}</td>
                            <td>{{ number_format($troza->densidad, 2) }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-success rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-tree text-success"></i>
                                    </div>
                                    <span>{{ $troza->especie->nom_cientifico }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-info rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-map text-info"></i>
                                    </div>
                                    <span>{{ $troza->parcela->nom_parcela }}</span>
                                </div>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-info rounded-start-pill me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#viewTrozaModal{{ $troza->id_troza }}">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editTrozaModal{{ $troza->id_troza }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill"
                                            onclick="confirmDelete('{{ route('trozas.destroy', $troza->id_troza) }}')">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Ver Troza - Nuevo -->
                        <div class="modal fade" id="viewTrozaModal{{ $troza->id_troza }}" tabindex="-1"
                             aria-labelledby="viewTrozaLabel{{ $troza->id_troza }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-info text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-info-circle me-2"></i>Detalles de la Troza
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">ID:</h6>
                                                <p class="fw-bold">{{ $troza->id_troza }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Fecha Registro:</h6>
                                                <p class="fw-bold">{{ $troza->created_at?->format('d/m/Y H:i') ?? 'Sin fecha' }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Longitud:</h6>
                                                <p class="fw-bold">{{ number_format($troza->longitud, 2) }} metros</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Diámetro:</h6>
                                                <p class="fw-bold">{{ number_format($troza->diametro, 2) }} metros</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Densidad:</h6>
                                                <p class="fw-bold">{{ number_format($troza->densidad, 2) }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Volumen Estimado:</h6>
                                                <p class="fw-bold">{{ number_format(($troza->diametro/2)**2 * pi() * $troza->longitud * $troza->densidad, 2) }} m³</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Especie:</h6>
                                                <p class="fw-bold">{{ $troza->especie->nom_cientifico }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Parcela:</h6>
                                                <p class="fw-bold">{{ $troza->parcela->nom_parcela }}</p>
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

                        <!-- Modal Editar Troza - Mejorado -->
                        <div class="modal fade" id="editTrozaModal{{ $troza->id_troza }}" tabindex="-1"
                             aria-labelledby="editTrozaLabel{{ $troza->id_troza }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-primary text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-edit me-2"></i>Editar Troza
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form method="POST" action="{{ route('trozas.update', $troza->id_troza) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Longitud (metros)</label>
                                                <input type="number" step="0.01" class="form-control border-2"
                                                       name="longitud" value="{{ number_format($troza->longitud, 2) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Diámetro (metros)</label>
                                                <input type="number" step="0.01" class="form-control border-2"
                                                       name="diametro" value="{{ number_format($troza->diametro, 2) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Densidad</label>
                                                <input type="number" step="0.01" class="form-control border-2"
                                                       name="densidad" value="{{ number_format($troza->densidad, 2) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Especie</label>
                                                <select class="form-select border-2" name="id_especie" required>
                                                    @foreach ($especies as $especie)
                                                    <option value="{{ $especie->id_especie }}"
                                                            {{ $troza->id_especie == $especie->id_especie ? 'selected' : '' }}>
                                                        {{ $especie->nom_cientifico }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Parcela</label>
                                                <select class="form-select border-2" name="id_parcela" required>
                                                    @foreach ($parcelas as $parcela)
                                                    <option value="{{ $parcela->id_parcela }}"
                                                            {{ $troza->id_parcela == $parcela->id_parcela ? 'selected' : '' }}>
                                                        {{ $parcela->nom_parcela }}
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

<!-- Modal Crear Troza - Mejorado -->
<div class="modal fade" id="createTrozaModal" tabindex="-1" aria-labelledby="createTrozaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Troza
                </h5>
                <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('trozas.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted">Diámetro (metros)</label>
                        <input type="number" step="0.01" name="diametro" class="form-control border-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Longitud (metros)</label>
                        <input type="number" step="0.01" name="longitud" class="form-control border-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Densidad</label>
                        <input type="number" step="0.01" name="densidad" class="form-control border-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Especie</label>
                        <select class="form-select border-2" name="id_especie" required>
                            <option value="" selected disabled>Seleccione una especie</option>
                            @foreach ($especies as $especie)
                            <option value="{{ $especie->id_especie }}">{{ $especie->nom_cientifico }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Parcela</label>
                        <select class="form-select border-2" name="id_parcela" required>
                            <option value="" selected disabled>Seleccione una parcela</option>
                            @foreach ($parcelas as $parcela)
                            <option value="{{ $parcela->id_parcela }}">{{ $parcela->nom_parcela }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill"
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-check-circle me-1"></i>Crear Troza
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
            text: 'La troza será eliminada permanentemente',
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
        text: 'Troza registrada correctamente',
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
        text: 'Los datos de la troza han sido actualizados',
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
        text: 'La troza ha sido eliminada del sistema',
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
    }

    .border-2 {
        border-width: 2px !important;
    }
</style>
@endsection
