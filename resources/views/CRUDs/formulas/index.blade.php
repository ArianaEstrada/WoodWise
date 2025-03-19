<div class="card shadow-sm mt-4">
    <div class="card-header bg-primary text-white">
        <h4>Listado de Fórmulas</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de la Fórmula</th>
                    <th>Expresión Matemática</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($formulas as $formula)
                <tr>
                    <td>{{ $formula->id_formula }}</td>
                    <td>{{ $formula->nom_formula }}</td>
                    <td>{{ $formula->expresion }}</td>
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
