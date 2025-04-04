@extends('dashboard')

@section('template_title', 'Asignación de Parcelas a Técnicos')

@section('crud_content')
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center bg-forest text-white">
            <h5 class="mb-0">Asignaciones de Parcelas</h5>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createAsignacionModal">Nueva Asignación</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="bg-forest text-white">
                        <tr>
                            <th>Técnico</th>
                            <th>Parcela</th>
                            <th>Productor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asignaciones as $asignacion)
                        <tr>
                            <td>{{ $asignacion->tecnico->persona->nom }} {{ $asignacion->tecnico->persona->ap }}</td>
                            <td>{{ $asignacion->parcela->nom_parcela }}</td>
                            <td>{{ $asignacion->parcela->productor->persona->nom }} {{ $asignacion->parcela->productor->persona->ap }}</td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editAsignacionModal{{ $asignacion->id_asigna_p }}">Editar</button>

                                <form action="{{ route('asigna_parcelas.destroy', $asignacion->id_asigna_p) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta asignación?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal de edición -->
                        <div class="modal fade" id="editAsignacionModal{{ $asignacion->id_asigna_p }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-forest text-white">
                                        <h5 class="modal-title">Editar Asignación</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('asigna_parcelas.update', $asignacion->id_asigna_p) }}">
                                            @csrf @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label">Técnico</label>
                                                <select name="id_tecnico" class="form-control" required>
                                                    @foreach ($tecnicos as $tecnico)
                                                    <option value="{{ $tecnico->id_tecnico }}" {{ $tecnico->id_tecnico == $asignacion->id_tecnico ? 'selected' : '' }}>
                                                        {{ $tecnico->persona->nom }} {{ $tecnico->persona->ap }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Parcela</label>
                                                <select name="id_parcela" class="form-control" required>
                                                    @foreach ($parcelas as $parcela)
                                                    <option value="{{ $parcela->id_parcela }}" {{ $parcela->id_parcela == $asignacion->id_parcela ? 'selected' : '' }}>
                                                        {{ $parcela->nom_parcela }} ({{ $parcela->productor->persona->nom }})
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

<!-- Modal Crear Asignación -->
<div class="modal fade" id="createAsignacionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-forest text-white">
                <h5 class="modal-title">Nueva Asignación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('asigna_parcelas.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Técnico</label>
                        <select name="id_tecnico" class="form-control" required>
                            @foreach ($tecnicos as $tecnico)
                            <option value="{{ $tecnico->id_tecnico }}">
                                {{ $tecnico->persona->nom }} {{ $tecnico->persona->ap }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Parcela</label>
                        <select name="id_parcela" class="form-control" required>
                            @foreach ($parcelas as $parcela)
                            <option value="{{ $parcela->id_parcela }}">
                                {{ $parcela->nom_parcela }} ({{ $parcela->productor->persona->nom }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Crear Asignación</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection