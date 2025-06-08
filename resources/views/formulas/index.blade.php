@extends('dashboard')

@section('template_title', 'Gestión de Fórmulas de Cálculo')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header -->
        <div class="card-header bg-gradient-forest text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-square-root-alt fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold text-white">Lista de Fórmulas</h5>
            </div>
            <div class="d-flex">
                <button class="btn btn-light rounded-pill me-2" data-bs-toggle="modal" data-bs-target="#createFormulaModal">
                    <i class="fas fa-plus me-2"></i>Agregar Fórmula
                </button>
                <button class="btn btn-outline-light rounded-pill" data-bs-toggle="modal" data-bs-target="#helpFormulaModal">
                    <i class="fas fa-question-circle me-2"></i>Ayuda
                </button>
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="card-body p-0">
            <!-- Filtros y Búsqueda -->
            <div class="p-3 border-bottom bg-light">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar fórmulas...">
                    </div>
                    <div class="col-md-3">
                        <select id="filterType" class="form-select">
                            <option value="">Todos los tipos</option>
                            @foreach($tiposEstimacion as $tipo)
                                <option value="{{ $tipo->id_tipo_e }}">{{ $tipo->desc_estimacion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="filterCatalog" class="form-select">
                            <option value="">Todos los catálogos</option>
                            @foreach($catalogos as $catalogo)
                                <option value="{{ $catalogo->id_cat }}">{{ $catalogo->nom_cat }}</option>
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
                <table class="table table-hover align-middle mb-0" id="formulasTable">
                    <thead class="bg-light-forest text-white">
                        <tr>
                            <th class="py-3 ps-4">ID</th>
                            <th class="py-3">Nombre</th>
                            <th class="py-3">Tipo</th>
                            <th class="py-3">Catálogo</th>
                            <th class="py-3">Expresión</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($formulas as $formula)
                        <tr class="border-bottom" data-type="{{ $formula->id_tipo_e }}" data-catalog="{{ $formula->id_cat }}">
                            <td class="ps-4">{{ $formula->id_formula }}</td>
                            <td class="fw-semibold">{{ $formula->nom_formula }}</td>
                            <td>
                                <span class="badge bg-success">{{ $formula->tipoEstimacion->desc_estimacion }}</span>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $formula->catalogo->nom_cat }}</span>
                            </td>
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
                                            onclick="confirmDelete('{{ route('formulas.destroy', $formula->id_formula) }}', '{{ $formula->nom_formula }}')">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No se encontraron fórmulas</h5>
                                    <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createFormulaModal">
                                        <i class="fas fa-plus me-1"></i> Crear primera fórmula
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Paginación -->
                @if($formulas->hasPages())
                <div class="p-3 border-top">
                    {{ $formulas->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal de Ayuda -->
<div class="modal fade" id="helpFormulaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-question-circle me-2"></i>Ayuda - Fórmulas Matemáticas
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold">Operadores permitidos:</h6>
                        <ul class="list-unstyled">
                            <li><code>+</code> Suma</li>
                            <li><code>-</code> Resta</li>
                            <li><code>*</code> Multiplicación</li>
                            <li><code>/</code> División</li>
                            <li><code>^</code> Potencia</li>
                            <li><code>()</code> Paréntesis para agrupación</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold">Variables comunes:</h6>
                        <ul class="list-unstyled">
                            <li><code>DAP</code>: Diámetro a la altura del pecho</li>
                            <li><code>altura</code>: Altura del árbol</li>
                            <li><code>factor</code>: Factor de conversión</li>
                        </ul>
                    </div>
                </div>
                <hr>
                <h6 class="fw-bold">Ejemplos:</h6>
                <div class="bg-light p-3 rounded mb-3">
                    <p class="mb-1"><strong>Volumen cilíndrico:</strong></p>
                    <code>(DAP^2 * 0.7854 * altura)</code>
                    
                    <p class="mb-1 mt-3"><strong>Volumen con factor de forma:</strong></p>
                    <code>(DAP^2 * 0.7854 * altura * 0.7)</code>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary rounded-pill" data-bs-dismiss="modal">Entendido</button>
            </div>
        </div>
    </div>
</div>

<!-- Modales para cada fórmula -->
@foreach ($formulas as $formula)
<!-- Modal Ver Fórmula -->
<div class="modal fade" id="viewFormulaModal{{ $formula->id_formula }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title">Detalles de Fórmula</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">ID:</h6>
                        <p class="fw-bold">{{ $formula->id_formula }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Fecha Creación:</h6>
                        <p class="fw-bold">{{ $formula->formattedCreatedAt }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Nombre:</h6>
                        <p class="fw-bold">{{ $formula->nom_formula }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Tipo:</h6>
                        <p class="fw-bold">{{ $formula->tipoEstimacion->desc_estimacion }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Catálogo:</h6>
                        <p class="fw-bold">{{ $formula->catalogo->nom_cat }}</p>
                    </div>
                </div>
                <div class="mb-3">
                    <h6 class="text-muted">Expresión Matemática:</h6>
                    <div class="bg-light p-3 rounded">
                        <code class="fs-5">{{ $formula->expresion }}</code>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Fórmula -->
<div class="modal fade" id="editFormulaModal{{ $formula->id_formula }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">Editar Fórmula</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('formulas.update', $formula->id_formula) }}" id="editForm{{ $formula->id_formula }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="nom_formula" class="form-control border-2" 
                               value="{{ old('nom_formula', $formula->nom_formula) }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipo de Estimación <span class="text-danger">*</span></label>
                            <select name="id_tipo_e" class="form-select border-2" required>
                                @foreach($tiposEstimacion as $tipo)
                                    <option value="{{ $tipo->id_tipo_e }}" {{ $formula->id_tipo_e == $tipo->id_tipo_e ? 'selected' : '' }}>
                                        {{ $tipo->desc_estimacion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Catálogo <span class="text-danger">*</span></label>
                            <select name="id_cat" class="form-select border-2" required>
                                @foreach($catalogos as $catalogo)
                                    <option value="{{ $catalogo->id_cat }}" {{ $formula->id_cat == $catalogo->id_cat ? 'selected' : '' }}>
                                        {{ $catalogo->nom_cat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Expresión Matemática <span class="text-danger">*</span></label>
                        <textarea name="expresion" class="form-control border-2" rows="3" 
                                  id="expresionEdit{{ $formula->id_formula }}" required>{{ old('expresion', $formula->expresion) }}</textarea>
                        <div class="d-flex justify-content-between mt-1">
                            <small class="text-muted">Operadores: + - * / ^ ( )</small>
                            <button type="button" class="btn btn-sm btn-outline-secondary" 
                                    onclick="testExpression('expresionEdit{{ $formula->id_formula }}')">
                                <i class="fas fa-check me-1"></i> Probar expresión
                            </button>
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

<!-- Modal Crear Fórmula -->
<div class="modal fade" id="createFormulaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">Nueva Fórmula</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('formulas.store') }}" id="createFormulaForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="nom_formula" class="form-control border-2" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipo de Estimación <span class="text-danger">*</span></label>
                            <select name="id_tipo_e" class="form-select border-2" required>
                                @foreach($tiposEstimacion as $tipo)
                                    <option value="{{ $tipo->id_tipo_e }}">{{ $tipo->desc_estimacion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Catálogo <span class="text-danger">*</span></label>
                            <select name="id_cat" class="form-select border-2" required>
                                @foreach($catalogos as $catalogo)
                                    <option value="{{ $catalogo->id_cat }}">{{ $catalogo->nom_cat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Expresión Matemática <span class="text-danger">*</span></label>
                        <textarea name="expresion" class="form-control border-2" rows="3" 
                                  id="expresionCreate" required></textarea>
                        <div class="d-flex justify-content-between mt-1">
                            <small class="text-muted">Operadores: + - * / ^ ( )</small>
                            <button type="button" class="btn btn-sm btn-outline-secondary" 
                                    onclick="testExpression('expresionCreate')">
                                <i class="fas fa-check me-1"></i> Probar expresión
                            </button>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-check-circle me-1"></i> Crear Fórmula
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.7.0/math.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filtrado y búsqueda
    const searchInput = document.getElementById('searchInput');
    const filterType = document.getElementById('filterType');
    const filterCatalog = document.getElementById('filterCatalog');
    const resetFilters = document.getElementById('resetFilters');
    const formulasTable = document.getElementById('formulasTable');
    
    function filterFormulas() {
        const searchTerm = searchInput.value.toLowerCase();
        const typeFilter = filterType.value;
        const catalogFilter = filterCatalog.value;
        
        document.querySelectorAll('#formulasTable tbody tr').forEach(row => {
            const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const type = row.getAttribute('data-type');
            const catalog = row.getAttribute('data-catalog');
            const expression = row.querySelector('code').textContent.toLowerCase();
            
            const matchesSearch = name.includes(searchTerm) || expression.includes(searchTerm);
            const matchesType = typeFilter === '' || type === typeFilter;
            const matchesCatalog = catalogFilter === '' || catalog === catalogFilter;
            
            row.style.display = (matchesSearch && matchesType && matchesCatalog) ? '' : 'none';
        });
    }
    
    searchInput.addEventListener('input', filterFormulas);
    filterType.addEventListener('change', filterFormulas);
    filterCatalog.addEventListener('change', filterFormulas);
    resetFilters.addEventListener('click', function() {
        searchInput.value = '';
        filterType.value = '';
        filterCatalog.value = '';
        filterFormulas();
    });
    
    // Validación de expresiones matemáticas
    window.testExpression = function(textareaId) {
        const textarea = document.getElementById(textareaId);
        const expression = textarea.value.trim();
        
        if (!expression) {
            Swal.fire({
                icon: 'warning',
                title: 'Expresión vacía',
                text: 'Por favor ingrese una expresión matemática',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Entendido'
            });
            return;
        }
        
        try {
            // Reemplazar variables comunes por valores de prueba
            const testExpression = expression
                .replace(/DAP/g, '1.5')
                .replace(/altura/g, '10')
                .replace(/factor/g, '0.7');
            
            const result = math.evaluate(testExpression);
            
            Swal.fire({
                icon: 'success',
                title: 'Expresión válida',
                html: `La expresión se evaluó correctamente:<br><br>
                       <code>${expression}</code><br><br>
                       Resultado con valores de prueba:<br>
                       <strong>${result}</strong>`,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Entendido'
            });
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error en la expresión',
                html: `La expresión contiene errores:<br><br>
                       <code>${expression}</code><br><br>
                       Error: <strong>${error.message}</strong>`,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Entendido'
            });
        }
    };
    
    // Confirmación de eliminación
    window.confirmDelete = function(url, formulaName) {
        Swal.fire({
            title: '¿Confirmar eliminación?',
            html: `La fórmula <strong>${formulaName}</strong> será eliminada permanentemente`,
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
    .bg-light-forest {
        background-color: rgba(46, 125, 50, 0.9);
    }
    .bg-gradient-forest {
        background: linear-gradient(135deg, #2e7d32, #1b5e20);
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
    
    .badge.bg-success {
        background-color: #2e7d32 !important;
    }
    
    .badge.bg-info {
        background-color: #0288d1 !important;
    }
</style>
@endsection