<div class="card shadow-sm mt-4">
    <div class="card-header bg-primary text-white">
        <h4>Listado de Estimaciones</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo de Estimación</th>
                    <th>Fórmula Utilizada</th>
                    <th>Troza Asociada</th>
                    <th>Cálculo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($estimaciones as $estimacion)
                <tr>
                    <td>{{ $estimacion->id_estimacion }}</td>
                    <td>{{ $estimacion->tipoEstimacion->nom_tipo_e }}</td>
                    <td>{{ $estimacion->formula->nom_formula }}</td>
                    <td>{{ $estimacion->troza->id_troza }}</td>
                    <td>{{ $estimacion->calculo }}</td>
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
