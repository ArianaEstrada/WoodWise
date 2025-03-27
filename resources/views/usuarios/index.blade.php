@extends('dashboard')

@section('template_title')
Gestión de Usuarios
@endsection

@section('crud_content')
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-forest d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">Gestión de Usuarios</h5>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createUserModal">
                <i class="fas fa-user-plus"></i> Crear Usuario
            </button>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="bg-forest text-white">
                    <tr>
                        <th class="py-3">ID</th>
                        <th class="py-3">Nombre</th>
                        <th class="py-3">Correo</th>
                        <th class="py-3">Teléfono</th>
                        <th class="py-3">Rol</th>
                        <th class="py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personas as $persona)
                    <tr>
                        <td class="py-3">{{ $persona->id_persona }}</td>
                        <td class="py-3">{{ $persona->nom }} {{ $persona->ap }} {{ $persona->am }}</td>
                        <td class="py-3">{{ $persona->correo }}</td>
                        <td class="py-3">{{ $persona->telefono }}</td>
                        <td class="py-3">{{ $persona->rol->nom_rol }}</td>
                        <td class="py-3">
                            <button class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $persona->id_persona }}">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $persona->id_persona }})">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Editar Usuario -->
                    <div class="modal fade" id="editUserModal{{ $persona->id_persona }}" tabindex="-1" aria-labelledby="editUserLabel{{ $persona->id_persona }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-forest text-white">
                                    <h5 class="modal-title">Editar Usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('usuarios.update', $persona->id_persona) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label class="form-label">Nombre</label>
                                            <input type="text" name="nom" class="form-control" value="{{ $persona->nom }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Apellido Paterno</label>
                                            <input type="text" name="ap" class="form-control" value="{{ $persona->ap }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Correo</label>
                                            <input type="email" name="correo" class="form-control" value="{{ $persona->correo }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Teléfono</label>
                                            <input type="text" name="telefono" class="form-control" value="{{ $persona->telefono }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Rol</label>
                                            <select name="id_rol" class="form-select" required>
                                                @foreach ($roles as $rol)
                                                <option value="{{ $rol->id_rol }}" {{ $persona->id_rol == $rol->id_rol ? 'selected' : '' }}>
                                                    {{ $rol->nom_rol }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
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
</div>

<!-- Modal Crear Usuario -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-forest text-white">
                <h5 class="modal-title">Crear Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('usuarios.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellido Paterno</label>
                        <input type="text" name="ap" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="email" name="correo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rol</label>
                        <select name="id_rol" class="form-select" required>
                            @foreach ($roles as $rol)
                            <option value="{{ $rol->id_rol }}">{{ $rol->nom_rol }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Crear</button>
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
            title: '¿Eliminar usuario?',
            text: 'Esta acción no se puede deshacer',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '/usuarios/' + id;
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    @if(session('register'))
    Swal.fire('¡Éxito!', 'Usuario registrado correctamente', 'success');
    @endif

    @if(session('modify'))
    Swal.fire('¡Éxito!', 'Usuario actualizado correctamente', 'success');
    @endif

    @if(session('destroy'))
    Swal.fire('¡Éxito!', 'Usuario eliminado correctamente', 'success');
    @endif
</script>
@endsection
