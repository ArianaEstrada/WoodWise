@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 text-center mb-5">
        <h2 class="heading-section">Acceso al Sistema</h2>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="login-wrap p-5 bg-white rounded-3 shadow-lg">
            <div class="text-center mb-5">
                <img src="{{ asset('img/woodwise.png') }}" 
                     alt="WoodWise Logo" 
                     width="80" 
                     height="80" 
                     class="rounded-circle border border-2 border-primary">
            </div>

            <h3 class="mb-5 text-center text-primary">Iniciar Sesión</h3>
            
            <form method="POST" action="{{ route('login') }}" class="signin-form">
                @csrf
                <div class="form-group mb-5">
                    <input type="email" 
                           name="email" 
                           class="form-control border-primary" 
                           placeholder="Correo electrónico" 
                           required 
                           autofocus>
                </div>
                
                <div class="form-group mb-5 position-relative">
                    <input id="password-field" 
                           type="password" 
                           name="password" 
                           class="form-control border-primary" 
                           placeholder="Contraseña" 
                           required>
                    <span toggle="#password-field" 
                          class="fa fa-fw fa-eye field-icon toggle-password 
                          position-absolute end-0 top-50 translate-middle-y me-3"></span>
                </div>

                <div class="form-group mb-5">
                    <button type="submit" 
                            class="form-control btn btn-primary btn-lg rounded-3">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Acceder
                    </button>
                </div>

                <div class="form-group d-flex justify-content-between align-items-center mb-5">
                    <div class="form-check">
                        <input class="form-check-input" 
                               type="checkbox" 
                               name="remember">
                        <label class="form-check-label text-muted">
                            Recuérdame
                        </label>
                    </div>
                    <a href="{{ route('password.request') }}" 
                       class="text-decoration-none text-primary">
                        ¿Olvidó su contraseña?
                    </a>
                </div>
            </form>

            <div class="text-center mb-5">
                <p class="text-muted">¿No tiene cuenta? <a href="{{ route('register') }}" class="text-decoration-none text-primary">Registrarse</a></p>
            </div>

            <div class="text-center">
                <p class="text-muted mb-4">O acceder con:</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#" 
                       class="btn btn-outline-primary rounded-pill px-4">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" 
                       class="btn btn-outline-primary rounded-pill px-4">
                        <i class="bi bi-google"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
