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
            background-color: #f4f4f4; /* Fondo claro elegante */
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
            letter-spacing: 2px;
        }

        .contact-info, .contact-form {
            background-color: #fff; /* Fondo blanco */
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Sombra más sutil */
            padding: 35px;
            margin-bottom: 30px;
            max-width: 650px;
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
            transition: border 0.3s ease;
        }

        .contact-form input:focus, .contact-form textarea:focus {
            border-color: #3498db;
            outline: none;
        }

        .contact-form button {
            background-color: #3498db;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 30px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .contact-form button:hover {
            background-color: #2980b9;
            transform: translateY(-3px); /* Efecto de elevación */
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
            transition: color 0.3s, border-color 0.3s, background-color 0.3s;
        }

        .back-button:hover {
            background-color: #3498db;
            color: white;
            border-color: #3498db;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem; /* Ajustar el tamaño del título en pantallas pequeñas */
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
            <i class="bi bi-geo-alt-fill"></i>
            <p><strong>Teléfono:</strong> +52 5511329075</p>
            <i class="bi bi-telephone-fill"></i>
            <p><strong>Correo electrónico:</strong> woodwise@gmail.com</p>
            <i class="bi bi-envelope-at-fill"></i>
            <p><strong>WhatsApp:</strong> +52 5511329075</p>
            <i class="bi bi-whatsapp"></i>
            <p><strong>Facebook:</strong> WoodWise</p>
            <i class="bi bi-facebook"></i>
        </div>
        <p>
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
