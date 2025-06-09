<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Trozas</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .logo { height: 80px; }
        .title { font-size: 24px; font-weight: bold; color: #5D4037; }
        .subtitle { font-size: 14px; color: #8D6E63; }
        .date { font-size: 12px; color: #8D6E63; text-align: right; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #689F38; color: white; text-align: left; padding: 8px; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #8D6E63; }
    </style>
</head>
<body>
<div class="header">
    @if(file_exists($logo))
        <img src="{{ $logo }}" class="logo">
    @endif
    <div class="title">Trozas</div>
    <div class="subtitle">Generado el: {{ $fecha }}</div>
</div>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Parcela</th>
        <th>Longitud (m)</th>
        <th>Diámetro (cm)</th>
        <th>Densidad (kg/m³)</th>
        <th>Volumen (m³)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($trozas as $troza)
        <tr>
            <td>{{ $troza->id_troza }}</td>
            <td>{{ $troza->parcela->nom_parcela }}</td>
            <td>{{ $troza->longitud }}</td>
            <td>{{ $troza->diametro }}</td>
            <td>{{ $troza->densidad }}</td>
            <td>{{ $troza->volumen }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="footer">
    © {{ date('Y') }} WoodWise - Sistema de Gestión Forestal
</div>
</body>
</html>
