@extends('tecnicos.dashboard')

@section('template_title', 'Gestión de Parcelas')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header Mejorado -->
        <div class="card-header bg-gradient-forest text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-map-marked-alt fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold text-white">Gestión de Parcelas</h5>
            </div>
            <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createParcelaModal">
                <i class="fas fa-plus me-2"></i>Nueva Parcela
            </button>
        </div>

        <!-- Card Body - Tabla Mejorada -->
        <div class="card-body p-0">
            <div class="table-responsive rounded-lg">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-forest text-white">
                        <tr>
                            <th class="py-3">Nombre</th>
                            <th class="py-3">Ubicación</th>
                            <th class="py-3">Productor</th>
                            <th class="py-3">Extensión</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parcelas as $parcela)
                        <tr class="border-bottom">
                            <td class="ps-4">{{ $parcela->id_parcela }}</td>
                            <td class="fw-semibold">{{ $parcela->nom_parcela }}</td>
                            <td>{{ $parcela->ubicacion }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-light-primary rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user-tie text-primary"></i>
                                    </div>
                                    <span>{{ $parcela->productor->persona->nom }} {{ $parcela->productor->persona->ap }} {{ $parcela->productor->persona->am }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info">
                                    {{ $parcela->extension }} ha
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-primary rounded-start-pill me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#viewParcelaModal{{ $parcela->id_parcela }}">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editParcelaModal{{ $parcela->id_parcela }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill"
                                            onclick="confirmDelete('{{ route('parcelas.destroy', $parcela->id_parcela) }}')">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Ver Parcela - Nuevo -->
                        <div class="modal fade" id="viewParcelaModal{{ $parcela->id_parcela }}" tabindex="-1"
                             aria-labelledby="viewParcelaLabel{{ $parcela->id_parcela }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-info text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-info-circle me-2"></i>Detalles de la Parcela
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">ID:</h6>
                                                <p class="fw-bold">{{ $parcela->id_parcela }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Fecha Registro:</h6>
                                                <p class="fw-bold">{{ $parcela->created_at?->format('d/m/Y H:i') ?? 'Sin fecha' }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Nombre:</h6>
                                                <p class="fw-bold">{{ $parcela->nom_parcela }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Ubicación:</h6>
                                                <p class="fw-bold">{{ $parcela->ubicacion }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Productor:</h6>
                                                <p class="fw-bold">
                                                    {{ $parcela->productor->persona->nom }} {{ $parcela->productor->persona->ap }} {{ $parcela->productor->persona->am }}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Extensión:</h6>
                                                <p class="fw-bold">{{ $parcela->extension }} hectáreas</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <h6 class="text-muted">Dirección:</h6>
                                                <p class="fw-bold">{{ $parcela->direccion }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Código Postal:</h6>
                                                <p class="fw-bold">{{ $parcela->CP }}</p>
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

                        <!-- Modal Editar Parcela - Mejorado -->
                        <div class="modal fade" id="editParcelaModal{{ $parcela->id_parcela }}" tabindex="-1"
                             aria-labelledby="editParcelaLabel{{ $parcela->id_parcela }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-primary text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-edit me-2"></i>Editar Parcela
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form method="POST" action="{{ route('parcelas.update', $parcela->id_parcela) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Nombre Parcela</label>
                                                <input type="text" name="nom_parcela" class="form-control border-2"
                                                       value="{{ $parcela->nom_parcela }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Ubicación</label>
                                                <input type="text" name="ubicacion" class="form-control border-2"
                                                       value="{{ $parcela->ubicacion }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Productor</label>
                                                <select name="id_productor" class="form-select border-2" required>
                                                    @foreach ($productores as $productor)
                                                    <option value="{{ $productor->id_productor }}" {{ $productor->id_productor == $parcela->id_productor ? 'selected' : '' }}>
                                                        {{ $productor->persona->nom }} {{ $productor->persona->ap }} {{ $productor->persona->am }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Extensión (hectáreas)</label>
                                                <input type="number" step="0.01" name="extension" class="form-control border-2"
                                                       value="{{ $parcela->extension }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Dirección</label>
                                                <textarea name="direccion" rows="3" class="form-control border-2">{{ $parcela->direccion }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Código Postal</label>
                                                <input type="number" name="CP" min="10000" max="99999" class="form-control border-2"
                                                       value="{{ $parcela->CP }}" required>
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

<!-- Modal Crear Parcela - Mejorado -->
<div class="modal fade" id="createParcelaModal" tabindex="-1" aria-labelledby="createParcelaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Parcela
                </h5>
                <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('parcelas.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted">Nombre Parcela</label>
                        <input type="text" name="nom_parcela" class="form-control border-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Ubicación</label>
                        <input type="text" name="ubicacion" class="form-control border-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Productor</label>
                        <select name="id_productor" class="form-select border-2" required>
                            <option value="" selected disabled>Seleccione un productor</option>
                            @foreach ($productores as $productor)
                            <option value="{{ $productor->id_productor }}">
                                {{ $productor->persona->nom }} {{ $productor->persona->ap }} {{ $productor->persona->am }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Extensión (hectáreas)</label>
                        <input type="number" step="0.01" name="extension" class="form-control border-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Dirección</label>
                        <textarea name="direccion" rows="3" class="form-control border-2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Código Postal</label>
                        <input type="number" name="CP" min="10000" max="99999" class="form-control border-2" required>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill"
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-check-circle me-1"></i>Crear Parcela
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
            text: 'La parcela será eliminada permanentemente',
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
        text: '{{ session('register') }}',
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
        text: '{{ session('modify') }}',
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
        text: '{{ session('destroy') }}',
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
