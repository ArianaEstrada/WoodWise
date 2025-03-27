@extends('dashboard')

@section('template_title')
Gestión de Fórmulas
@endsection

@section('crud_content')
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center bg-forest text-white">
            <h5 class="mb-0">Lista de Fórmulas</h5>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createFormulaModal">
                Agregar Fórmula
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="bg-forest text-white">
                        <tr>
                            <th class="py-3">ID</th>
                            <th class="py-3">Nombre</th>
                            <th class="py-3">Expresión</th>
                            <th class="py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($formulas as $formula)
                        <tr>
                            <td class="py-3">{{ $formula->id_formula }}</td>
                            <td class="py-3">{{ $formula->nom_formula }}</td>
                            <td class="py-3">{{ $formula->expresion }}</td>
                            <td class="py-3">
                                <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#viewFormulaModal{{ $formula->id_formula }}">Ver</button>
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editFormulaModal{{ $formula->id_formula }}">Editar</button>
                                <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ route('formulas.destroy', $formula->id_formula) }}')">Eliminar</button>
                            </td>
                        </tr>
                        <!-- Modal Ver Fórmula -->
                        <div class="modal fade" id="viewFormulaModal{{ $formula->id_formula }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-forest text-white">
                                        <h5 class="modal-title">Detalles de la Fórmula</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>ID:</strong> {{ $formula->id_formula }}</p>
                                        <p><strong>Nombre:</strong> {{ $formula->nom_formula }}</p>
                                        <p><strong>Expresión:</strong> {{ $formula->expresion }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Editar Fórmula -->
                        <div class="modal fade" id="editFormulaModal{{ $formula->id_formula }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-forest text-white">
                                        <h5 class="modal-title">Editar Fórmula</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('formulas.update', $formula->id_formula) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label">Nombre</label>
                                                <input type="text" name="nom_formula" class="form-control" value="{{ old('nom_formula', $formula->nom_formula) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Expresión</label>
                                                <input type="text" name="expresion" class="form-control" value="{{ old('expresion', $formula->expresion) }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-success">Actualizar</button>
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
<!-- Modal Crear Fórmula -->
<div class="modal fade" id="createFormulaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-forest text-white">
                <h5 class="modal-title">Crear Nueva Fórmula</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('formulas.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nom_formula" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Expresión</label>
                        <input type="text" name="expresion" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(url) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            _method: 'DELETE'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire('Eliminado', 'La fórmula ha sido eliminada.', 'success')
                            .then(() => location.reload());
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    }
</script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif
@endsection
