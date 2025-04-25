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
                                <h3 class="text-brown-dark mb-0">¡Bienvenido Técnico {{ Auth::user()->persona->nombre }}!</h3>
                                <p class="text-sm text-brown mb-0">
                                    <i class="fas fa-id-card me-1"></i> Cédula: {{ $tecnico->cedula_p ?? 'No disponible' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-radius-lg" style="background-color: #f5e9dc;">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-3 col-6 mb-3">
                                <a href="{{ route('parcelas.index') }}" class="btn btn-block bg-gradient-brown text-white btn-action">
                                    <i class="fas fa-map-marked-alt me-2"></i> Registrar Parcela
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de parcelas -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-radius-lg" style="background-color: #f5e9dc;">
                    <div class="card-header border-0 bg-transparent pb-0 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-brown-dark mb-0">
                                <i class="fas fa-map-marked-alt me-2"></i>
                                Parcelas asignadas
                            </h5>
                            <span class="badge bg-brown text-white">{{ $parcelas->count() ?? 0 }} parcelas</span>
                        </div>
                        <p class="text-sm text-brown mb-0 mt-1">Gestión de áreas forestales bajo tu responsabilidad</p>
                    </div>

                    <div class="card-body p-3">
                        @if(!isset($parcelas) || $parcelas->isEmpty())
                            <div class="empty-state text-center py-5" style="background-color: #f0e0d0;">
                                <div class="icon icon-lg bg-brown text-white shadow-brown rounded-circle mb-3 mx-auto">
                                    <i class="fas fa-map opacity-10"></i>
                                </div>
                                <h5 class="text-brown-dark mb-1">No tienes parcelas asignadas</h5>
                                <p class="text-sm text-brown mb-3">Actualmente no hay parcelas asignadas a tu cuenta</p>
                                <button class="btn bg-brown text-white mb-0">
                                    <i class="fas fa-plus me-1"></i> Solicitar asignación
                                </button>
                            </div>
                        @else
                            <div class="row">
                                @foreach($parcelas as $parcela)
                                    <div class="col-md-6 col-xl-4 mb-4">
                                        <div class="card card-blog card-plain h-100 border-radius-lg" style="background-color: #f0e0d0;">
                                            <div class="card-header p-0 mt-n4 mx-3">
                                                <div class="bg-brown shadow-brown border-radius-xl p-3 text-center">
                                                    <i class="fas fa-tree text-white opacity-10 fa-2x"></i>
                                                </div>
                                            </div>
                                            <div class="card-body p-3 pt-2">
                                                <h6 class="text-brown-dark mb-0">{{ $parcela->nom_parcela }}</h6>
                                                <p class="text-sm text-brown mb-2">
                                                    <i class="fas fa-map-marker-alt me-1"></i> {{ $parcela->ubicacion }}
                                                </p>
                                                <div class="d-flex justify-content-between mb-2">
                                            <span class="text-xs text-brown-dark">
                                                <i class="fas fa-ruler-combined me-1"></i>
                                                <strong>Extensión:</strong> {{ $parcela->extension }} ha
                                            </span>
                                                    <span class="text-xs text-brown-dark">
                                                <i class="fas fa-layer-group me-1"></i>
                                                <strong>Trozas:</strong> {{ $parcela->trozas_count }}
                                            </span>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-xs text-brown-dark">
                                                <i class="fas fa-mail-bulk me-1"></i>
                                                CP: {{ $parcela->CP }}
                                            </span>
                                                    <a href="{{ route('trozas.index', ['parcela' => $parcela->id_parcela]) }}"
                                                       class="btn btn-sm bg-brown text-white mb-0">
                                                        Ver detalles
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Colores café personalizados */
        .bg-brown {
            background-color: #8B5A2B;
        }

        .bg-gradient-brown {
            background: linear-gradient(135deg, #8B5A2B 0%, #A67C52 100%);
        }

        .text-brown {
            color: #8B5A2B;
        }

        .text-brown-dark {
            color: #5D4037;
        }

        .bg-brown-light {
            background-color: #f5e9dc;
        }

        .shadow-brown {
            box-shadow: 0 4px 20px 0 rgba(139, 90, 43, 0.14),
            0 7px 10px -5px rgba(139, 90, 43, 0.4);
        }

        /* Botones de acción */
        .btn-action {
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(139, 90, 43, 0.2);
        }

        /* Efecto hover para las tarjetas */
        .card-blog:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }

        /* Estado vacío mejorado */
        .empty-state {
            border-radius: 12px;
            padding: 2rem;
        }

        /* Mejoras en los bordes */
        .border-radius-lg {
            border-radius: 16px;
        }

        /* Badge */
        .badge.bg-brown {
            padding: 6px 12px;
            font-weight: 600;
            font-size: 0.75rem;
        }
    </style>
@endsection
