@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <!-- Encabezado -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-gradient-brown shadow-brown border-radius-xl">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="text-white mb-1">Panel del Técnico Forestal</h4>
                                <p class="text-white opacity-8 mb-0">Gestión especializada de recursos maderables</p>
                            </div>
                            <div class="bg-white shadow rounded-circle p-2">
                                <i class="fas fa-tree text-brown"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta de bienvenida -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-radius-lg" style="background-color: #f5e9dc;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape icon-lg bg-brown shadow-brown text-center rounded-circle">
                                <i class="fas fa-user-tie text-white"></i>
                            </div>
                            <div class="ms-3">
                                @isset($user)
                                    <h3 class="text-brown-dark mb-0">¡Bienvenido Técnico {{ $user->persona->nombre ?? 'Usuario' }}!</h3>
                                    <p class="text-sm text-brown mb-0">
                                        <i class="fas fa-id-card me-1"></i>
                                        Cédula: {{ $tecnico->cedula_p ?? 'No disponible' }}
                                    </p>
                                @else
                                    <h3 class="text-brown-dark mb-0">¡Bienvenido Técnico!</h3>
                                    <p class="text-sm text-brown mb-0">
                                        <i class="fas fa-id-card me-1"></i>
                                        Cédula: No disponible
                                    </p>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón principal para ver parcelas -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-radius-lg" style="background-color: #f5e9dc;">
                    <div class="card-body p-3 text-center">
                        <a href="{{ route('parcelas.index') }}" class="btn bg-gradient-brown text-white btn-lg btn-action">
                            <i class="fas fa-map-marked-alt me-2"></i> Ver Parcelas
                        </a>
                        @isset($parcelasCount)
                            @if($parcelasCount > 0)
                                <p class="text-brown mt-2 mb-0">Tienes {{ $parcelasCount }} parcelas asignadas</p>
                            @else
                                <p class="text-brown mt-2 mb-0">No tienes parcelas asignadas actualmente</p>
                            @endif
                        @else
                            <p class="text-brown mt-2 mb-0">Información de parcelas no disponible</p>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estilos -->
    <style>
        .bg-brown { background-color: #8B5A2B; }
        .bg-gradient-brown { background: linear-gradient(135deg, #8B5A2B 0%, #A67C52 100%); }
        .text-brown { color: #8B5A2B; }
        .text-brown-dark { color: #5D4037; }
        .bg-brown-light { background-color: #f5e9dc; }
        .shadow-brown { box-shadow: 0 4px 20px 0 rgba(139, 90, 43, 0.14), 0 7px 10px -5px rgba(139, 90, 43, 0.4); }
        .btn-action { border-radius: 12px; padding: 12px; font-weight: 600; transition: all 0.3s ease; border: none; }
        .btn-action:hover { transform: translateY(-2px); box-shadow: 0 6px 12px rgba(139, 90, 43, 0.2); }
        .border-radius-lg { border-radius: 16px; }
    </style>
@endsection
