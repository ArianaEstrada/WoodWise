<div class="modal fade" id="modalAgregarEspecie" tabindex="-1" role="dialog" aria-labelledby="modalAgregarEspecieLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarEspecieLabel">Agregar Especie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('especies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nom_cientifico">Nombre Científico</label>
                        <input type="text" class="form-control" id="nom_cientifico" name="nom_cientifico" required>
                    </div>
                    <div class="form-group">
                        <label for="nom_comun">Nombre Común</label>
                        <input type="text" class="form-control" id="nom_comun" name="nom_comun" required>
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" class="form-control" id="imagen" name="imagen">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
