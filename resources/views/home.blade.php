@extends('layouts.Dashboard.main')

@section('title', 'Dashboard Principal')

@section('content')
<div class="container">
    <h1 id="dynamic-title">Dashboard Principal</h1>

    <!-- Mensaje de bienvenida -->
    <div id="welcome-message" class="alert alert-success mb-4">
        ¡Bienvenido! Estás en el dashboard principal.
    </div>

    <!-- Contenido dinámico -->
    <div id="dynamic-content">
        <!-- Tarjetas informativas (contenido por defecto) -->
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card p-3 bg-white shadow-sm">
                    <h5>Estadística A</h5>
                    <p>Información relevante sobre A.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card p-3 bg-white shadow-sm">
                    <h5>Estadística B</h5>
                    <p>Información relevante sobre B.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card p-3 bg-white shadow-sm">
                    <h5>Estadística C</h5>
                    <p>Información relevante sobre C.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido para opciones (oculto por defecto) -->
    <div id="opcion-1-content" class="dynamic-section" style="display: none;">
        <h3>Contenido de la Opción 1</h3>
        <p>Este es el contenido específico para la opción 1.</p>
    </div>

    <div id="opcion-2-content" class="dynamic-section" style="display: none;">
        <h3>Contenido de la Opción 2</h3>
        <p>Aquí puedes ver información relacionada con la opción 2.</p>
    </div>

    <div id="opcion-3-content" class="dynamic-section" style="display: none;">
        <h3>Contenido de la Opción 3</h3>
        <p>Detalles y estadísticas específicas para la opción 3.</p>
    </div>

</div>

<script>
const contentMap = {
    'especies': {
        title: 'Registro de Especies',
        contentId: 'especies-content'
    },
    'opcion-1': {
        title: 'Contenido de la Opción 1',
        contentId: 'opcion-1-content'
    },
    'opcion-2': {
        title: 'Contenido de la Opción 2',
        contentId: 'opcion-2-content'
    },
    'opcion-3': {
        title: 'Contenido de la Opción 3',
        contentId: 'opcion-3-content'
    }
};


function loadContent(opcionId) {
    // Ocultar el contenido actual
    document.getElementById('dynamic-content').innerHTML = '';

    // Hacer la solicitud AJAX
    fetch(`/dashboard/${opcionId}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('dynamic-content').innerHTML = html;
            document.getElementById('dynamic-title').textContent = contentMap[opcionId].title;
        })
        .catch(error => console.error('Error al cargar el contenido:', error));

    // Ocultar mensaje de bienvenida
    document.getElementById('welcome-message').style.display = 'none';
}



</script>

<style>
.sidebar a.active {
    background-color: #007bff;
    font-weight: bold;
}

.dynamic-section {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endsection
