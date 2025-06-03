<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Parcela {{ $parcela->id_parcela }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 1px solid #ddd; padding-bottom: 10px; }
        .title { font-size: 18px; font-weight: bold; }
        .section { margin-bottom: 15px; }
        .section-title { font-weight: bold; border-bottom: 1px solid #000; margin-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid #ddd; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        .info-row { margin-bottom: 5px; }
        .info-label { font-weight: bold; display: inline-block; width: 120px; }
    </style>
</head>
<body>
<div class="header">
    <div class="title">Reporte de Parcela</div>
    <div>Generado el: {{ now()->format('d/m/Y H:i') }}</div>
</div>

<div class="section">
    <div class="section-title">Información Básica</div>
    <div class="info-row">
        <span class="info-label">Nombre:</span>
        <span>{{ $parcela->nom_parcela }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Ubicación:</span>
        <span>{{ $parcela->ubicacion }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Área:</span>
        <span>{{ $parcela->extension }} hectáreas</span>
    </div>
    <div class="info-row">
        <span class="info-label">Dirección:</span>
        <span>{{ $parcela->direccion }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Código Postal:</span>
        <span>{{ $parcela->CP }}</span>
    </div>
</div>

@if($estimacion)
    <div class="section">
        <div class="section-title">Última Estimación</div>
        <table>
            <tr>
                <td width="20%"><strong>Fecha:</strong></td>
                <td>{{ $estimacion->created_at->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td><strong>Volumen:</strong></td>
                <td>{{ $estimacion->volumen }} m³</td>
            </tr>
            <tr>
                <td><strong>Especies:</strong></td>
                <td>{{ $estimacion->especies ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Observaciones:</strong></td>
                <td>{{ $estimacion->observaciones ?? 'Ninguna' }}</td>
            </tr>
        </table>
    </div>
@endif

@if($trozas->count() > 0)
    <div class="section">
        <div class="section-title">Trozas Registradas ({{ $trozas->count() }})</div>
        <table>
            <thead>
            <tr>
                <th>Código</th>
                <th>Especie</th>
                <th>Diámetro (cm)</th>
                <th>Longitud (m)</th>
                <th>Volumen (m³)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($trozas as $troza)
                <tr>
                    <td>{{ $troza->codigo }}</td>
                    <td>{{ $troza->especie }}</td>
                    <td>{{ $troza->diametro }}</td>
                    <td>{{ $troza->longitud }}</td>
                    <td>{{ $troza->volumen }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif

<div style="margin-top: 30px; font-size: 10px; text-align: center;">
    Documento generado automáticamente por el sistema de gestión forestal
</div>
</body>
</html>
