@extends('dashboard')

@section('template_title')
Gestión de Turnos de Corta
@endsection

@section('crud_content')
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-forest d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">Gestión de Turnos de Corta</h5>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createTurnoModal">
                <i class="fas fa-plus"></i> Crear Turno
            </button>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="bg-forest text-white">
                    <tr>
                        <th>ID</th>
                        <th>Parcela</th>
                        <th>Código de Corta</th>
                        <th>Fecha de Corta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turnos as $turno)
                    <tr>
                        <td>{{ $turno->id_turno }}</td>
                        <td>{{ $turno->parcela->nom_parcela }}</td>
                        <td>{{ $turno->codigo_corta }}</td>
                        <td>{{ $turno->fecha_corta }}</td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editTurnoModal{{ $turno->id_turno }}">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $turno->id_turno }})">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Editar Turno -->
                    <div class="modal fade" id="editTurnoModal{{ $turno->id_turno }}" tabindex="-1" aria-labelledby="editTurnoLabel{{ $turno->id_turno }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-forest text-white">
                                    <h5 class="modal-title">Editar Turno de Corta</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('turno_cortas.update', $turno->id_turno) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="id_parcela" class="form-label">Parcela</label>
                                            <select name="id_parcela" id="id_parcela" class="form-control" required>
                                                @foreach ($parcelas as $parcela)
                                                <option value="{{ $parcela->id_parcela }}" {{ $turno->id_parcela == $parcela->id_parcela ? 'selected' : '' }}>
                                                    {{ $parcela->nom_parcela }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="codigo_corta" class="form-label">Código de Corta</label>
                                            <input type="text" name="codigo_corta" id="codigo_corta" class="form-control" value="{{ $turno->codigo_corta }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="fecha_corta" class="form-label">Fecha de Corta</label>
                                            <input type="date" name="fecha_corta" id="fecha_corta" class="form-control" value="{{ $turno->fecha_corta }}" required>
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

    <!-- Modal Crear Turno -->
    <div class="modal fade" id="createTurnoModal" tabindex="-1" aria-labelledby="createTurnoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-forest text-white">
                    <h5 class="modal-title">Crear Nuevo Turno de Corta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('turno_cortas.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="id_parcela" class="form-label">Parcela</label>
                            <select name="id_parcela" id="id_parcela" class="form-control" required>
                                <option value="" disabled selected>Seleccione una parcela</option>
                                @foreach ($parcelas as $parcela)
                                <option value="{{ $parcela->id_parcela }}">{{ $parcela->nom_parcela }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="codigo_corta" class="form-label">Código de Corta</label>
                            <input type="text" name="codigo_corta" id="codigo_corta" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_corta" class="form-label">Fecha de Corta</label>
                            <input type="date" name="fecha_corta" id="fecha_corta" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: '¿Eliminar turno de corta?',
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
                form.action = '/turno_cortas/' + id;
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    @if(session('register'))
    Swal.fire('¡Éxito!', 'Turno de corta registrado correctamente', 'success');
    @endif

    @if(session('modify'))
    Swal.fire('¡Éxito!', 'Turno de corta actualizado correctamente', 'success');
    @endif

    @if(session('destroy'))
    Swal.fire('¡Éxito!', 'Turno de corta eliminado correctamente', 'success');
    @endif
</script>
@endsection
