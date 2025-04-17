@extends('dashboard')

@section('template_title')
    Panel de Gestión de Usuarios
@endsection

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-users-cog me-2"></i>Administración de Usuarios
            </h5>
            <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createUserModal">
                <i class="fas fa-user-plus me-2"></i>Nuevo Usuario
            </button>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light-primary text-white">
                        <tr>
                            <th class="py-3 ps-4">ID</th>
                            <th class="py-3">Nombre Completo</th>
                            <th class="py-3">Correo Electrónico</th>
                            <th class="py-3">Teléfono</th>
                            <th class="py-3">Rol</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personas as $persona)
                        <tr class="border-bottom">
                            <td class="ps-4">{{ $persona->id_persona }}</td>
                            <td class="fw-semibold">{{ $persona->nom }} {{ $persona->ap }} {{ $persona->am }}</td>
                            <td>{{ $persona->correo }}</td>
                            <td>{{ $persona->telefono }}</td>
                            <td>
                                <span class="badge bg-{{ $persona->rol->nom_rol == 'Administrador' ? 'primary' : 'success' }} rounded-pill">
                                    {{ $persona->rol->nom_rol }}
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-primary rounded-start-pill me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editUserModal{{ $persona->id_persona }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill" 
                                            onclick="confirmDelete({{ $persona->id_persona }})">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Editar Usuario -->
                        <div class="modal fade" id="editUserModal{{ $persona->id_persona }}" tabindex="-1" 
                             aria-labelledby="editUserLabel{{ $persona->id_persona }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-gradient-primary text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-user-edit me-2"></i>Editar Usuario
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" 
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form method="POST" action="{{ route('usuarios.update', $persona->id_persona) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Nombre</label>
                                                <input type="text" name="nom" class="form-control border-2" 
                                                       value="{{ $persona->nom }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Apellido Paterno</label>
                                                <input type="text" name="ap" class="form-control border-2" 
                                                       value="{{ $persona->ap }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Correo Electrónico</label>
                                                <input type="email" name="correo" class="form-control border-2" 
                                                       value="{{ $persona->correo }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Teléfono</label>
                                                <input type="text" name="telefono" class="form-control border-2" 
                                                       value="{{ $persona->telefono }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted">Rol</label>
                                                <select name="id_rol" class="form-select border-2" required>
                                                    @foreach ($roles as $rol)
                                                    <option value="{{ $rol->id_rol }}" 
                                                            {{ $persona->id_rol == $rol->id_rol ? 'selected' : '' }}>
                                                        {{ $rol->nom_rol }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                                <button type="button" class="btn btn-outline-secondary me-md-2" 
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">
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

<!-- Modal Crear Usuario -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-user-plus me-2"></i>Nuevo Usuario
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('usuarios.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted">Nombre</label>
                        <input type="text" name="nom" class="form-control border-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Apellido Paterno</label>
                        <input type="text" name="ap" class="form-control border-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Correo Electrónico</label>
                        <input type="email" name="correo" class="form-control border-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Teléfono</label>
                        <input type="text" name="telefono" class="form-control border-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Rol</label>
                        <select name="id_rol" class="form-select border-2" required>
                            @foreach ($roles as $rol)
                            <option value="{{ $rol->id_rol }}">{{ $rol->nom_rol }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2" 
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus-circle me-1"></i>Crear Usuario
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
    function confirmDelete(id) {
        Swal.fire({
            title: '¿Confirmar eliminación?',
            text: 'El usuario será eliminado permanentemente',
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
                form.action = '/usuarios/' + id;
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    @if(session('register'))
    Swal.fire({
        title: '¡Operación Exitosa!',
        text: 'Usuario registrado correctamente',
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
        text: 'Los datos del usuario han sido actualizados',
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
        text: 'El usuario ha sido eliminado del sistema',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
            popup: 'rounded-3',
            confirmButton: 'btn btn-primary px-4 rounded-pill'
        }
    });
    @endif
</script>
@endsection