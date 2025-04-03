@extends('dashboard')

@section('template_title')
Gestión de Técnicos
@endsection

@section('crud_content')
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-forest d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">Gestión de Técnicos</h5>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createTechnicianModal">
                <i class="fas fa-user-plus"></i> Crear Técnico
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
                        <th class="py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tecnicos as $tecnico)
                    <tr>
                        <td class="py-3">{{ $tecnico->id_tecnico }}</td>
                        <td class="py-3">{{ $tecnico->persona->nom }} {{ $tecnico->persona->ap }} {{ $tecnico->persona->am }}</td>
                        <td class="py-3">{{ $tecnico->persona->correo }}</td>
                        <td class="py-3">{{ $tecnico->persona->telefono }}</td>
                        <td class="py-3">
                            <button class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editTechnicianModal{{ $tecnico->id_tecnico }}">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $tecnico->id_tecnico }})">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Editar Técnico -->
                    <div class="modal fade" id="editTechnicianModal{{ $tecnico->id_tecnico }}" tabindex="-1" aria-labelledby="editTechnicianLabel{{ $tecnico->id_tecnico }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-forest text-white">
                                    <h5 class="modal-title">Editar Técnico</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('tecnicos.update', $tecnico->id_tecnico) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label class="form-label">Nombre</label>
                                            <input type="text" name="nom" class="form-control" value="{{ $tecnico->nom }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Apellido Paterno</label>
                                            <input type="text" name="ap" class="form-control" value="{{ $tecnico->ap }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Correo</label>
                                            <input type="email" name="correo" class="form-control" value="{{ $tecnico->correo }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Teléfono</label>
                                            <input type="text" name="telefono" class="form-control" value="{{ $tecnico->telefono }}" required>
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

<!-- Modal Crear Técnico -->
<div class="modal fade" id="createTechnicianModal" tabindex="-1" aria-labelledby="createTechnicianLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-forest text-white">
                <h5 class="modal-title">Crear Nuevo Técnico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('tecnicos.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="id_persona" class="form-label">Seleccionar Persona</label>
                        <select name="id_persona" id="id_persona" class="form-control" required>
                            <option value="" disabled selected>Seleccione una persona...</option>
                            @foreach ($personas as $persona)
                                <option value="{{ $persona->id_persona }}">{{ $persona->nom }} {{ $persona->ap }} {{ $persona->am }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cedula_p" class="form-label">Cédula Profesional</label>
                        <input type="text" name="cedula_p" id="cedula_p" class="form-control">
                    </div>
                    <!-- La clave se genera automáticamente en el controlador -->
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
            title: '¿Eliminar técnico?',
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
                form.action = '/tecnicos/' + id;
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    @if(session('register'))
    Swal.fire('¡Éxito!', 'Técnico registrado correctamente', 'success');
    @endif

    @if(session('modify'))
    Swal.fire('¡Éxito!', 'Técnico actualizado correctamente', 'success');
    @endif

    @if(session('destroy'))
    Swal.fire('¡Éxito!', 'Técnico eliminado correctamente', 'success');
    @endif
</script>
@endsection
