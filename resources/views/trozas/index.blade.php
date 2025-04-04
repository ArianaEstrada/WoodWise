@extends('dashboard')

@section('template_title')
    Gestión de Trozas
@endsection

@section('crud_content')
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-forest d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white">Gestión de Trozas</h5>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createTrozaModal">
                    <i class="fas fa-plus"></i> Crear Troza
                </button>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="bg-forest text-white">
                        <tr>
                            <th>ID</th>
                            <th>Longitud</th>
                            <th>Diámetro</th>
                            <th>Densidad</th>
                            <th>Especie</th>
                            <th>Parcela</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trozas as $troza)
                            <tr>
                                <td>{{ $troza->id_troza }}</td>
                                <td>{{ $troza->longitud }}</td>
                                <td>{{ $troza->diametro }}</td>
                                <td>{{ $troza->densidad }}</td>
                                <td>{{ $troza->especie->nom_cientifico }}</td>
                                <td>{{ $troza->parcela->nom_parcela }}</td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="modal"
                                        data-bs-target="#editTrozaModal{{ $troza->id_troza }}">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm"
                                        onclick="confirmDelete({{ $troza->id_troza }})">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Editar Troza -->
                            <div class="modal fade" id="editTrozaModal{{ $troza->id_troza }}" tabindex="-1"
                                aria-labelledby="editTrozaLabel{{ $troza->id_troza }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-forest text-white">
                                            <h5 class="modal-title">Editar Troza</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('trozas.update', $troza->id_troza) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="longitud" class="form-label">Longitud</label>
                                                    <input type="number" class="form-control" id="longitud" name="longitud"
                                                        value="{{ $troza->longitud }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="diametro" class="form-label">Diámetro</label>
                                                    <input type="number" class="form-control" id="diametro" name="diametro"
                                                        value="{{ $troza->diametro }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="densidad" class="form-label">Densidad</label>
                                                    <input type="number" class="form-control" id="densidad" name="densidad"
                                                        value="{{ $troza->densidad }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="id_especie" class="form-label">Especie</label>
                                                    <select class="form-control" id="id_especie" name="id_especie" required>
                                                        @foreach ($especies as $especie)
                                                            <option value="{{ $especie->id_especie }}"
                                                                {{ $troza->id_especie == $especie->id_especie ? 'selected' : '' }}>
                                                                {{ $especie->nom_cientifico }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="id_parcela" class="form-label">Parcela</label>
                                                    <select class="form-control" id="id_parcela" name="id_parcela" required>
                                                        @foreach ($parcelas as $parcela)
                                                            <option value="{{ $parcela->id_parcela }}"
                                                                {{ $troza->id_parcela == $parcela->id_parcela ? 'selected' : '' }}>
                                                                {{ $parcela->nom_parcela }}
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

        <!-- Modal Crear Troza -->
        <div class="modal fade" id="createTrozaModal" tabindex="-1" aria-labelledby="createTrozaLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-forest text-white">
                        <h5 class="modal-title">Crear Nueva Troza</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('trozas.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Diámetro (metros)</label>
                                <input type="number" step="0.01" name="diametro" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Longitud (metros)</label>
                                <input type="number" step="0.01" name="longitud" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="densidad" class="form-label">Densidad</label>
                                <input type="number" class="form-control" id="densidad" name="densidad" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_especie" class="form-label">Especie</label>
                                <select class="form-control" id="id_especie" name="id_especie" required>
                                    <option value="" disabled selected>Seleccione una especie</option>
                                    @foreach ($especies as $especie)
                                        <option value="{{ $especie->id_especie }}">{{ $especie->nom_cientifico }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="id_parcela" class="form-label">Parcela</label>
                                <select class="form-control" id="id_parcela" name="id_parcela" required>
                                    <option value="" disabled selected>Seleccione una parcela</option>
                                    @foreach ($parcelas as $parcela)
                                        <option value="{{ $parcela->id_parcela }}">{{ $parcela->nom_parcela }}</option>
                                    @endforeach
                                </select>
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
                title: '¿Eliminar troza?',
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
                    form.action = '/trozas/' + id;
                    form.innerHTML = '@csrf @method("DELETE")';
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        @if (session('register'))
            Swal.fire('¡Éxito!', 'Troza registrada correctamente', 'success');
        @endif

        @if (session('modify'))
            Swal.fire('¡Éxito!', 'Troza actualizada correctamente', 'success');
        @endif

        @if (session('destroy'))
            Swal.fire('¡Éxito!', 'Troza eliminada correctamente', 'success');
        @endif
    </script>
@endsection
