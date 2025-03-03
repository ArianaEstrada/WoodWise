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
            height: 90vh;
            background-image: url('{{ asset("images/acerca.jpg") }}'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
        }

        
        .container-content {
            text-align: center;
            z-index: 1;
            padding: 50px 15px;
            max-width: 100%; 
        }

        h1 {
            font-size: 3.5em;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            color: white;
        }

        
        .contact-info {
            background: rgba(255, 255, 255, 0.15);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: #fff;
            margin-bottom: 30px;
            max-width: 600px;
            margin: 0 auto; 
        }

        .contact-info h2 {
            margin-bottom: 20px;
            font-size: 2em;
        }

        .contact-info p {
            font-size: 1.2em;
        }

       
        .contact-form {
            background: rgba(255, 255, 255, 0.15);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: #fff;
            max-width: 600px; 
            margin: 0 auto;
        }

       
.contact-form input, .contact-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 2px solid white;  
    border-radius: 4px;
    background-color: transparent;  
    color: white;  
}

        

        
        .back-button {
            background-color: transparent; 
            color: white; 
            padding: 12px 30px;
            border: 2px solid white; 
            border-radius: 30px;
            font-size: 1.2em;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .back-button:hover {
            background-color: transparent; 
            border-color: #3498db;
            color: #3498db; 
        }

        
        .contact-form button {
            background-color: transparent; 
            color: white; 
            padding: 12px 30px;
            border: 2px solid white; 
            border-radius: 30px;
            font-size: 1.2em;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: transparent; 
            border-color: #f8c291;
            color: #f8c291; 
        }

        
        @media (max-width: 768px) {
            .contact-info, .contact-form {
                padding: 20px;
            }
            h1 {
                font-size: 2.5em;
            }
        }

        
        .form-buttons {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

    </style>
</head>
<body>

   
    <div class="container-content">
        <h1>Contactanos</h1>
        
        <div class="contact-info">
            <h2>Información de contacto</h2>
            <p><strong>Dirección:</strong> Carretera Federal Valle de Bravo Km 30, Ejido San Antonio Laguna, 51200 Valle de Bravo, Méx.</p>
            <i class="bi bi-geo-alt"></i>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg>
            <p><strong>Teléfono:</strong> +52 5511329075</p>
            <i class="bi bi-telephone-fill"></i>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
            </svg>
            <p><strong>Correo electrónico:</strong> woodwise@gmail.com</p>
            <i class="bi bi-envelope-at-fill"></i>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
  <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
  <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
</svg>
            <p><strong>WhatsApp</strong> +52 5511329075</p>
            <i class="bi bi-whatsapp"></i>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
  <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
</svg>
            <p><strong>Facebook</strong> WoodWise</p>
            <i class="bi bi-facebook"></i>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
  <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
</svg>
            
        </div>
        <p>
        
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

                
                <div class="form-buttons">
                   
                    <a href="javascript:history.back()">
                        <button type="button" class="back-button">Regresar</button>
                    </a>

                    
                    <button type="submit" class="btn btn-primary">Enviar mensaje</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
