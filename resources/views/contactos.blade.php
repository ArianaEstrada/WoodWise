@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos - WoodWise</title>
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #f4f4f4; /* Fondo blanco elegante */
            font-family: 'Arial', sans-serif;
            color: #333; /* Texto oscuro para buena legibilidad */
        }

        .container-content {
            text-align: center;
            padding: 50px 15px;
        }

        h1 {
            font-size: 2.5em;
            font-weight: bold;
            margin-bottom: 30px;
            color: #2c3e50; /* Color elegante para el título */
            text-transform: uppercase;
        }

        .contact-info, .contact-form {
            background-color: #fff; /* Fondo blanco */
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            padding: 30px;
            margin-bottom: 30px;
            max-width: 600px;
            margin: 0 auto; /* Centrado de los elementos */
            color: #333;
        }

        .contact-info h2, .contact-form h2 {
            font-size: 1.8em;
            font-weight: 600;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .contact-info p, .contact-form input, .contact-form textarea {
            font-size: 1.1em;
            line-height: 1.6em;
        }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        .contact-form button {
            background-color: #3498db;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 30px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .contact-form button:hover {
            background-color: #2980b9; /* Cambio de color al pasar el mouse */
        }

        .back-button {
            background-color: transparent;
            color: #3498db;
            padding: 12px 30px;
            border: 2px solid #3498db;
            border-radius: 30px;
            font-size: 1.2em;
            cursor: pointer;
            margin-top: 20px;
            transition: color 0.3s, border-color 0.3s;
        }

        .back-button:hover {
            background-color: #3498db;
            color: white;
            border-color: #3498db;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2em;
            }
            .contact-info, .contact-form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="container-content">
        <h1>Contactanos</h1>

        <div class="contact-info">
            <h2>Información de contacto</h2>
            <p><strong>Dirección:</strong> Carretera Federal Valle de Bravo Km 30, Ejido San Antonio Laguna, 51200 Valle de Bravo, Méx.</p>
            <p><strong>Teléfono:</strong> +52 5511329075</p>
            <p><strong>Correo electrónico:</strong> woodwise@gmail.com</p>
            <p><strong>WhatsApp:</strong> +52 5511329075</p>
            <p><strong>Facebook:</strong> WoodWise</p>
        </div>

        <div class="contact-form">
            <h2>Envíanos un mensaje</h2>
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Tu nombre" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Tu correo" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="4" placeholder="Tu mensaje" required></textarea>
                </div>
                <button type="submit" class="btn btn-light">Enviar mensaje</button>
            </form>
        </div>

        <button class="back-button" onclick="window.history.back()">Regresar</button>
    </div>

</body>
</html>

@endsection
