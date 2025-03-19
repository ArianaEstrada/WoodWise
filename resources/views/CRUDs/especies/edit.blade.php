<div class="modal fade" id="modalEditarEspecie{{ $especie->id_especie }}" tabindex="-1" role="dialog" aria-labelledby="modalEditarEspecieLabel{{ $especie->id_especie }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarEspecieLabel{{ $especie->id_especie }}">Editar Especie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('especies.update', $especie->id_especie) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nom_cientifico">Nombre Científico</label>
                        <input type="text" class="form-control" id="nom_cientifico" name="nom_cientifico" value="{{ $especie->nom_cientifico }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nom_comun">Nombre Común</label>
                        <input type="text" class="form-control" id="nom_comun" name="nom_comun" value="{{ $especie->nom_comun }}" required>
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" class="form-control" id="imagen" name="imagen">
                        @if($especie->imagen)
                            <img src="{{ asset('storage/' . $especie->imagen) }}" alt="Imagen Actual" width="50">
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
