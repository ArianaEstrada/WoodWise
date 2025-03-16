<!-- Barra superior -->
<div class="top-bar d-flex justify-content-between align-items-center bg-dark text-white p-3">
    <div class="d-flex align-items-center">
        <img src="{{ asset('Dashboard/images/logo-dark.svg') }}" alt="Logo" class="img-fluid me-3" style="width: 40px;">
        <span class="fs-5 fw-bold">Bienvenido, 
            @if(Auth::check())
                {{ Auth::user()->persona->nom }} 
                ({{ Auth::user()->persona->rol->nom_rol }})
            @else
                Usuario
            @endif
        </span>
    </div>
    <div class="d-flex align-items-center">
        <a href="#" class="btn btn-outline-light me-3">Especies Registradas</a>
        <a href="{{ route('perfil') }}" class="btn btn-outline-light me-3">Perfil</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm mb-0 me-3">Cerrar sesión</button>
        </form>
    </div>
</div>
