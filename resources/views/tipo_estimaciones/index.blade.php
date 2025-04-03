@extends('dashboard')

@section('template_title', 'Gestión de Tipos de Estimaciones')

@section('crud_content')
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center bg-forest text-white">
            <h5 class="mb-0">Lista de Tipos de Estimaciones</h5>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createTipoModal">Agregar</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="bg-forest text-white">
                        <tr>
                            <th>ID</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tipo_estimaciones as $tipo)
                        <tr>
                            <td>{{ $tipo->id_tipo_e }}</td>
                            <td>{{ $tipo->desc_estimacion }}</td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editTipoModal{{ $tipo->id_tipo_e }}">Editar</button>
                                <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ route('tipo_estimaciones.destroy', $tipo->id_tipo_e) }}')">Eliminar</button>
                            </td>
                        </tr>
                        <div class="modal fade" id="editTipoModal{{ $tipo->id_tipo_e }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-forest text-white">
                                        <h5 class="modal-title">Editar Tipo</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('tipo_estimaciones.update', $tipo->id_tipo_e) }}">
                                            @csrf @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label">Nombre</label>
                                                <input type="text" name="desc_estimacion" class="form-control" value="{{ old('nombre', $tipo->nombre) }}" required>
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
<div class="modal fade" id="createTipoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-forest text-white">
                <h5 class="modal-title">Crear Tipo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('tipo_estimaciones.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="desc_estimacion" class="form-control" required>
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
                        body: JSON.stringify({ _method: 'DELETE' })
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire('Eliminado', 'El tipo ha sido eliminado.', 'success')
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