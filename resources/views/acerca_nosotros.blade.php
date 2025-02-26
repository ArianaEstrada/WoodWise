<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de WoodWise</title>
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
            background: url("{{ asset('images/acerca.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            text-align: center;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .container {
            position: relative;
            max-width: 900px;
            padding: 50px 20px;
            background: transparent;
            border-radius: 10px;
            z-index: 2;
        }

        .section {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h1, h2 {
            color: #f9a825;
            font-weight: bold;
        }

        p, li {
            font-size: 1.1em;
            color: #fff;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>

    <div class="container">
        <h1>Acerca de WoodWise</h1>

        <div class="section">
            <h2>¿Quiénes somos?</h2>
            <p>WoodWise es una plataforma innovadora diseñada para facilitar el cálculo preciso de volúmenes maderables, ayudando a profesionales del sector forestal a gestionar de manera eficiente los recursos naturales.</p>
        </div>

        <div class="section">
            <h2>¿Qué hacemos?</h2>
            <p>Desarrollamos herramientas tecnológicas avanzadas para optimizar la planificación, estimación y aprovechamiento de la madera, promoviendo prácticas sostenibles en la industria forestal.</p>
        </div>

        <div class="section">
            <h2>¿Cómo ayudamos?</h2>
            <p>Nuestra plataforma permite a ingenieros forestales, investigadores y empresas calcular con precisión los volúmenes de madera, reduciendo desperdicios y mejorando la toma de decisiones basadas en datos confiables.</p>
        </div>

        <div class="section">
            <h2>Nuestra Historia</h2>
            <p>WoodWise nació con el propósito de digitalizar y modernizar los cálculos forestales, ofreciendo una solución intuitiva y accesible para profesionales del sector.</p>
        </div>

        <div class="section">
            <h2>Valores</h2>
            <ul>
                <li><strong> Sostenibilidad:</strong> Fomentamos el uso responsable de los recursos forestales.</li>
                <li><strong> Precisión:</strong> Brindamos herramientas con algoritmos confiables y datos exactos.</li>
                <li><strong> Compromiso:</strong> Apoyamos a nuestros usuarios con una plataforma eficiente y fácil de usar.</li>
            </ul>
        </div>

        <div class="section">
            <h2>Nuestro Equipo</h2>
            <p>WoodWise está desarrollado por un equipo de expertos en ingeniería forestal y tecnología, comprometidos con la innovación y la conservación de los bosques.</p>
        </div>
    </div>
</body>
</html>
