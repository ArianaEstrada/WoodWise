<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Troza {{ $troza->codigo }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 1px solid #ddd; padding-bottom: 10px; }
        .title { font-size: 18px; font-weight: bold; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .info-table td { padding: 5px; vertical-align: top; }
        .info-table td:first-child { width: 30%; font-weight: bold; }
        .photo-placeholder {
            width: 150px;
            height: 100px;
            border: 1px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="title">Reporte de Troza</div>
    <div>Generado el: {{ now()->format('d/m/Y H:i') }}</div>
</div>

<table class="info-table">
    <tr>
        <td>Código:</td>
        <td>{{ $troza->codigo }}</td>
    </tr>
    <tr>
        <td>Parcela:</td>
        <td>{{ $troza->parcela->nom_parcela }} ({{ $troza->parcela->ubicacion }})</td>
    </tr>
    <tr>
        <td>Especie:</td>
        <td>{{ $troza->especie }}</td>
    </tr>
    <tr>
        <td>Diámetro:</td>
        <td>{{ $troza->diametro }} cm</td>
    </tr>
    <tr>
        <td>Longitud:</td>
        <td>{{ $troza->longitud }} m</td>
    </tr>
    <tr>
        <td>Volumen:</td>
        <td>{{ $troza->volumen }} m³</td>
    </tr>
    <tr>
        <td>Fecha de registro:</td>
        <td>{{ $troza->created_at->format('d/m/Y') }}</td>
    </tr>
    @if($troza->observaciones)
        <tr>
            <td>Observaciones:</td>
            <td>{{ $troza->observaciones }}</td>
        </tr>
    @endif
</table>

<div style="margin-top: 20px;">
    <div style="font-weight: bold; margin-bottom: 5px;">Fotografía:</div>
    <div class="photo-placeholder">
        [Área para fotografía de la troza]
    </div>
</div>

<div style="margin-top: 30px; font-size: 10px; text-align: center;">
    Documento generado automáticamente por el sistema de gestión forestal
</div>
</body>
</html>
