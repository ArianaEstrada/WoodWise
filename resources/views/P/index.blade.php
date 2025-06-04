@extends('layouts.app')

@section('content')
    <div class="dashboard-container">
        <!-- Hero Section with Glass Morphism -->
        <div class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">
                    <span class="icon-forest">🌲</span> Wood<span class="text-gradient">Wise</span>
                </h1>
                <p class="hero-subtitle">Gestión inteligente de recursos forestales</p>
            </div>
        </div>

        <!-- Stats Cards with Hover Effects -->
        <div class="stats-grid">
            <div class="stat-card card-parcelas">
                <div class="stat-icon">🗺️</div>
                <div class="stat-content">
                    <span class="stat-label">Parcelas Registradas</span>
                    <span class="stat-value">{{ $stats['total_parcelas'] }}</span>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ min(100, $stats['total_parcelas'] * 10) }}%"></div>
                    </div>
                    <button class="section-export-btn parcelas-export">
                        <i class="fas fa-download"></i> Exportar Parcelas
                    </button>
                </div>
            </div>

            <div class="stat-card card-trozas">
                <div class="stat-icon">🌳</div>
                <div class="stat-content">
                    <span class="stat-label">Trozas Registradas</span>
                    <span class="stat-value">{{ $stats['total_trozas'] }}</span>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ min(100, $stats['total_trozas'] / 20) }}%"></div>
                    </div>
                    <button class="section-export-btn trozas-export">
                        <i class="fas fa-download"></i> Exportar Trozas
                    </button>
                </div>
            </div>

            <div class="stat-card card-estimaciones">
                <div class="stat-icon">📊</div>
                <div class="stat-content">
                    <span class="stat-label">Estimaciones</span>
                    <span class="stat-value">{{ $stats['total_estimaciones'] }}</span>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ min(100, $stats['total_estimaciones'] / 10) }}%"></div>
                    </div>
                    <button class="section-export-btn estimaciones-export">
                        <i class="fas fa-download"></i> Exportar Estimaciones
                    </button>
                </div>
            </div>
        </div>

        <!-- Parcelas Section - Modern Cards -->
        <div class="section-header">
            <h2><i class="fas fa-map-marked-alt"></i> Mis Parcelas Forestales</h2>
            <span class="badge">{{ count($parcelas) }} registradas</span>
        </div>

        <div class="parcelas-container">
            @foreach($parcelas as $parcela)
                <div class="parcela-card">
                    <div class="parcela-header">
                        <div class="parcela-badge">{{ $parcela->trozas->count() }} trozas</div>
                        <div class="parcela-hero" style="background-image: url('https://source.unsplash.com/random/600x400/?forest,{{ $loop->index }}')"></div>
                    </div>

                    <div class="parcela-body">
                        <h3 class="parcela-title">{{ $parcela->nom_parcela }}</h3>
                        <p class="parcela-location">
                            <i class="fas fa-map-marker-alt"></i> {{ $parcela->ubicacion }}
                        </p>

                        <div class="parcela-stats">
                            <div class="stat-item">
                                <span class="stat-number">{{ $parcela->extension }}</span>
                                <span class="stat-label">Hectáreas</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">{{ round($parcela->trozas->avg('longitud') ?? 0, 2) }}</span>
                                <span class="stat-label">Largo (m)</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">{{ round($parcela->trozas->avg('diametro') ?? 0, 2) }}</span>
                                <span class="stat-label">Diámetro (cm)</span>
                            </div>
                        </div>

                        <div class="parcela-chart">
                            <canvas id="miniChart{{ $parcela->id_parcela }}"></canvas>
                        </div>
                    </div>

                    <div class="parcela-footer">
                        <button class="btn-details" onclick="toggleDetails({{ $parcela->id_parcela }})">
                            <i class="fas fa-chevron-down"></i> Detalles
                        </button>
                        <a href="{{ route('parcela.pdf', $parcela->id_parcela) }}" class="btn-export">
                            <i class="fas fa-file-export"></i> Exportar
                        </a>
                    </div>

                    <!-- Hidden Details Section -->
                    <div class="parcela-details" id="details-{{ $parcela->id_parcela }}">
                        <div class="details-section">
                            <h4><i class="fas fa-info-circle"></i> Información General</h4>
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Extensión</span>
                                    <span class="info-value">{{ $parcela->extension }} ha</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Ubicación</span>
                                    <span class="info-value">{{ $parcela->ubicacion }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Dirección</span>
                                    <span class="info-value">{{ $parcela->direccion }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Código Postal</span>
                                    <span class="info-value">{{ $parcela->CP }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="details-section">
                            <h4><i class="fas fa-chart-bar"></i> Estadísticas Avanzadas</h4>
                            <div class="advanced-stats">
                                <div class="radar-chart">
                                    <canvas id="radarChart{{ $parcela->id_parcela }}"></canvas>
                                </div>
                                <div class="stats-summary">
                                    <div class="summary-item">
                                        <span class="summary-value">{{ $parcela->trozas->count() }}</span>
                                        <span class="summary-label">Trozas totales</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-value">{{ round($parcela->trozas->avg('densidad') ?? 0, 2) }}</span>
                                        <span class="summary-label">Densidad (kg/m³)</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-value">{{ round($parcela->trozas->sum('volumen') ?? 0, 2) }}</span>
                                        <span class="summary-label">Volumen total (m³)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="details-section">
                            <h4><i class="fas fa-tree"></i> Listado de Trozas</h4>
                            @if($parcela->trozas->count() > 0)
                                <div class="trozas-table">
                                    <div class="table-header">
                                        <div>ID</div>
                                        <div>Longitud</div>
                                        <div>Diámetro</div>
                                        <div>Densidad</div>
                                        <div>Acciones</div>
                                    </div>
                                    @foreach($parcela->trozas as $troza)
                                        <div class="table-row">
                                            <div>#{{ $troza->id_troza }}</div>
                                            <div>{{ $troza->longitud }} m</div>
                                            <div>{{ $troza->diametro }} cm</div>
                                            <div>{{ $troza->densidad }} kg/m³</div>
                                            <div>
                                                <a href="{{ route('troza.pdf', $troza->id_troza) }}" class="action-btn">
                                                    <i class="fas fa-file-export"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <i class="fas fa-tree"></i>
                                    <p>No hay trozas registradas en esta parcela</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Mini charts for each parcela
        @foreach($parcelas as $parcela)
        const miniCtx{{ $parcela->id_parcela }} = document.getElementById('miniChart{{ $parcela->id_parcela }}').getContext('2d');
        new Chart(miniCtx{{ $parcela->id_parcela }}, {
            type: 'bar',
            data: {
                labels: ['Largo', 'Diámetro', 'Densidad'],
                datasets: [{
                    data: [
                        {{ $parcela->trozas->avg('longitud') ?? 0 }},
                        {{ $parcela->trozas->avg('diametro') ?? 0 }},
                        {{ $parcela->trozas->avg('densidad') ?? 0 / 10 }}
                    ],
                    backgroundColor: [
                        'rgba(46, 204, 113, 0.7)',
                        'rgba(52, 152, 219, 0.7)',
                        'rgba(155, 89, 182, 0.7)'
                    ],
                    borderColor: [
                        'rgba(46, 204, 113, 1)',
                        'rgba(52, 152, 219, 1)',
                        'rgba(155, 89, 182, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = '';
                                switch(context.dataIndex) {
                                    case 0: label = context.raw.toFixed(2) + ' m'; break;
                                    case 1: label = context.raw.toFixed(2) + ' cm'; break;
                                    case 2: label = (context.raw * 10).toFixed(2) + ' kg/m³'; break;
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: { display: false },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#7f8c8d' }
                    }
                }
            }
        });

        // Radar charts for details
        const radarCtx{{ $parcela->id_parcela }} = document.getElementById('radarChart{{ $parcela->id_parcela }}').getContext('2d');
        new Chart(radarCtx{{ $parcela->id_parcela }}, {
            type: 'radar',
            data: {
                labels: ['Longitud', 'Diámetro', 'Densidad', 'Volumen', 'Calidad'],
                datasets: [{
                    label: 'Promedio',
                    data: [
                        {{ $parcela->trozas->avg('longitud') ?? 0 * 10 }},
                        {{ $parcela->trozas->avg('diametro') ?? 0 }},
                        {{ $parcela->trozas->avg('densidad') ?? 0 / 10 }},
                        {{ ($parcela->trozas->avg('longitud') ?? 0 * $parcela->trozas->avg('diametro') ?? 0) / 10 }},
                        75
                    ],
                    backgroundColor: 'rgba(46, 204, 113, 0.2)',
                    borderColor: 'rgba(46, 204, 113, 1)',
                    pointBackgroundColor: 'rgba(46, 204, 113, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(46, 204, 113, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        angleLines: { display: true },
                        suggestedMin: 0,
                        suggestedMax: 100,
                        ticks: { display: false }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = '';
                                const rawValue = context.raw;
                                switch(context.dataIndex) {
                                    case 0: label = (rawValue / 10).toFixed(2) + ' m'; break;
                                    case 1: label = rawValue.toFixed(2) + ' cm'; break;
                                    case 2: label = (rawValue * 10).toFixed(2) + ' kg/m³'; break;
                                    case 3: label = rawValue.toFixed(2) + ' m³'; break;
                                    default: label = rawValue.toFixed(0) + '%';
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
        @endforeach

        // Toggle details function
        function toggleDetails(id) {
            const details = document.getElementById(`details-${id}`);
            const btn = details.previousElementSibling.querySelector('.btn-details i');

            details.classList.toggle('show');
            btn.classList.toggle('fa-chevron-down');
            btn.classList.toggle('fa-chevron-up');

            if (details.classList.contains('show')) {
                details.style.maxHeight = details.scrollHeight + 'px';
            } else {
                details.style.maxHeight = '0';
            }
        }

        // Export buttons functionality
        document.querySelector('.parcelas-export').addEventListener('click', function() {
            window.location.href = "{{ route('parcelas.export') }}";
        });

        document.querySelector('.trozas-export').addEventListener('click', function() {
            window.location.href = "{{ route('trozas.export') }}";
        });

        document.querySelector('.estimaciones-export').addEventListener('click', function() {
            window.location.href = "{{ route('estimaciones.export') }}";
        });
    </script>
@endpush

@push('styles')
    <style>
        :root {
            --primary: #3a5f0b; /* Deep forest green */
            --primary-dark: #2d4a08; /* Darker green */
            --primary-light: rgba(58, 95, 11, 0.1);
            --secondary: #6b8e23; /* Olive green */
            --secondary-dark: #556b2f; /* Dark olive green */
            --accent: #8b4513; /* Saddle brown - for accent */
            --dark: #2c3e10; /* Very dark green */
            --light: #f5f5f0; /* Creamy light */
            --gray: #8a8a7a; /* Earthy gray */
            --dark-gray: #5a5a4a; /* Dark earthy gray */
            --light-gray: #c0c0b0; /* Light earthy gray */
            --bg-color: #f8f8f0; /* Cream background */
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --card-shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.12);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        /* Base Styles */
        body {
            background-color: var(--bg-color);
            font-family: 'Segoe UI', 'Roboto', sans-serif;
            color: var(--dark);
            line-height: 1.6;
        }

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(58, 95, 11, 0.9), rgba(107, 142, 35, 0.9));
            border-radius: 16px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .text-gradient {
            background: linear-gradient(90deg, #fff, #f1c40f);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .icon-forest {
            margin-right: 0.5rem;
            font-size: 2.2rem;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .hero-actions {
            position: relative;
            z-index: 1;
        }

        .export-btn {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            transition: var(--transition);
            cursor: pointer;
        }

        .export-btn i {
            margin-right: 0.5rem;
        }

        .export-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(255, 255, 255, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0); }
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-right: 1.5rem;
            flex-shrink: 0;
        }

        .stat-content {
            flex-grow: 1;
            position: relative;
            padding-bottom: 2.5rem;
        }

        .stat-label {
            display: block;
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .progress-bar {
            height: 6px;
            background: var(--light);
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 3px;
        }

        /* Section Export Buttons */
        .section-export-btn {
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .section-export-btn i {
            margin-right: 0.5rem;
        }

        .parcelas-export {
            background: rgba(58, 95, 11, 0.1);
            color: var(--primary-dark);
            border: 1px solid rgba(58, 95, 11, 0.3);
        }

        .parcelas-export:hover {
            background: rgba(58, 95, 11, 0.2);
            transform: translateY(-2px);
        }

        .trozas-export {
            background: rgba(107, 142, 35, 0.1);
            color: var(--secondary-dark);
            border: 1px solid rgba(107, 142, 35, 0.3);
        }

        .trozas-export:hover {
            background: rgba(107, 142, 35, 0.2);
            transform: translateY(-2px);
        }

        .estimaciones-export {
            background: rgba(139, 69, 19, 0.1);
            color: var(--accent);
            border: 1px solid rgba(139, 69, 19, 0.3);
        }

        .estimaciones-export:hover {
            background: rgba(139, 69, 19, 0.2);
            transform: translateY(-2px);
        }

        /* Card specific styles */
        .card-parcelas {
            border-top: 4px solid var(--primary);
        }

        .card-parcelas .progress-fill {
            background: var(--primary);
        }

        .card-trozas {
            border-top: 4px solid var(--secondary);
        }

        .card-trozas .progress-fill {
            background: var(--secondary);
        }

        .card-estimaciones {
            border-top: 4px solid var(--accent);
        }

        .card-estimaciones .progress-fill {
            background: var(--accent);
        }

        /* Section Header */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .section-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .section-header h2 i {
            margin-right: 0.5rem;
            color: var(--primary);
        }

        .section-header .badge {
            background: var(--primary-light);
            color: var(--primary-dark);
            padding: 0.35rem 0.8rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Parcelas Container */
        .parcelas-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .parcela-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
        }

        .parcela-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
        }

        .parcela-header {
            position: relative;
        }

        .parcela-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 500;
            z-index: 1;
            backdrop-filter: blur(5px);
        }

        .parcela-hero {
            height: 150px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .parcela-hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50%;
            background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);
        }

        .parcela-body {
            padding: 1.5rem;
        }

        .parcela-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .parcela-location {
            color: var(--gray);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }

        .parcela-location i {
            margin-right: 0.5rem;
            color: var(--primary);
        }

        .parcela-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-item {
            text-align: center;
            padding: 0.8rem;
            background: var(--bg-color);
            border-radius: 8px;
        }

        .stat-number {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--accent);
            display: block;
            margin-bottom: 0.2rem;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--gray);
            display: block;
        }

        .parcela-chart {
            height: 100px;
            margin: 1rem 0;
        }

        .parcela-footer {
            display: flex;
            border-top: 1px solid #eee;
            padding: 1rem 1.5rem;
        }

        .btn-details, .btn-export {
            flex: 1;
            padding: 0.7rem;
            border: none;
            background: none;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-details {
            color: var(--dark-gray);
            border-right: 1px solid #eee;
        }

        .btn-details:hover {
            color: var(--primary-dark);
        }

        .btn-details i {
            margin-right: 0.5rem;
            transition: var(--transition);
        }

        .btn-export {
            color: var(--primary-dark);
        }

        .btn-export:hover {
            color: var(--primary);
        }

        .btn-export i {
            margin-right: 0.5rem;
        }

        /* Parcela Details */
        .parcela-details {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease;
        }

        .parcela-details.show {
            max-height: 2000px;
        }

        .details-section {
            padding: 1.5rem;
            border-top: 1px solid #eee;
        }

        .details-section h4 {
            font-size: 1.1rem;
            margin-bottom: 1rem;
            color: var(--dark);
            display: flex;
            align-items: center;
        }

        .details-section h4 i {
            margin-right: 0.5rem;
            color: var(--primary);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .info-item {
            margin-bottom: 0.5rem;
        }

        .info-label {
            display: block;
            font-size: 0.8rem;
            color: var(--gray);
            margin-bottom: 0.2rem;
        }

        .info-value {
            font-weight: 500;
            color: var(--dark);
        }

        .advanced-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .radar-chart {
            height: 200px;
        }

        .stats-summary {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .summary-item {
            background: var(--bg-color);
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
        }

        .summary-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent);
            display: block;
        }

        .summary-label {
            font-size: 0.8rem;
            color: var(--gray);
            display: block;
        }

        /* Trozas Table */
        .trozas-table {
            border-radius: 8px;
            overflow: hidden;
        }

        .table-header {
            display: grid;
            grid-template-columns: 80px 1fr 1fr 1fr 80px;
            background: var(--bg-color);
            padding: 0.8rem 1rem;
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--dark-gray);
        }

        .table-row {
            display: grid;
            grid-template-columns: 80px 1fr 1fr 1fr 80px;
            padding: 0.8rem 1rem;
            border-bottom: 1px solid #eee;
            font-size: 0.9rem;
            align-items: center;
            transition: var(--transition);
        }

        .table-row:last-child {
            border-bottom: none;
        }

        .table-row:hover {
            background: rgba(58, 95, 11, 0.05);
        }

        .action-btn {
            color: var(--primary);
            background: none;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            justify-content: center;
        }

        .action-btn:hover {
            color: var(--primary-dark);
            transform: scale(1.1);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--gray);
        }

        .empty-state i {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--light-gray);
        }

        .empty-state p {
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .advanced-stats {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 992px) {
            .hero-section {
                flex-direction: column;
                text-align: center;
                padding: 2rem;
            }

            .hero-title {
                justify-content: center;
            }

            .hero-actions {
                margin-top: 1.5rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1.5rem;
            }

            .parcelas-container {
                grid-template-columns: 1fr;
            }

            .table-header, .table-row {
                grid-template-columns: 60px 1fr 1fr 1fr 60px;
            }
        }

        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stat-card {
                flex-direction: column;
                text-align: center;
            }

            .stat-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .parcela-stats {
                grid-template-columns: 1fr;
            }

            .table-header, .table-row {
                grid-template-columns: 50px 1fr 1fr 1fr 50px;
                font-size: 0.8rem;
            }
        }
    </style>
@endpush
