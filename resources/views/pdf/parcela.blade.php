<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Parcela - {{ $parcela->nom_parcela }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #2c3e50; padding-bottom: 20px; }
        .logo { width: 150px; margin-bottom: 10px; }
        .title { color: #2c3e50; font-size: 24px; font-weight: bold; }
        .subtitle { color: #7f8c8d; font-size: 16px; }
        .section { margin-bottom: 25px; }
        .section-title {
            background-color: #2c3e50;
            color: white;
            padding: 8px 15px;
            font-weight: bold;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }
        .info-table th {
            background-color: #f8f9fa;
            text-align: left;
            padding: 10px;
            border-bottom: 2px solid #dee2e6;
        }
        .info-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #dee2e6;
        }
        .info-table tr:last-child td {
            border-bottom: none;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #7f8c8d;
            border-top: 1px solid #dee2e6;
            padding-top: 15px;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        .mb-3 { margin-bottom: 15px; }
    </style>
</head>
<body>
<div class="header">
    <h1 class="title">Reporte de Parcela Forestal</h1>
    <p class="subtitle">{{ $parcela->nom_parcela }} - Generado el {{ now()->format('d/m/Y H:i') }}</p>
</div>

<div class="section">
    <div class="section-title">Información General</div>
    <table class="info-table">
        <tr>
            <th width="20%">Nombre:</th>
            <td width="30%">{{ $parcela->nom_parcela }}</td>
            <th width="20%">Código:</th>
            <td width="30%">{{ $parcela->id_parcela }}</td>
        </tr>
        <tr>
            <th>Ubicación:</th>
            <td colspan="3">{{ $parcela->ubicacion }}</td>
        </tr>
        <tr>
            <th>Extensión:</th>
            <td>{{ $parcela->extension }} ha</td>
            <th>Productor:</th>
            <td>{{ $parcela->productor ? $parcela->productor->persona->nom : 'No asignado' }}</td>
        </tr>
        <tr>
            <th>Cédula Productor:</th>
            <td>{{ $parcela->productor ? $parcela->productor->persona->cedula : 'N/A' }}</td>
            <th>Total Trozas:</th>
            <td>{{ $parcela->trozas_count }}</td>
        </tr>
        <tr>
            <th>Volumen Maderable:</th>
            <td colspan="3">{{ number_format($parcela->volumen_maderable, 2) }} m³</td>
        </tr>
    </table>
</div>

@if($parcela->trozas_count > 0)
    <div class="section">
        <div class="section-title">Detalle de Trozas</div>
        <table class="info-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Longitud (m)</th>
                <th>Diámetro (m)</th>
                <th>Densidad</th>
                <th class="text-right">Volumen (m³)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($parcela->trozas as $troza)
                <tr>
                    <td>{{ $troza->id_troza }}</td>
                    <td>{{ number_format($troza->longitud, 2) }}</td>
                    <td>{{ number_format($troza->diametro, 2) }}</td>
                    <td>{{ number_format($troza->densidad, 2) }}</td>
                    <td class="text-right">
                        {{ $troza->estimacion ? number_format($troza->estimacion->calculo, 2) : 'N/A' }}
                    </td>
                </tr>
            @endforeach
            <tr class="text-bold">
                <td colspan="4" class="text-right">Total Volumen:</td>
                <td class="text-right">{{ number_format($parcela->volumen_maderable, 2) }} m³</td>
            </tr>
            </tbody>
        </table>
    </div>
@endif

<div class="footer">
    <p>Sistema WoodWise - Tecnología para la gestión forestal sostenible</p>
    <p>© {{ date('Y') }} WoodWise. Todos los derechos reservados.</p>
</div>
</body>
</html>
