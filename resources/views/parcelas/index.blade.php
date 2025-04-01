@extends('dashboard')

@section('template_title')
Gestión de Parcelas
@endsection

@section('crud_content')
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-forest d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">Gestión de Parcelas</h5>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createParcelaModal">
                <i class="fas fa-plus"></i> Crear Parcela
            </button>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="bg-forest text-white">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>Productor</th>
                        <th>Extensión</th>
                        <th>Dirección</th>
                        <th>Código Postal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parcelas as $parcela)
                    <tr>
                        <td>{{ $parcela->id_parcela }}</td>
                        <td>{{ $parcela->nom_parcela }}</td>
                        <td>{{ $parcela->ubicacion }}</td>
                        <td>{{ $parcela->productor->nombre_completo }}</td>
                        <td>{{ $parcela->extension }}</td>
                        <td>{{ $parcela->direccion }}</td>
                        <td>{{ $parcela->CP }}</td>
                        <td>
                            <!-- Botón Editar -->
                            <button class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editParcelaModal{{ $parcela->id_parcela }}">
                                <i class="fas fa-edit"></i> Editar
                            </button>

                            <!-- Botón Eliminar -->
                            <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $parcela->id_parcela }})">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Editar Parcela -->
                    <div class="modal fade" id="editParcelaModal{{ $parcela->id_parcela }}" tabindex="-1" aria-labelledby="editParcelaLabel{{ $parcela->id_parcela }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-forest text-white">
                                    <h5 class="modal-title">Editar Parcela</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('parcelas.update', $parcela->id_parcela) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="nom_parcela" class="form-label">Nombre Parcela</label>
                                            <input type="text" name="nom_parcela" id="nom_parcela" value="{{ $parcela->nom_parcela }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ubicacion" class="form-label">Ubicación</label>
                                            <input type="text" name="ubicacion" id="ubicacion" value="{{ $parcela->ubicacion }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_productor" class="form-label">Productor</label>
                                            <select name="id_productor" id="id_productor" class="form-control" required>
                                                @foreach ($productores as $productor)
                                                    <option value="{{ $productor->id_productor }}" {{ $productor->id_productor == $parcela->id_productor ? 'selected' : '' }}>
                                                        {{ $productor->nombre_completo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="extension" class="form-label">Extensión</label>
                                            <input type="text" name="extension" id="extension" value="{{ $parcela->extension }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="direccion" class="form-label">Dirección</label>
                                            <textarea name="direccion" id="direccion" rows="3" class="form-control">{{ $parcela->direccion }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="CP" class="form-label">Código Postal</label>
                                            <input type="number" name="CP" id="CP" value="{{ $parcela->CP }}" min=10000 max=99999 class="form-control" required>
                                        </div>

                                        <!-- Botón Actualizar -->
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
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

    <!-- Modal Crear Parcela -->
    <div class="modal fade" id="createParcelaModal" tabindex="-1" aria-labelledby="createParcelaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-forest text-white">
                    <h5 class="modal-title">Crear Nueva Parcela</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('parcelas.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nom_parcela" class="form-label">Nombre Parcela</label>
                            <input type="text" name="nom_parcela" id="nom_parcela" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="ubicacion" class="form-label">Ubicación</label>
                            <input type="text" name="ubicacion" id="ubicacion" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_productor" class="form-label">Productor</label>
                            <select name="id_productor" id="id_productor" class="form-control" required>
                                <option value="" disabled selected>Seleccione un productor...</option>
                                @foreach ($productores as $productor)
                                    <option value="{{ $productor->id_productor }}">{{ $productor->nombre_completo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="extension" class="form-label">Extensión</label>
                            <input type="text" name="extension" id="extension" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <textarea name="direccion" id="direccion" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="CP" class="form-label">Código Postal</label>
                            <input type="number" name="CP" id="CP" min=10000 max=99999 class="form-control" required>
                        </div>

                        <!-- Botón Crear -->
                        <button type="submit" class="btn btn-success">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para eliminar con SweetAlert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Confirmación para eliminar parcela
function confirmDelete(id) {
    Swal.fire({
        title: '¿Eliminar parcela?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let form = document.createElement("form");
            form.method = "POST";
            form.action = "/parcelas/" + id;
            form.innerHTML = '@csrf @method("DELETE")';
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Mostrar alertas de éxito
@if(session('register'))
Swal.fire('¡Éxito!', '{{ session("register") }}', 'success');
@endif

@if(session('modify'))
Swal.fire('¡Éxito!', '{{ session("modify") }}', 'success');
@endif

@if(session('destroy'))
Swal.fire('¡Éxito!', '{{ session("destroy") }}', 'success');
@endif
</script>

@endsection
