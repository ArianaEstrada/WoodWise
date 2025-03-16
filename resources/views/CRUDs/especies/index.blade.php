<div class="card shadow-sm mt-4">
    <div class="card-header bg-primary text-white">
        <h4>Listado de Especies</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Científico</th>
                    <th>Nombre Común</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($especies as $especie)
                <tr>
                    <td>{{ $especie->id_especie }}</td>
                    <td>{{ $especie->nom_cientifico }}</td>
                    <td>{{ $especie->nom_comun }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
