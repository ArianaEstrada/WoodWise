@extends('dashboard')

@section('template_title', 'Gestión de Fórmulas de Cálculo')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header Mejorado -->
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-square-root-alt fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold">Lista de Fórmulas</h5>
            </div>
            <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createFormulaModal">
                <i class="fas fa-plus me-2"></i>Agregar Fórmula
            </button>
        </div>
        
        <!-- Card Body - Tabla Mejorada -->
        <div class="card-body p-0">
            <div class="table-responsive rounded-lg">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-primary text-white">
                        <tr>
                            <th class="py-3 ps-4">ID</th>
                            <th class="py-3">Nombre</th>
                            <th class="py-3">Expresión</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($formulas as $formula)
                        <tr class="border-bottom">
                            <td class="ps-4">{{ $formula->id_formula }}</td>
                            <td class="fw-semibold">{{ $formula->nom_formula }}</td>
                            <td>
                                <code class="bg-light p-2 rounded">{{ $formula->expresion }}</code>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-info rounded-start-pill me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewFormulaModal{{ $formula->id_formula }}">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editFormulaModal{{ $formula->id_formula }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill" 
                                            onclick="confirmDelete('{{ route('formulas.destroy', $formula->id_formula) }}')">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Ver Fórmula - Mejorado -->
                        <div class="modal fade" id="viewFormulaModal{{ $formula->id_formula }}" tabindex="-1" 
                             aria-labelledby="viewFormulaLabel{{ $formula->id_formula }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-info text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-info-circle me-2"></i>Detalles de Fórmula
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" 
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <h6 class="text-muted">ID:</h6>
                                                <p class="fw-bold">{{ $formula->id_formula }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">Fecha Creación:</h6>
                                                <p class="fw-bold">
                                                    {{ $formula->created_at?->format('d/m/Y H:i') ?? 'Fecha no disponible' }}
                                                </p>
                                                                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <h6 class="text-muted">Nombre:</h6>
                                            <p class="fw-bold">{{ $formula->nom_formula }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <h6 class="text-muted">Expresión Matemática:</h6>
                                            <div class="bg-light p-3 rounded">
                                                <code class="fs-5">{{ $formula->expresion }}</code>
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

                        <!-- Modal Editar Fórmula - Mejorado -->
                        <div class="modal fade" id="editFormulaModal{{ $formula->id_formula }}" tabindex="-1" 
                             aria-labelledby="editFormulaLabel{{ $formula->id_formula }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-primary text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-edit me-2"></i>Editar Fórmula
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" 
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form method="POST" action="{{ route('formulas.update', $formula->id_formula) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Nombre</label>
                                                <input type="text" name="nom_formula" class="form-control border-2" 
                                                       value="{{ old('nom_formula', $formula->nom_formula) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Expresión Matemática</label>
                                                <textarea name="expresion" class="form-control border-2" rows="3" required>{{ old('expresion', $formula->expresion) }}</textarea>
                                                <small class="text-muted">Ejemplo: (DAP^2 * 0.7854 * altura * 0.7)</small>
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

<!-- Modal Crear Fórmula - Mejorado -->
<div class="modal fade" id="createFormulaModal" tabindex="-1" aria-labelledby="createFormulaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Fórmula
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('formulas.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted">Nombre</label>
                        <input type="text" name="nom_formula" class="form-control border-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Expresión Matemática</label>
                        <textarea name="expresion" class="form-control border-2" rows="3" required></textarea>
                        <small class="text-muted">Ejemplo: (DAP^2 * 0.7854 * altura * 0.7)</small>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-check-circle me-1"></i>Crear Fórmula
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
            text: 'La fórmula será eliminada permanentemente',
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
        text: 'Fórmula registrada correctamente',
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
        text: 'Los datos de la fórmula han sido actualizados',
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
        text: 'La fórmula ha sido eliminada del sistema',
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
    
    code {
        font-family: 'Courier New', Courier, monospace;
        color: #d63384;
        background-color: rgba(214, 51, 132, 0.1);
        padding: 0.2em 0.4em;
        border-radius: 4px;
    }
    
    .form-control.border-2, .form-select.border-2 {
        border-width: 2px !important;
    }
    
    .border-2 {
        border-width: 2px !important;
    }
</style>
@endsection