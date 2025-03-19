<div class="container py-5">
    <div class="card-header d-flex justify-content-between">
        <h4>Listado de Especies</h4>
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createEspecieModal">
            Agregar Especie
        </button>
    </div>

    <div class="row mt-4">
        @foreach ($especies as $especie)
            <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $especie->nom_cientifico }}</h5>
                        <p><strong>Nombre Común:</strong> {{ $especie->nom_comun }}</p>

                        <div class="d-flex justify-content-between">
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewEspecieModal{{ $especie->id }}">Ver</button>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editEspecieModal{{ $especie->id }}">Editar</button>
                            <button class="btn btn-danger" onclick="confirmDelete({{ $especie->id }})">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Ver -->
            <div class="modal fade" id="viewEspecieModal{{ $especie->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Detalles de la Especie</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Nombre Científico:</strong> {{ $especie->nom_cientifico }}</p>
                            <p><strong>Nombre Común:</strong> {{ $especie->nom_comun }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Editar -->
            <div class="modal fade" id="editEspecieModal{{ $especie->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <form action="{{ route('especies.update', $especie->id) }}" method="POST">
                    @csrf
                     @method('PUT')
                            <div class="modal-header">
                                <h5>Editar Especie</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
    <div class="mb-3">
        <label for="nom_cientifico">Nombre Científico</label>
        <input type="text" name="nom_cientifico" value="{{ $especie->nom_cientifico }}" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="nom_comun">Nombre Común</label>
        <input type="text" name="nom_comun" value="{{ $especie->nom_comun }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" class="form-control">
    </div>
</div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
   function confirmDelete(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = `/especies/${id}`;
            
            let csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            
            let methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            
            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    });
}

</script>

@if(session('register'))
<script>
    Swal.fire('¡Registro Exitoso!', '', 'success');
</script>
@endif

@if(session('modify'))
<script>
    Swal.fire('¡Actualización Exitosa!', '', 'success');
</script>
@endif

@if(session('destroy'))
<script>
    Swal.fire('¡Eliminado Exitosamente!', '', 'success');
</script>
@endif
@if ($especies->isEmpty())
    <p>No hay especies registradas.</p>
@else
    @foreach ($especies as $especie)
        <p>{{ $especie->nom_cientifico }}</p>
    @endforeach
@endif
