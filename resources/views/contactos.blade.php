<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos - WoodWise</title>
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
    <style>
        /* Estilos generales */
        body {
            margin: 0;
            padding: 0;
            height: 90vh;
            background-image: url('{{ asset("images/acerca.jpg") }}'); /* Ruta correcta a la imagen dentro de la carpeta public */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
        }

        /* Contenedor principal */
        .container-content {
            text-align: center;
            z-index: 1;
            padding: 50px 15px;
            max-width: 100%; /* Asegura que no se desborde */
        }

        h1 {
            font-size: 3.5em;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            color: white;
        }

        /* Estilos para la información de contacto */
        .contact-info {
            background: rgba(255, 255, 255, 0.15);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: #fff;
            margin-bottom: 30px;
            max-width: 600px;
            margin: 0 auto; /* Centrado horizontal */
        }

        .contact-info h2 {
            margin-bottom: 20px;
            font-size: 2em;
        }

        .contact-info p {
            font-size: 1.2em;
        }

        /* Estilos para el formulario de contacto */
        .contact-form {
            background: rgba(255, 255, 255, 0.15);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: #fff;
            max-width: 600px; /* Limitar el ancho del formulario */
            margin: 0 auto; /* Centrado horizontal */
        }

       /* Estilos para los campos de texto */
.contact-form input, .contact-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 2px solid white;  /* Cambio aquí: borde blanco */
    border-radius: 4px;
    background-color: transparent;  /* Cambio aquí: fondo transparente */
    color: white;  /* Para que el texto sea blanco */
}

        

        /* Estilos para el botón de regresar */
        .back-button {
            background-color: transparent; /* Elimina el fondo */
            color: white; /* Color del texto */
            padding: 12px 30px;
            border: 2px solid white; /* Contorno blanco */
            border-radius: 30px;
            font-size: 1.2em;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .back-button:hover {
            background-color: transparent; /* Mantiene el fondo transparente al pasar el ratón */
            border-color: #3498db; /* Cambia el color del borde al pasar el ratón */
            color: #3498db; /* Cambia el color del texto al pasar el ratón */
        }

        /* Estilos para el botón de enviar mensaje */
        .contact-form button {
            background-color: transparent; /* Elimina el fondo */
            color: white; /* Color del texto */
            padding: 12px 30px;
            border: 2px solid white; /* Contorno blanco */
            border-radius: 30px;
            font-size: 1.2em;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: transparent; /* Mantiene el fondo transparente al pasar el ratón */
            border-color: #f8c291; /* Cambia el color del borde al pasar el ratón */
            color: #f8c291; /* Cambia el color del texto al pasar el ratón */
        }

        /* Asegura que el formulario se vea bien en dispositivos pequeños */
        @media (max-width: 768px) {
            .contact-info, .contact-form {
                padding: 20px;
            }
            h1 {
                font-size: 2.5em;
            }
        }

        /* Alineación de los botones */
        .form-buttons {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

    </style>
</head>
<body>

    <!-- Contenedor principal con fondo -->
    <div class="container-content">
        <h1>Contactanos</h1>
        <!-- Información de contacto -->
        <div class="contact-info">
            <h2>Información de contacto</h2>
            <p><strong>Dirección:</strong> Valle de Bravo</p>
            <i class="bi bi-geo-alt"></i>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg>
            <p><strong>Teléfono:</strong> +52 12345678</p>
            <i class="bi bi-telephone-fill"></i>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
            </svg>
            <p><strong>Correo electrónico:</strong> contacto@empresa.com</p>
            <i class="bi bi-envelope-at"></i>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z"/>
            </svg>
            <p><strong>WhatsApp</strong> +52 12345678</p>
            <i class="bi bi-whatsapp"></i>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
  <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
</svg>
            <p><strong>Facebook</strong> WoodWised</p>
            <i class="bi bi-facebook"></i>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
  <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
</svg>
            <p><strong>Onlyfans</strong> WoodWise</p>
            
        </div>
        <p>
        <!-- Formulario de contacto -->
        <div class="contact-form">
            <h2>Envíanos un mensaje</h2>
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="nombre">Tu nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Tu correo electrónico:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="mensaje">Tu mensaje:</label>
                    <textarea id="mensaje" name="mensaje" rows="5" class="form-control" required></textarea>
                </div>

                <!-- Contenedor de botones (Regresar y Enviar mensaje) -->
                <div class="form-buttons">
                    <!-- Botón de regresar -->
                    <a href="javascript:history.back()">
                        <button type="button" class="back-button">Regresar</button>
                    </a>

                    <!-- Botón de enviar mensaje -->
                    <button type="submit" class="btn btn-primary">Enviar mensaje</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
