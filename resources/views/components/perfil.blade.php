<!-- resources/views/perfil.blade.php -->
@extends('layouts.Dashboard.main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3>Mi Perfil</h3>
                </div>
                <div class="card-body">
                    <h4>Información Personal</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nombre:</th>
                            <td>{{ $user->persona->nom }} {{ $user->persona->ap }} {{ $user->persona->am }}</td>
                        </tr>
                        <tr>
                            <th>Teléfono:</th>
                            <td>{{ $user->persona->telefono }}</td>
                        </tr>
                        <tr>
                            <th>Correo:</th>
                            <td>{{ $user->persona->correo }}</td>
                        </tr>
                        <tr>
                            <th>Rol:</th>
                            <td>{{ $user->persona->rol->nom_rol }}</td>
                        </tr>
                    </table>
                    <a href="#" class="btn btn-primary">Editar Información</a>
                    <a href="#" class="btn btn-outline-danger">Cerrar sesión</a>
                    <!-- Botón para regresar al home -->
                    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Regresar al Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
