@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro') }}</div>

                <div class="card-body">
                    <!-- Mensajes Emergentes de Error o Éxito -->
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form id="register-form" method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nom" class="form-label">{{ __('Nombre') }}</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autofocus>
                            @error('nom')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Apellido Paterno -->
                        <div class="mb-3">
                            <label for="ap" class="form-label">{{ __('Apellido Paterno') }}</label>
                            <input type="text" class="form-control @error('ap') is-invalid @enderror" name="ap" value="{{ old('ap') }}" required>
                            @error('ap')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Apellido Materno -->
                        <div class="mb-3">
                            <label for="am" class="form-label">{{ __('Apellido Materno') }}</label>
                            <input type="text" class="form-control @error('am') is-invalid @enderror" name="am" value="{{ old('am') }}" required>
                            @error('am')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Teléfono -->
                        <div class="mb-3">
                            <label for="telefono" class="form-label">{{ __('Teléfono') }}</label>
                            <input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required>
                            @error('telefono')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirmar Contraseña') }}</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <!-- Rol (Dinamico desde la BD) -->
                        <div class="mb-3">
                            <label for="id_rol" class="form-label">{{ __('Rol') }}</label>
                            <select 
                                class="form-control @error('id_rol') is-invalid @enderror" 
                                name="id_rol" 
                                id="id_rol" 
                                required
                            >
                                <option value="">Selecciona un rol</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id_rol }}" data-nom_rol="{{ $role->nom_rol }}">
                                        {{ $role->nom_rol }}
                                    </option>
                                @endforeach
                            </select>

                            @error('id_rol')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo de Cédula (Solo visible si se selecciona "Técnico") -->
                        <div id="cedula-container" class="mb-3" style="display: none;">
                            <label for="cedula" class="form-label">{{ __('Cédula') }}</label>
                            <input type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" id="cedula" value="{{ old('cedula') }}">
                            @error('cedula')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Botón de Registro -->
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Registrarse') }}
                            </button>
                        </div>
                    </form>

                    <!-- Botón para redirigir a Iniciar Sesión -->
                    <div class="text-center mt-3">
                        <p>¿Ya tienes cuenta? <a href="{{ route('login') }}" class="btn btn-link">Iniciar sesión</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para mostrar/ocultar el campo de Cédula dependiendo del rol seleccionado
    document.getElementById('id_rol').addEventListener('change', function() {
        const cedulaContainer = document.getElementById('cedula-container');
        const selectedRole = this.options[this.selectedIndex].text; // Obtener el nombre del rol seleccionado

        if (selectedRole === "Tecnico") {
            cedulaContainer.style.display = 'block'; // Mostrar el campo de cédula
        } else {
            cedulaContainer.style.display = 'none'; // Ocultar el campo de cédula
        }
    });
</script>
@endsection
