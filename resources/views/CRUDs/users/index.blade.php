<div class="card shadow-sm mt-4">
    <div class="card-header bg-primary text-white">
        <h4>Listado de Usuarios</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>Correo Electrónico</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($personas as $persona)
                <tr>
                    <td>{{ $persona->id_persona }}</td>
                    <td>{{ $persona->nom }} {{ $persona->ap }} {{ $persona->am }}</td>
                    <td>{{ $persona->correo }}</td>
                    <td>{{ $persona->rol->nom_rol }}</td>
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
