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

<script>document.addEventListener('DOMContentLoaded', function () {
    const contentMap = {
        'especies': { title: 'Gestión de Especies', route: '/dashboard/especies' },
        'formulas': { title: 'Gestión de Fórmulas', route: '/dashboard/formulas' },
        'usuarios': { title: 'Gestión de Usuarios', route: '/dashboard/usuarios' },
        'trozas': { title: 'Gestión de Trozas', route: '/dashboard/trozas' },
        'estimaciones': { title: 'Gestión de Estimaciones', route: '/dashboard/estimaciones' },
        'parcelas': { title: 'Gestión de Parcelas', route: '/dashboard/parcelas' }
    };

    function loadContent(section, link = null) {
        const currentSection = contentMap[section];
        if (!currentSection) return;

        fetch(currentSection.route)
            .then(response => response.text())
            .then(html => {
                console.log("Contenido recibido:", html); // Depuración
                document.getElementById('dynamic-content').innerHTML = html;
                document.getElementById('dynamic-title').textContent = currentSection.title;
                document.getElementById('welcome-message').style.display = 'none';

                // Actualizar clase activa en la navegación
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                if (link) link.classList.add('active');
            })
            .catch(error => {
                console.error('Error al cargar contenido:', error);
                document.getElementById('dynamic-content').innerHTML = `<div class="alert alert-danger">No se pudo cargar el contenido.</div>`;
            });
    }

    // Asignar evento a enlaces de navegación
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const section = this.getAttribute('data-section');
            loadContent(section, this);
        });
    });

    // Opcional: Cargar una sección por defecto al inicio
    loadContent('especies'); 
});


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
