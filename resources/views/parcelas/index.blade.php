@extends('tecnicos.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <!-- Encabezado -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-cafe-oscuro shadow-cafe border-radius-xl">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="text-white mb-1">Gestión de áreas forestales</h4>
                            </div>
                            <div class="bg-white shadow rounded-circle p-2">
                                <i class="fas fa-tree text-cafe"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón para ocultar/mostrar parcelas -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-radius-lg bg-cafe-claro">
                    <div class="card-body p-3 text-center">
                        <button id="toggleParcelasBtn" class="btn bg-cafe-oscuro text-white btn-lg">
                            <i class="fas fa-eye-slash me-2"></i> Ocultar Parcelas
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón CREAR PARCELA -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-radius-lg bg-cafe-claro">
                    <div class="card-body p-3 text-center">
                        <a href="{{ route('parcelas.create') }}" class="btn bg-cafe-oscuro text-white btn-lg">
                            <i class="fas fa-plus-circle me-2"></i> Crear Parcela
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenedor de parcelas -->
        <div id="parcelasContainer">
            <!-- Listado de parcelas -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-radius-lg bg-cafe-claro">
                        <div class="card-header border-0 bg-transparent pb-0 p-3">
                            <h5 class="text-cafe-oscuro mb-0">
                                <i class="fas fa-map-marked-alt me-2"></i>
                                Mis Parcelas Registradas
                            </h5>
                        </div>

                        <div class="card-body p-3">
                            <!-- Parcela Colibrí -->
                            <div class="parcela-item mb-4 p-3 border-radius-lg bg-cafe-medio">
                                <h6 class="text-white mb-2"><strong>Colibrí</strong></h6>
                                <p class="text-white mb-1">12*12*34</p>
                                <p class="text-white mb-1"><strong>Extensión:</strong> 12cm*3km ha</p>
                                <p class="text-white mb-1"><strong>CP:</strong> 51200</p>
                                <p class="text-white mb-3"><strong>Trozas:</strong> 10km</p>

                                <!-- Botones de acción en tabla -->
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                        <tr>
                                            <td class="p-1 text-center">
                                                <a href="#" class="btn btn-block bg-cafe-oscuro text-white">
                                                    TROZAS
                                                </a>
                                            </td>
                                            <td class="p-1 text-center">
                                                <a href="#" class="btn btn-block bg-cafe-oscuro text-white">
                                                    ESTIMACIONES
                                                </a>
                                            </td>
                                            <td class="p-1 text-center">
                                                <a href="#" class="btn btn-block bg-cafe-oscuro text-white">
                                                    TURNO CORTA
                                                </a>
                                            </td>
                                            <td class="p-1 text-center">
                                                <a href="#" class="btn btn-block bg-cafe-oscuro text-white">
                                                    DETALLES
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para mostrar/ocultar parcelas -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggleParcelasBtn');
            const parcelasContainer = document.getElementById('parcelasContainer');

            toggleBtn.addEventListener('click', function() {
                if (parcelasContainer.style.display === 'none') {
                    parcelasContainer.style.display = 'block';
                    toggleBtn.innerHTML = '<i class="fas fa-eye-slash me-2"></i> Ocultar Parcelas';
                } else {
                    parcelasContainer.style.display = 'none';
                    toggleBtn.innerHTML = '<i class="fas fa-map-marked-alt me-2"></i> Ver Parcelas';
                }
            });
        });
    </script>

    <!-- Estilos unificados en café -->
    <style>
        /* Paleta de colores café */
        .bg-cafe-oscuro {
            background-color: #5D4037;  /* Café más oscuro */
        }

        .bg-cafe-medio {
            background-color: #8B5A2B;  /* Café medio */
        }

        .bg-cafe-claro {
            background-color: #D7CCC8;  /* Café claro */
        }

        .text-cafe {
            color: #5D4037;
        }

        .text-cafe-oscuro {
            color: #3E2723;
        }

        .shadow-cafe {
            box-shadow: 0 4px 20px 0 rgba(93, 64, 55, 0.14),
            0 7px 10px -5px rgba(93, 64, 55, 0.4);
        }

        /* Estilos generales */
        .border-radius-lg {
            border-radius: 16px;
        }

        .parcela-item {
            transition: all 0.3s ease;
        }

        .parcela-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(93, 64, 55, 0.1);
        }

        .btn {
            border-radius: 10px;
            padding: 12px 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(93, 64, 55, 0.2);
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }

        .table td {
            padding: 0.5rem;
        }

        .table td .btn {
            width: 100%;
            padding: 8px 5px;
            font-size: 0.85rem;
        }
    </style>
@endsection
