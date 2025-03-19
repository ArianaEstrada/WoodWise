<!-- Barra lateral -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<div class="sidebar bg-dark text-white position-fixed h-100" style="width: 280px; padding-top: 20px;">
    <div class="p-3">
        <img src="{{ asset('Dashboard/images/logo-dark.svg') }}" alt="Logo" class="img-fluid mb-3" style="width: 100px;">
    </div>
    <div class="nav flex-column">
   
    @if(Auth::check() && Auth::user()->rol_id == 1)
    <a href="#" class="nav-link text-white py-3 border-bottom border-secondary"
       onclick="loadContent('especies')">
        <i class="fas fa-paw me-2"></i>
        Gestión de Especies
    </a>  
    
    <a href="#" class="nav-link text-white py-3 border-bottom border-secondary"
       onclick="loadContent('formulas')">
        <i class="fas fa-calculator me-2"></i>
        Gestión de Formulas
    </a>  

    <a href="#" class="nav-link text-white py-3 border-bottom border-secondary"
       onclick="loadContent('usuarios')">
        <i class="fas fa-users me-2"></i>
        Gestión de Usuarios
    </a>
    @endif
    @if(Auth::check() && Auth::user()->rol_id == 2 || Auth::check() && Auth::user()->rol_id == 1)        
    <a href="#" 
        class="nav-link text-white py-3 border-bottom border-secondary"
        onclick="loadContent('trozas')">
        <i class="fas fa-tree me-2"></i>
        Gestión de Trozas
    </a> 

    <a href="#" 
        class="nav-link text-white py-3 border-bottom border-secondary"
        onclick="loadContent('estimaciones')">
        <i class="fas fa-chart-line me-2"></i>
        Gestión de Estimaciones
    </a> 
    <a href="#" 
        class="nav-link text-white py-3 border-bottom border-secondary"
        onclick="loadContent('resumen-estimaciones')">
        <i class="fas fa-file-chart-line me-2"></i>
        Resumen de Estimaciones
    </a> 
@endif
@if(Auth::check() && Auth::user()->rol_id == 3 || Auth::check() && Auth::user()->rol_id == 1)        
    <a href="#" 
        class="nav-link text-white py-3 border-bottom border-secondary"
        onclick="loadContent('usuarios')">
        <i class="fas fa-users me-2"></i>
        Gestión de Usuarios
    </a> 

    <a href="#" 
        class="nav-link text-white py-3 border-bottom border-secondary"
        onclick="loadContent('parcelas')">
        <i class="fas fa-map-marker-alt me-2"></i>
        Gestión de Parcelas
    </a> 

    <a href="#" 
        class="nav-link text-white py-3 border-bottom border-secondary"
        onclick="loadContent('reportes')">
        <i class="fas fa-file-alt me-2"></i>
        Reportes
    </a> 
@endif

        
    </div>
</div>
