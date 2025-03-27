@extends('dashboard')

@section('template_title')
    Especies
@endsection

@section('crud_content')
<div class="container py-5">
    <div class="card shadow">  <!-- Añadí 'shadow' para una sutil elevación -->
        <div class="card-header d-flex justify-content-between align-items-center bg-forest"> <!-- Clase de fondo forestal -->
            <h3 class="text-white">{{ __('Especies') }}</h3> <!-- Texto blanco para contrastar -->
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createEspecieModal">
                {{ __('Agregar Nueva') }}
            </button>
        </div>

        <div class="card-body">
            <table class="table table-striped text-center">
                <thead class="bg-forest text-white">  <!-- Clase de fondo forestal para la cabecera -->
                    <tr>
                        <th class="py-3">ID</th>
                        <th class="py-3">Nombre Científico</th>
                        <th class="py-3">Nombre Común</th>
                        <th class="py-3">Imagen</th>
                        <th class="py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($especies as $especie)
                    <tr>
                        <td class="py-3">{{ $especie->id_especie }}</td>
                        <td class="py-3">{{ $especie->nom_cientifico }}</td>
                        <td class="py-3">{{ $especie->nom_comun }}</td>
                        <td class="py-3">
                            @if ($especie->imagen)
                            <img src="{{ asset('storage/' . $especie->imagen) }}" class="card-img-top" alt="{{ $especie->nom_comun }}">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#viewEspecieModal{{ $especie->id_especie }}">Ver</button>
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editEspecieModal{{ $especie->id_especie }}">Editar</button>
                            <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $especie->id_especie }}')">Eliminar</button>
                        </td>
                    </tr>

                    <!-- Modal Ver Especie -->
                    <div class="modal fade" id="viewEspecieModal{{ $especie->id_especie }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-forest text-white"> <!-- Clase de fondo forestal -->
                                    <h5 class="modal-title">Detalles de la Especie</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>ID:</strong> {{ $especie->id_especie }}</p>
                                    <p><strong>Nombre Científico:</strong> {{ $especie->nom_cientifico }}</p>
                                    <p><strong>Nombre Común:</strong> {{ $especie->nom_comun }}</p>
                                    @if ($especie->imagen)
                                    <img src="{{ asset('storage/' . $especie->imagen) }}" class="card-img-top" alt="{{ $especie->nom_comun }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Editar Especie -->
                    <div class="modal fade" id="editEspecieModal{{ $especie->id_especie }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-forest text-white"> <!-- Clase de fondo forestal -->
                                    <h5 class="modal-title">Editar Especie</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('especies.update', $especie->id_especie) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label class="form-label">Nombre Científico</label>
                                            <input type="text" name="nom_cientifico" value="{{ $especie->nom_cientifico }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nombre Común</label>
                                            <input type="text" name="nom_comun" value="{{ $especie->nom_comun }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Imagen (Opcional)</label>
                                            <input type="file" name="imagen" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>... @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Crear Especie -->
<div class="modal fade" id="createEspecieModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-forest text-white"> <!-- Clase de fondo forestal -->
                <h5 class="modal-title">Agregar Nueva Especie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('especies.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre Científico</label>
                        <input type="text" name="nom_cientifico" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre Común</label>
                        <input type="text" name="nom_comun" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Imagen</label>
                        <input type="file" name="imagen" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: '¿Eliminar Especie?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '/especies/' + id;
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

@if(session('register'))
    <script>Swal.fire('Registro exitoso', 'La especie ha sido creada.', 'success');</script>
@endif
@if(session('modify'))
    <script>Swal.fire('Actualización exitosa', 'La especie ha sido actualizada.', 'success');</script>
@endif
@if(session('destroy'))
    <script>Swal.fire('Eliminación exitosa', 'La especie ha sido eliminada.', 'success');</script>
@endif

@endsection
