<div class="card shadow-sm mt-4">
    <div class="card-header bg-primary text-white">
        <h4>Listado de Parcelas</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de la Parcela</th>
                    <th>Ubicación</th>
                    <th>Productor</th>
                    <th>Extensión (ha)</th>
                    <th>Dirección</th>
                    <th>Código Postal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($parcelas as $parcela)
                <tr>
                    <td>{{ $parcela->id_parcela }}</td>
                    <td>{{ $parcela->nom_parcela }}</td>
                    <td>{{ $parcela->ubicacion }}</td>
                    <td>{{ $parcela->productor->nom }} {{ $parcela->productor->ap }} {{ $parcela->productor->am }}</td>
                    <td>{{ $parcela->extension }}</td>
                    <td>{{ $parcela->direccion }}</td>
                    <td>{{ $parcela->CP }}</td>
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
