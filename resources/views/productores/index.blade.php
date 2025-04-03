@extends('dashboard')

@section('template_title', 'Gestión de Productores')

@section('crud_content')
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center bg-forest text-white">
            <h5 class="mb-0">Lista de Productores</h5>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createProductorModal">Agregar</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="bg-forest text-white">
                        <tr>
                            <th>Persona Asociada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productores as $productor)
                        <tr>
                            <td>{{ $productor->persona->nom }} {{ $productor->persona->ap }} {{ $productor->persona->am }}</td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProductorModal{{ $productor->id_productor }}">Editar</button>

                                <!-- Formulario para eliminar productor -->
                                <form action="{{ route('productores.destroy', $productor->id_productor) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este productor?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal de edición -->
                        <div class="modal fade" id="editProductorModal{{ $productor->id_productor }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-forest text-white">
                                        <h5 class="modal-title">Editar Productor</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('productores.update', $productor->id_productor) }}">
                                            @csrf @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label">Persona Asociada</label>
                                                <select name="id_persona" class="form-control" required>
                                                    @foreach ($personas as $persona)
                                                    <option value="{{ $persona->id_persona }}" {{ $persona->id_persona == $productor->id_persona ? 'selected' : '' }}>
                                                        {{ $productor->persona->nom }} {{ $productor->persona->ap }} {{ $productor->persona->am }}
                                                    </option>
                                                    @endforeach
                                                </select>
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

<!-- Modal Crear Productor -->
<div class="modal fade" id="createProductorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-forest text-white">
                <h5 class="modal-title">Crear Productor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('productores.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Persona Asociada</label>
                        <select name="id_persona" class="form-control" required>
                            @foreach ($personas as $persona)
                            <option value="{{ $persona->id_persona }}">{{ $productor->persona->nom }} {{ $productor->persona->ap }} {{ $productor->persona->am }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
