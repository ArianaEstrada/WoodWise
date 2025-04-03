@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white rounded-top-3">
                    <h4 class="mb-0">{{ __('Registro') }}</h4>
                </div>

                <div class="card-body p-5">
                    <!-- Mensajes Emergentes -->
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-5" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form id="register-form" method="POST" action="{{ route('register') }}" class="needs-validation">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-4">
                            <label for="nom" class="form-label">{{ __('Nombre') }}</label>
                            <input type="text" 
                                   class="form-control @error('nom') is-invalid @enderror" 
                                   name="nom" 
                                   value="{{ old('nom') }}" 
                                   required 
                                   autofocus>
                            @error('nom')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Apellido Paterno -->
                        <div class="mb-4">
                            <label for="ap" class="form-label">{{ __('Apellido Paterno') }}</label>
                            <input type="text" 
                                   class="form-control @error('ap') is-invalid @enderror" 
                                   name="ap" 
                                   value="{{ old('ap') }}" 
                                   required>
                            @error('ap')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Apellido Materno -->
                        <div class="mb-4">
                            <label for="am" class="form-label">{{ __('Apellido Materno') }}</label>
                            <input type="text" 
                                   class="form-control @error('am') is-invalid @enderror" 
                                   name="am" 
                                   value="{{ old('am') }}" 
                                   required>
                            @error('am')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Teléfono -->
                        <div class="mb-4">
                            <label for="telefono" class="form-label">{{ __('Teléfono') }}</label>
                            <input type="text" 
                                   class="form-control @error('telefono') is-invalid @enderror" 
                                   name="telefono" 
                                   value="{{ old('telefono') }}" 
                                   required>
                            @error('telefono')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="mb-4">
                            <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-4">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   required>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">{{ __('Confirmar Contraseña') }}</label>
                            <input type="password" 
                                   class="form-control" 
                                   name="password_confirmation" 
                                   required>
                        </div>

                        <!-- Rol -->
                        <div class="mb-4">
                            <label for="id_rol" class="form-label">{{ __('Rol') }}</label>
                            <select 
                                class="form-select @error('id_rol') is-invalid @enderror" 
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

                                            <!-- Cédula -->
                        <div id="cedula-container" class="mb-4" style="display: none;">
                            <label for="cedula" class="form-label">{{ __('Cédula') }}</label>
                            <input type="text" 
                                class="form-control @error('cedula') is-invalid @enderror" 
                                name="cedula" 
                                id="cedula" 
                                value="{{ old('cedula') }}">
                            @error('cedula')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Botón de Registro -->
                        <div class="d-grid gap-2 mb-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3">
                                {{ __('Registrarse') }}
                            </button>
                        </div>

                        <!-- Botón para redirigir a Iniciar Sesión -->
                        <div class="text-center">
                            <p class="mb-0">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="btn btn-link text-decoration-none">{{ __('Iniciar sesión') }}</a></p>
                        </div>
                    </form>
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
