<!DOCTYPE html>
<html>
<head>
    <title>{{ $titulo }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .header img { max-height: 80px; }
        h1 { color: #2d4a08; text-align: center; margin-bottom: 5px; }
        h2 { color: #3a5f0b; margin-top: 25px; }
        .fecha { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .section { margin-bottom: 30px; }
        .resumen {
            background-color: #f8f8f0;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .resumen-item { display: inline-block; margin-right: 30px; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
<div class="header">
    @if(file_exists($logo))
        <img src="{{ $logo }}" alt="Logo">
    @endif
    <h1>{{ $titulo }}</h1>
    <div class="fecha">Generado el: {{ $fecha }}</div>
</div>

<div class="resumen">
    <h2>Resumen General</h2>
    <div class="resumen-item"><strong>Parcelas:</strong> {{ $stats['total_parcelas'] }}</div>
    <div class="resumen-item"><strong>Trozas:</strong> {{ $stats['total_trozas'] }}</div>
    <div class="resumen-item"><strong>Estimaciones:</strong> {{ $stats['total_estimaciones'] }}</div>
</div>

@foreach($parcelas as $parcela)
    <div class="section">
        <h2>Parcela: {{ $parcela->nom_parcela }}</h2>
        <p><strong>Ubicación:</strong> {{ $parcela->ubicacion }}</p>
        <p><strong>Extensión:</strong> {{ $parcela->extension }} ha</p>

        @if($parcela->trozas->count() > 0)
            <h3>Trozas ({{ $parcela->trozas->count() }})</h3>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Longitud (m)</th>
                    <th>Diámetro (cm)</th>
                    <th>Densidad (kg/m³)</th>
                    <th>Estimaciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($parcela->trozas as $troza)
                    <tr>
                        <td>{{ $troza->id_troza }}</td>
                        <td>{{ $troza->longitud }}</td>
                        <td>{{ $troza->diametro }}</td>
                        <td>{{ $troza->densidad }}</td>
                        <td>
                            @if($troza->estimacion)
                                {{ $troza->estimacion->volumen_estimado }} m³ ({{ $troza->estimacion->calidad }})
                            @else
                                Sin estimación
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No hay trozas registradas en esta parcela</p>
        @endif
    </div>

    @if(!$loop->last)
        <div class="page-break"></div>
    @endif
@endforeach
</body>
</html>
