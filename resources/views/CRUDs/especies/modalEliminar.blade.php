<div class="modal fade" id="modalEliminarEspecie{{ $especie->id_especie }}" tabindex="-1" role="dialog" aria-labelledby="modalEliminarEspecieLabel{{ $especie->id_especie }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarEspecieLabel{{ $especie->id_especie }}">Eliminar Especie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('especies.destroy', $especie->id_especie) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    ¿Estás seguro de eliminar la especie {{ $especie->nom_cientifico }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
