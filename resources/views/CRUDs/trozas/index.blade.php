<div class="card shadow-sm mt-4">
    <div class="card-header bg-primary text-white">
        <h4>Listado de Trozas</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Longitud (m)</th>
                    <th>Diametro (cm)</th>
                    <th>Densidad (kg/m³)</th>
                    <th>Especie</th>
                    <th>Parcela</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trozas as $troza)
                <tr>
                    <td>{{ $troza->id_troza }}</td>
                    <td>{{ $troza->longitud }}</td>
                    <td>{{ $troza->diametro }}</td>
                    <td>{{ $troza->densidad }}</td>
                    <td>{{ $troza->especie->nom_cientifico }}</td>
                    <td>{{ $troza->parcela->nom_parcela }}</td>
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
